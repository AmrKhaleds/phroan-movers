<?php

namespace App\Http\Controllers;

use App\Models\AssignCar;
use App\Models\Category;
use App\Models\Booking;
use App\Models\Employee;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class AssignCarController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth')->except('leave_all');
	}

	public function index($id)
	{

		$category = Category::where('title', 'LIKE', "%سواق%")->OrWhere('title', 'LIKE', "%سائق%")->whereNull('deleted_at')->first(['id']);
		$users = Employee::where('category_id', $category->id)->whereNull('deleted_at')->get(['user_id']);
		$drivers = User::whereIn('id', $users)->whereNull('deleted_at')->get();
		$assigns = AssignCar::where('vehicle_id', $id)->whereNull('deleted_at')->get();
		return view('acp.AssignCar.index', compact('drivers', 'assigns', 'id'));
	}

	public function store(Request $request, $id)
	{
		$this->validate($request, [
			'user_id' => 'required',
			'counter_number' => 'required|numeric',
		]);
		$Request = $request->all();
		$Request ['created_by'] = Auth::user()->name;
		$Request ['vehicle_id'] = $id;

		$assign = AssignCar::create($Request);

		\Session::flash('msg', __('back.successfully_saved'));
		return back();
	}

	public function storeAssign(Request $request)
	{
		$this->validate($request, [
			'user_id' => 'required',
			'counter_number' => 'required',
			'car_id' => 'required',
			'booking_id' => 'required',
		]);
		$booking = Booking::find($request->booking_id);


//		dd(json_decode($booking->assign_car_id),$request->all());
		/*
			$vehicle = Vehicle::find($request->car_id);
	        $vehicle->assign_car_id = $assign->id;
		    $vehicle->save();
		*/
		if ($request->type == 'edit'){
			$assign = AssignCar::whereIn('id',json_decode($booking->assign_car_id))->delete();
		}
		$assign_id =[];
		foreach ($request->user_id as $k => $user) {

			$Request = $request->except(['user_id','car_id']);
			$Request ['user_id'] = $user;
			$Request ['created_by'] = Auth::user()->name;
			$Request ['carpenter_id'] = json_encode($request->carpenter_id);
			$Request ['wrapping_id'] = json_encode($request->wrapping_id);
			$Request ['vehicle_id'] = $request->car_id[$k];
			$Request ['crane_id'] = $request->crane_id;
			$Request ['HVAC_technician_id'] = json_encode($request->HVAC_technician_id);
			$Request ['worker_id'] = json_encode($request->worker_id);
			$Request ['booking_id'] = $booking->id;
//			$Request ['user_id'] = json_encode($request->user_id);
//			$Request ['vehicle_id'] = json_encode($request->vehicle_id);

			$assign = AssignCar::create($Request);
			$assign_id []= $assign->id;
		}



//		$booking->vehicle_id = $vehicle->id;
		$booking->vehicle_id = json_encode($request->car_id);
//		$booking->driver_id = $request->user_id;
		$booking->driver_id = json_encode($request->user_id);
		$booking->assign_car_id = json_encode($assign_id);
		$booking->assign_at = date('Y-m-d H:i:s');
		$booking->status = 'finished';
		$booking->save();



		\Session::flash('msg', __('back.successfully_saved'));
		return back();
	}

	public function leave($id)
	{
		$vehicle = Vehicle::find($id);
		$vehicle->assign_car_id = null;
		$vehicle->save();

		\Session::flash('msg', __('back.successfully_saved'));
		return back();
	}

	public function leave_all()
	{
//        32
		/*$vehicle = Vehicle::find(14);
		$vehicle->assign_car_id = null;
		$vehicle->save();*/

		$vehicles = Vehicle::whereNull('deleted_at')->get();
		foreach ($vehicles as $vehicle) {
			$vehicle->assign_car_id = null;
			$vehicle->save();
		}

		return TRUE;
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'user_id' => 'required',
			'counter_number' => 'required|numeric',
		]);
		$Request = $request->all();
		$Request ['updated_by'] = Auth::user()->name;
		$assign = AssignCar::findOrFail($id);
		$assign->update($Request);

		\Session::flash('msg', __('back.successfully_saved'));
		return back();
	}

	public function destroy($id)
	{
		$assign = AssignCar::findOrFail($id);
		$assign->deleted_at = Carbon::now();
		$assign->save();
		\Session::flash('msg', __('back.successfully_deleted'));
		return back();
	}

}
