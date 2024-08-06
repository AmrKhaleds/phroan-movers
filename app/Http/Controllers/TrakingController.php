<?php

namespace App\Http\Controllers;

use App\Models\AssignCar;
use App\Models\Booking;
use App\Models\OrderExpense;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Setting;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Worker;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use ReCaptcha\RequestMethod\Curl;
use Str;
use function GuzzleHttp\json_decode;

class TrakingController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{

		$setting = Setting::whereIn('id', [4, 5])->get(['name', 'value'])->toArray();
		$vehicles = Vehicle::whereNull('deleted_at')->get();
		$vehicles_garage = Vehicle::where('status', 'garage')->whereNull('deleted_at')->count();
		$vehicles_available = Vehicle::where('status', 'available')->whereNull('deleted_at')->count();
		$vehicleData = Vehicle::whereNull('deleted_at')->get();
		foreach ($vehicleData as $vehicleDataValue) {
			if ($vehicleDataValue->assign_car_id) {

				$workerData = [];
				if (!is_null($vehicleDataValue->assign->worker_id) && $vehicleDataValue->assign->worker_id != 'null') {
					foreach (json_decode($vehicleDataValue->assign->worker_id) as $worker_id) {
						$workerData [] = Worker::find($worker_id)->name;
					}
				}
				$HVACData = [];
				if (!is_null($vehicleDataValue->assign->HVAC_technician_id) && $vehicleDataValue->assign->HVAC_technician_id != 'null') {
					foreach (json_decode($vehicleDataValue->assign->HVAC_technician_id) as $HVAC) {
						$HVACData [] = Worker::find($HVAC)->name;
					}
				}
				$wrappingData = [];
				if (!is_null($vehicleDataValue->assign->wrapping_id) && $vehicleDataValue->assign->wrapping_id != 'null') {
					foreach (json_decode($vehicleDataValue->assign->wrapping_id) as $wrapping) {
						$wrappingData [] = Worker::find($wrapping)->name;
					}
				}
				$carpenterData = [];
				if (!is_null($vehicleDataValue->assign->carpenter_id) && $vehicleDataValue->assign->carpenter_id != 'null') {
					foreach (json_decode($vehicleDataValue->assign->carpenter_id) as $carpenter) {
						$carpenterData [] = Worker::find($carpenter)->name;
					}
				}

				$vehicleDataValue->setAttribute('driver_name', $vehicleDataValue->assign->user->name);
				$vehicleDataValue->setAttribute('workers', $workerData);
				$vehicleDataValue->setAttribute('HVAC', $HVACData);
				$vehicleDataValue->setAttribute('wrapping', $wrappingData);
				$vehicleDataValue->setAttribute('carpenter', $carpenterData);
				if ($vehicleDataValue->assign->crane) {
					$vehicleDataValue->setAttribute('crane', $vehicleDataValue->assign->crane->car_name);
				} else {
					$vehicleDataValue->setAttribute('crane', '');
				}
			}
		}
		$vehicleDataFilter = Vehicle::whereNull('deleted_at')->get(['id'])->toArray();
		$category = Category::where('title', 'LIKE', "%سواق%")->OrWhere('title', 'LIKE', "%سائق%")->whereNull('deleted_at')->first(['id']);
		$users = Employee::where('category_id', $category->id)->whereNull('deleted_at')->get(['user_id'])->toArray();
		$assigns = AssignCar::whereDate('created_at', Carbon::today())->whereNull('deleted_at')->get(['user_id', 'vehicle_id', 'crane_id'])->toArray();
//        Arr::pluck($assigns,'vehicle_id')
//        $finalDrive = array_diff(collect($users)->flatten()->toArray(), Arr::pluck($assigns, 'user_id'));
//        $finalVicl = array_diff(collect($vehicleDataFilter)->flatten()->toArray(), Arr::pluck($assigns, 'vehicle_id'));
		$finalDrive = collect($users)->flatten()->toArray();
		$finalVicl = collect($vehicleDataFilter)->flatten()->toArray();

		$drivers = User::whereIn('id', $finalDrive)->whereNull('deleted_at')->get();

