<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Vehicle;
use App\Models\Worker;
use App\Models\Know;
use App\Models\Received;
use App\Models\Booking;
use App\Models\Rate;
use App\Models\Company;
use App\Models\Setting;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Str;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\json_encode;
use GuzzleHttp\Client;

class BookingController extends Controller
{
	private static $conn_old;

	public function __construct()
	{
		$this->middleware('auth');
		self::$conn_old = DB::connection("mysql2");

	}

	public function index(Request $request)
	{
		$period = CarbonPeriod::create(Carbon::now()->subMonths(3), Carbon::now()->addMonths(3));


// Convert the period to an array of dates
		$dates = $period->month()->toArray();

//		$period = CarbonPeriod::since(Carbon::parse(Carbon::now($request->date)->month)->subMonths(3))->until(Carbon::parse(Carbon::now($request->date)->month)->addMonths(3));

		$collect_taemleader = array_map('intval', array_column(Auth::user()->teams->toArray(), 'user_id'));
		$collect_taemleader [] = Auth::user()->id;

		$date_array = [];
		foreach ($period as $date) {
			$date_array [$date->format('m')] = [$date->locale('ar')->isoFormat('MMM'),$date->format('Y-m')];
		}

//		dd(CarbonImmutable::create(2023, 1),Carbon::now()->firstOfMonth()->subMonths(2),Carbon::now());
		if (Auth::user()->emp_type == 'EMP') {
			if ($request->date) {
//				$da = Carbon::parse(Carbon::now($request->date)->month)->format('Y-m-d') . 'T' . Carbon::parse(Carbon::now($request->date)->month)->format('h:i');
				if (Auth::user()->profile->team_leader_id == 0) {
					$bookings = Booking::whereIn('created_by', $collect_taemleader)->whereMonth('created_at', \Carbon\Carbon::createFromFormat('Y-m-d', date("Y-m-d",strtotime($request->date)))->month)->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
				} else {
					$bookings = Booking::where('created_by', Auth::user()->id)->whereMonth('created_at', \Carbon\Carbon::createFromFormat('Y-m-d', date("Y-m-d",strtotime($request->date)))->month)->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
				}
			} else {
				if (Auth::user()->profile->team_leader_id == 0) {
					$bookings = Booking::whereIn('created_by', $collect_taemleader)->whereMonth('created_at', Carbon::now()->month)->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
				} else {
					$bookings = Booking::where('created_by', Auth::user()->id)->whereMonth('created_at', Carbon::now()->month)->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
				}
			}

		} elseif (Auth::user()->emp_type == 'MANG') {
			if ($request->search) {
				$bookings = Booking::where('client_phone', 'LIKE', "%$request->search%")->OrWhere('client_phone2', 'LIKE', "%$request->search%")->OrWhereDate('booking_at', $request->search)->OrWhere('client_name', 'LIKE', "%$request->search%")->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
			} elseif ($request->date) {
				$bookings = Booking::where('created_at', 'LIKE', "%$request->date%")->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
			} else {
				$bookings = Booking::whereMonth('created_at', Carbon::now()->month)->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
			}
		}
//		makeLog('بفتح الاوردرات في تمام');
		foreach ($bookings as $booking) {
			$val = $booking;
			$booking->setAttribute('whatsappClient', str_replace('<br>', '%0a', strip_tags(view('acp.Traking.clientwhatsapp', compact('val'))->render())));
		}
		/*if ($request->ajax()) {
			$view = view('acp.Booking.scroll', compact('bookings'))->render();
			return response()->json(['html' => $view]);
		}*/
		return view('acp.Booking.index', compact('bookings', 'request', 'date_array'));
	}

	public function create()
	{

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


		$settings = Setting::where('groupe', 'PRICING')->get();
		$companies = Company::whereNull('deleted_at')->get();
		$knows = Know::whereNull('deleted_at')->get();
		$receiveds = Received::whereNull('deleted_at')->get();
		$areas = Area::where('parint', 0)->get();
		return view('acp.Booking.create', compact('areas', 'companies', 'settings', 'vehicleData', 'knows', 'receiveds'));
	}

