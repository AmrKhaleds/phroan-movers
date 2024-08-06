<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Employee;
use App\Models\Maintenance;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $maintenances = Maintenance::whereNull('deleted_at')->get();
        return view('acp.Maintenance.index', compact('maintenances'));
    }

    public function create()
    {
        $drivers = User::where('email','!=','admin@admin.admin')->whereNull('deleted_at')->get();
        $vehicles = Vehicle::whereNull('deleted_at')->get();

        return view('acp.Maintenance.create',compact('drivers','vehicles'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'damaged' => 'required',
            'cost_maintenance' => 'required',
            'maintenance_manager' => 'required',
            'maintenance_date' => 'required',
            'counter_number' => 'required',
            'vehicle_id' => 'required',
        ]);
        $maintenance = Maintenance::create($request->all());

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function edit($id)
    {
        $drivers = User::where('email','!=','admin@admin.admin')->whereNull('deleted_at')->get();
        $vehicles = Vehicle::whereNull('deleted_at')->get();
        $maintenances = Maintenance::findOrFail($id);

        return view('acp.Maintenance.edit',compact('drivers','vehicles','maintenances'));
    }


    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'damaged' => 'required',
            'cost_maintenance' => 'required',
            'maintenance_manager' => 'required',
            'maintenance_date' => 'required',
            'counter_number' => 'required',
            'vehicle_id' => 'required',
        ]);
        $maintenance  = Maintenance::findOrFail($id);
        $maintenance->update($request->all());

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function destroy($id)
    {
        $maintenance  = Maintenance::findOrFail($id);
        $maintenance->deleted_at = Carbon::now();
        $maintenance->save();
        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }

}