		$vehicleDataAv = Vehicle::where('status', 'available')->whereIn('id', $finalVicl)->whereNull('deleted_at')->get();
		$workers = Worker::whereNull('deleted_at')->get();
		$target = 0;
		$sum_garage = 0;
		$sum_available = 0;
		foreach ($vehicles as $vehicle) {
			if ($vehicle->status == 'garage') {
				$sum_garage += $setting[0]['value'] * $vehicles_garage;
				$target += $setting[0]['value'] * $vehicles_garage;
			} elseif ($vehicle->status == 'available') {
				$sum_available += $setting[1]['value'] * $vehicles_available;
				$target += $setting[1]['value'] * $vehicles_available;
			}

		}
		if ($request->date) {
			if (nBetween(date('H'), getSetting('last_shift')->value, getSetting('start_shift')->value)) {
				$period_shift = [$request->date . ' 08:00:00', $request->date . ' 20:00:00']; // sun
			} else {
				$period_shift = [$request->date . ' 20:00:00', date('Y-m-d', strtotime($request->date . ' + 1 days')) . ' 08:00:00']; // moon
			}
			$period = CarbonPeriod::since(Carbon::parse($request->date)->subDays(3))
				->until(Carbon::parse($request->date)->addDays(3));

			$date_array = [];
			foreach ($period as $date) {
				$date_array [] = [$date->format('Y-m-d'), $date->locale('ar')->isoFormat('dddd')];
			}
			$expenses = OrderExpense::where('created_at', Carbon::now())->whereNull('deleted_at')->sum('cost');

			$bookings = Booking::whereDate('booking_at', $request->date)->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
			$already_bookings = Booking::where('status', 'reservation')->whereDate('booking_at', $request->date)->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
			$cars = Booking::whereDate('booking_at', $request->date)->whereNull('deleted_at')->whereNotNull('vehicle_id')->pluck('assign_car_id')->toArray();
		} else {
			$period = CarbonPeriod::since(Carbon::now()->subDays(3))
				->until(Carbon::now()->addDays(3));

			$date_array = [];
			foreach ($period as $date) {
				$date_array [] = [$date->format('Y-m-d'), $date->locale('ar')->isoFormat('dddd')];
			}
			$expenses = OrderExpense::whereDate('created_at', Carbon::now())->whereNull('deleted_at')->sum('cost');
			$bookings = Booking::whereDate('booking_at', date('Y-m-d'))->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
			$already_bookings = Booking::where('status', 'reservation')->whereDate('booking_at', date('Y-m-d'))->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
			$cars = Booking::whereDate('booking_at', date('Y-m-d'))->whereNull('deleted_at')->whereNotNull('vehicle_id')->pluck('assign_car_id')->toArray();
		}
		$titles = [];
		$data = [];
		$priceAssigned = 0;
		foreach (array_count_values($cars) as $id => $car) {
			$assign = AssignCar::find($id);
			if ($request->date) {
				$data [] = Booking::whereDate('booking_at', $request->date)->whereNull('deleted_at')->where('assign_car_id', $id)->get();
			} else {
				$data [] = Booking::whereDate('booking_at', date('Y-m-d'))->whereNull('deleted_at')->where('assign_car_id', $id)->get();
			}
			foreach ($data as $value) {
				foreach ($value as $val) {
					$priceAssigned += $val->price;
					$color = '';
					if ($val->status == 'inprocess') {
						$color = 'primary';
					} elseif ($val->status == 'inuploaded') {
						$color = 'info';
					} elseif ($val->status == 'finished') {
						$color = 'success';
					}
					$val->setAttribute('color_status', $color);
					$message = 'طلب جديد';
					$message .= ' - ' . __('back.client_name') . ' : ' . $val->client_phone;
					$message .= ' - ' . __('back.KM') . ' : ' . $val->km;
					$message .= ' - ' . __('back.price') . ' : ' . $val->price;
					$message .= ' - ' . __('back.type_car') . ' : ' . __('back.' . $val->vehicle_type);
					$message .= ' - ' . __('back.from_area') . ' : ' . $val->from_area;
					$message .= ' - ' . __('back.to_area') . ' : ' . $val->to_area;

					$val->setAttribute('whatsappDriver', str_replace('<br>','%0a',strip_tags(view('acp.Traking.driverwhatsapp',compact('val'))->render())));

					$val->setAttribute('whatsappClient', str_replace('<br>','%0a',strip_tags(view('acp.Traking.clientwhatsapp',compact('val'))->render())));

					$val->setAttribute('whatsappMessage', $message);

					$titles = [];
					$names = [];
					$vehiclesD = [];

					foreach ($val->assigned as $assigned) {
						$titles [] = [$assigned->user->name, $assigned->user->employee->whatsapp];
						$names [] = $assigned->user->name;
						$vehiclesD [] = $assigned->vehicle->car_name . ' ' . $assigned->vehicle->vehicle_number;
					}
					$val->setAttribute('drivers', $titles);
					$val->setAttribute('cars', $vehiclesD);
				}
			}
//            $titles [] = $assign->user->name;
//            $titles [] = $assign->user->name . ' - ' . $assign->vehicle->car_name;

		}