	public function QuickCreate()
	{
		$companies = Company::whereNull('deleted_at')->get();
		$areas = Area::where('parint', 0)->get();
		return view('acp.Booking.QuickCreate', compact('areas', 'companies'));
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			"name" => "required",
			"booking_at" => "required",
			"phone" => "required",
			"nanonal_id" => "required",
			"from_area" => "required",
			"to_area" => "required",
			"order_day" => "required",
			"load" => "required|array",
			"num" => "required|array",
			"totalafterAll" => "required",
			"order_time" => "required",
		]);
		$Request = $request->all();
		$Request['created_by'] = Auth::user()->id;
		$Request['client_name'] = $request->name;
		$Request['client_phone'] = Str::replace('-', '', $request->phone);
		$Request['client_phone2'] = Str::replace('-', '', $request->phone2);
		$Request['received_by_phone'] = Str::replace('-', '', $request->received_phone);
		$Request['price'] = $request->totalafterAll;
		$Request['load_car'] = json_encode($request->load);
		$Request['expenses'] = json_encode($request->num);
		$Request['service'] = json_encode($request->service);

		if (is_numeric($request->from_area)) {
			$Request['from_area'] = $request->from_area;
		} else {
			$check_area_from = new Area();
			$check_area_from->name = $request->from_area;
			$check_area_from->parint = 487;
			$check_area_from->save();
			$Request['from_area'] = $check_area_from->id;
		}
		if (is_numeric($request->to_area)) {
			$Request['to_area'] = $request->to_area;
		} else {
			$check_area_to = new Area();
			$check_area_to->name = $request->to_area;
			$check_area_to->parint = 487;
			$check_area_to->save();
			$Request['to_area'] = $check_area_to->id;
		}

		$booking = Booking::create($Request);

		\Session::flash('msg', __('back.successfully_saved'));
		return redirect()->route('bookings.index');
	}

	public function show($id)
	{
		$booking = Booking::findOrFail($id);
		return view('acp.Booking.show', compact('booking'));
	}

	public function show_old($id)
	{
		$client = new Client();
		$res = $client->get('https://3.khater100100.xyz/api/order/'.$id);


		return View('acp.Booking.show_old', compact('res'));
	}

	public function SearchPhone(Request $request)
	{

		$phone = str_replace('-', '', $request->phone);
		$bookings = Booking::query()
			->where('client_phone', 'LIKE', "%{$phone}%")
			->orWhere('client_phone2', 'LIKE', "%{$phone}%")
			->orWhere('client_phone', 'LIKE', "%{$request->phone}%")
			->orWhere('client_phone2', 'LIKE', "%{$request->phone}%")
			->get();
		foreach ($bookings as $booking) {
			$status = '';
			if ($booking->status == 'inprocess' || $booking->status == 'waiting') {
				$status = 'warning';
			} elseif ($booking->status == 'finished') {
				$status = 'success';
			} elseif ($booking->status == 'inuploaded') {
				$status = 'info';
			} elseif ($booking->status == 'canceled') {
				$status = 'danger';
			}
			$booking->setAttribute('status_lable', '<span class="badge rounded-pill bg-' . $status . ' float-center">' . __('back.' . $booking->status) . '</span>');
			$booking->setAttribute('created', Carbon::parse($booking->booking_at)->format('d-m-Y'));
			$booking->setAttribute('create_by', $booking->user->name);
			$booking->setAttribute('from_address', $booking->fromArea ? $booking->fromArea->name : '');
			$booking->setAttribute('to_address', $booking->toArea ? $booking->toArea->name : '');
			$booking->setAttribute('view_order', route('bookings.edit',$booking->id));
		}
		$photo2 = '(' . explode('-', $request->phone)[0] . ') ' . substr($request->phone, 4);
		$oldorders = self::$conn_old->table('orders')
			->where("phone1", 'like', '%' . $photo2 . "%")
			->orWhere("phone2", 'like', '%' . $photo2 . "%")
			->orWhere('from_detail', 'like', '%' . $photo2 . "%")
			->orWhere('to_detail', 'like', '%' . $photo2 . "%")
			->orWhere('client_name', 'like', '%' . $photo2 . "%")
			->orWhere('orders.id', 'like', '%' . $photo2 . "%")
			->limit(20)
			->orderBy('orders.id', 'desc')
			->get();
		$oldorderss = [];
		foreach ($oldorders as $oldorder) {
			$oldorder = (array)$oldorder;
			$empolyee = self::$conn_old->table('admins')->where('id', $oldorder['empolyee_id'])->first();
			$oldorder['created_by'] = !is_null($empolyee) ? $empolyee->full_name : '';
			$oldorder['view_order'] = route('bookings.show.old',$oldorder['id']);
			$oldorder = (object)$oldorder;
			$oldorderss [] = $oldorder;
		}
		return response()->json([$bookings, $oldorderss]);
	}


	public function edit($id)
	{
		$booking = Booking::findOrFail($id);
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


		$settings = Setting::where('groupe', 'PRICING')->get();
		$companies = Company::whereNull('deleted_at')->get();
		$areas = Area::where('parint', 0)->get();
		$knows = Know::whereNull('deleted_at')->get();
		$receiveds = Received::whereNull('deleted_at')->get();

		return view('acp.Booking.edit', compact('areas', 'companies', 'settings', 'vehicleData', 'booking', 'knows', 'receiveds'));
	}


	public function update(Request $request, $id)
	{


		$this->validate($request, [
			"name" => "required",
			"booking_at" => "required",
			"phone" => "required",
			"nanonal_id" => "required",
			"from_area" => "required",
			"to_area" => "required",
			"order_day" => "required",
			"load" => "required|array",
			"num" => "required|array",
			"totalafterAll" => "required",
			"order_time" => "required",
		]);
		$Booking = Booking::findOrFail($id);
		$Request = $request->all();
		$Request['updated_by'] = Auth::user()->id;
		$Request['client_name'] = $request->name;
		$Request['client_phone'] = Str::replace('-', '', $request->phone);
		$Request['client_phone2'] = Str::replace('-', '', $request->phone2);
		$Request['received_by_phone'] = Str::replace('-', '', $request->received_phone);
		$Request['price'] = $request->totalafterAll;
		$Request['load_car'] = json_encode($request->load);
		$Request['expenses'] = json_encode($request->num);
		$Request['service'] = json_encode($request->service);

		if (is_numeric($request->from_area)) {
			$Request['from_area'] = $request->from_area;
		} else {
			$check_area_from = new Area();
			$check_area_from->name = $request->from_area;
			$check_area_from->parint = 487;
			$check_area_from->save();
			$Request['from_area'] = $check_area_from->id;
		}
		if (is_numeric($request->to_area)) {
			$Request['to_area'] = $request->to_area;
		} else {
			$check_area_to = new Area();
			$check_area_to->name = $request->to_area;
			$check_area_to->parint = 487;
			$check_area_to->save();
			$Request['to_area'] = $check_area_to->id;
		}

		$booking = $Booking->update($Request);

		\Session::flash('msg', __('back.successfully_saved'));
		return redirect()->route('bookings.index');
	}


	public function destroy($id)
	{
		$booking = Booking::findOrFail($id);
		$booking->deleted_at = Carbon::now();
		$booking->save();
		\Session::flash('msg', __('back.successfully_deleted'));
		return back();
	}

	public function rate(Request $request)
	{
		$booking = new Rate();
		$booking->callcenter = $request->rate_callcenter_star;
		$booking->callcenter_description = $request->rate_callcenter_note;
		$booking->driver = $request->rate_driver_star;
		$booking->driver_description = $request->rate_driver_note;
		$booking->booking_id = $request->id;
		$booking->created_by = Auth::user()->id;
		$booking->save();
		\Session::flash('msg', __('back.successfully_saved'));
		return back();
	}
}
