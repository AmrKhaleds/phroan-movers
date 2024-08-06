<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vehicles = Vehicle::whereNull('deleted_at')->get();
        return view('acp.Vehicle.index', compact('vehicles'));
    }


    public function create()
    {
        return view('acp.Vehicle.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'car_name' => 'required|string',
            'type_car' => 'required|string',
            'model_car' => 'required|string',
            'vehicle_number' => 'required|string',
            'license_num' => 'required|string',
            'license_to' => 'required|string',
        ]);
        $vehicle = Vehicle::create($request->all());

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('acp.Vehicle.edit',compact('vehicle'));
    }
    public function status($id,$status)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->status = $status;
        $vehicle->save();
        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'car_name' => 'required|string',
            'type_car' => 'required|string',
            'model_car' => 'required|string',
            'vehicle_number' => 'required|string',
            'license_num' => 'required|string',
            'license_to' => 'required|string',
        ]);
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->car_name = $request->car_name;
        $vehicle->type_car = $request->type_car;
        $vehicle->model_car = $request->model_car;
        $vehicle->vehicle_number = $request->vehicle_number;
        $vehicle->license_num = $request->license_num;
        $vehicle->license_to = $request->license_to;
        $vehicle->save();

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->deleted_at = Carbon::now();
        $vehicle->save();
        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }
}