		$target = $sum_garage + $sum_available;
		if (!empty($names)){

		$titles = array_values(array_unique($names));
		}

		$total_price = $bookings->whereNotNull('assign_car_id')->sum(['price']);

		$total_price_analog = (($total_price - $expenses) / 10000) * 100;
		$arrayToDay = [
			['from' => 0, 'to' => 50, 'color' => 'rgb(221 75 57)'],
			['from' => 50, 'to' => 100, 'color' => 'rgb(243 87 63)'],
			['from' => 100, 'to' => 150, 'color' => 'rgb(243 156 18)'],
			['from' => 150, 'to' => 200, 'color' => 'rgb(246 191 101)'],
			['from' => 200, 'to' => 250, 'color' => 'rgb(128 218 177)']
		];
//dd($arrayToDay);

		return view('acp.Traking.index', compact('workers', 'bookings', 'already_bookings', 'vehicles', 'cars', 'data', 'titles', 'arrayToDay', 'target', 'priceAssigned', 'vehicleData', 'drivers', 'date_array', 'request', 'total_price', 'vehicleDataAv', 'expenses', 'total_price_analog'));
	}

	public function calender(Request $request)
	{

		return view('acp.Traking.calender');
	}

	public function dataAjax()
	{
		$tasks = Booking::whereNull('deleted_at')->get();
		$data = [];
		foreach ($tasks as $key => $task) {
			$d = new \DateTime($task->booking_at);

			$date = $d->format('Y-m-d h:i:s');
			$beforDate = Carbon::parse($task->booking_at)->addHours(24)->format('Y-m-d h:i:s');
//completed
//primary
//warning
//danger
//dark
//            $task->status = 'not_started';
			if ($d->format('Y-m-d') > date('Y-m-d')) {
				$task->status = 'primary';
			} elseif ($d->format('Y-m-d') == date('Y-m-d')) {
//				if ($d->format('H:i:s') < date('H:i:s')) {
//					$task->status = 'danger';
//				} else {
				$task->status = 'warning';
//				}
			} elseif ($d->format('Y-m-d') < date('Y-m-d') && $task->status != 'success') {
				$task->status = 'dark';
//			} elseif ($d->format('Y-m-d') < date('Y-m-d') && $task->status != 'success') {
//				$task->status = 'danger';
			} elseif ($task->status == 'success') {
				$class_color = 'completed';
			}
//			$task->save();
			$class_color = 'bg-' . $task->status;

//            $data [] = ['title' => $task->title, 'start' => date("D M d Y H:i:s", strtotime($task->booking_at)), 'className' => $class_color, 'url' => route('calendars.show', $task->id)];
			$data [] = ['title' => $task->client_name, 'start' => date("Y-m-d H:i:s", strtotime($task->booking_at)), 'className' => $class_color, 'url' => route('bookings.show', $task->id)];
		}
//        dd($data);
		return response()->json($data);
	}


	public function assign($id, $assign_to)
	{
		$vehicle = Vehicle::where('id', $assign_to)->latest()->first();
		if ($vehicle->assign->user_id) {
			$booking = Booking::find($id);
			$booking->vehicle_id = $assign_to;
			$booking->driver_id = $vehicle->assign->user_id;
			$booking->assign_car_id = $vehicle->assign->id;
			$booking->assign_at = date('Y-m-d H:i:s');
			$booking->status = 'finished';
			$booking->save();
			\Session::flash('msg', __('back.successfully_assign'));
			return redirect()->route('trakings.index');
		}
	}


	public function destroy(Request $request, $id)
	{
		$booking = Booking::findOrFail($id);
		$booking->vehicle_id = null;
		$booking->status = 'canceled';
		$booking->note_canceled = $request->note_canceled;
		$booking->save();
		\Session::flash('msg', __('back.successfully_canceled'));
		return back();
	}

	public function undestroy($id)
	{
		$booking = Booking::findOrFail($id);
		AssignCar::where('booking_id',$id)->delete();
		foreach (json_decode($booking->vehicle_id) as $vehicle) {
			$vehicle = Vehicle::find($vehicle);
			$vehicle->assign_car_id = null;
			$vehicle->save();
		}

		$booking->vehicle_id = null;
		$booking->driver_id = null;
		$booking->assign_car_id = null;
		$booking->assign_at = null;
		$booking->status = 'waiting';
		$booking->save();
		\Session::flash('msg', __('back.successfully_recovery'));
		return back();
	}

	public function Status($id, $status)
	{
		$booking = Booking::findOrFail($id);
		$booking->status = $status;
		$booking->save();
		\Session::flash('msg', __('back.successfully_saved'));
		return back();
	}

	public function Report(Request $request)
	{

		$titles = [];
		$data = [];

		if ($request->from_date || $request->to_date || $request->shift) {
			if ($request->shift == 'morning') {
				$period_shift = [$request->from_date . ' 08:00:00', $request->to_date . ' 20:00:00']; // sun
			} elseif ($request->shift == 'night') {
				$period_shift = [$request->from_date . ' 20:00:00', date('Y-m-d', strtotime($request->to_date . ' + 1 days')) . ' 08:00:00']; // moon
			} else if ($request->from_date || $request->to_date) {
				$period_shift = [$request->from_date, $request->to_date]; // moon
			}
			$expenses = OrderExpense::whereBetween('created_at', $period_shift)->whereNull('deleted_at')->sum('cost');

			$bookings = Booking::whereBetween('created_at', $period_shift)->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
			$already_bookings = Booking::whereBetween('created_at', $period_shift)->where('status', 'reservation')->whereDate('booking_at', $request->date)->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
			$cars = Booking::whereBetween('created_at', $period_shift)->whereNull('deleted_at')->whereNotNull('vehicle_id')->pluck('assign_car_id')->toArray();
			foreach (array_count_values($cars) as $id => $car) {
				$assign = AssignCar::find($id);
				$data [] = Booking::whereBetween('created_at', $period_shift)->whereNull('deleted_at')->where('assign_car_id', $id)->get();

				$titles [] = $assign->user->name . ' - ' . $assign->vehicle->car_name;

			}
		} else {

			$expenses = OrderExpense::whereDate('created_at', Carbon::now())->whereNull('deleted_at')->sum('cost');
			$bookings = Booking::whereDate('booking_at', date('Y-m-d'))->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
			$already_bookings = Booking::where('status', 'reservation')->whereDate('booking_at', date('Y-m-d'))->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
			$cars = Booking::whereDate('booking_at', date('Y-m-d'))->whereNull('deleted_at')->whereNotNull('vehicle_id')->pluck('assign_car_id')->toArray();
			foreach (array_count_values($cars) as $id => $car) {
				$assign = AssignCar::find($id);
				$data [] = Booking::whereDate('booking_at', date('Y-m-d'))->whereNull('deleted_at')->where('assign_car_id', $id)->get();

				$titles [] = $assign->user->name . ' - ' . $assign->vehicle->car_name;

			}

		}


		/*     $titles = [];
			 $data = [];
			 foreach (array_count_values($cars) as $id => $car) {
				 $assign = AssignCar::find($id);
				 if ($request->date) {
					 $data [] = Booking::whereDate('booking_at', $request->date)->whereNull('deleted_at')->where('assign_car_id', $id)->get();
				 } else {
					 $data [] = Booking::whereDate('booking_at', date('Y-m-d'))->whereNull('deleted_at')->where('assign_car_id', $id)->get();
				 }

				 $titles [] = $assign->user->name . ' - ' . $assign->vehicle->car_name;

			 }


		   */


		$total_price = $bookings->whereNotNull('assign_car_id')->sum(['price']);

		return view('acp.Traking.report', compact('bookings', 'already_bookings', 'cars', 'data', 'titles', 'request', 'total_price', 'expenses'));
	}
}
