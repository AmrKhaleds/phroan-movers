<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayrollController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $payrolls = Payroll::whereNull('deleted_at')->get();
        foreach ($payrolls as $payroll) {
            if ($payroll->payroll_type == 'deduction') {
                $payroll->SetAttribute('color','danger');
                $payroll->SetAttribute('icon','uil-arrow-down');
            } else {
                $payroll->SetAttribute('color','success');
                $payroll->SetAttribute('icon','uil-arrow-up');
            }
                $payroll->SetAttribute('status_color',$payroll->status == 'HOLD' ? 'warning' : 'primary');
        }
        return view('acp.Payroll.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = User::whereNull('deleted_at')->get();
        return view('acp.Payroll.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|string',
            'type_value' => 'required|string',
            'payroll_type' => 'required|string',
            'val' => 'required|string',
            'reason' => 'required|string',
        ]);
        $emp = Employee::where('user_id', $request->user_id)->whereNull('deleted_at')->first();
        $final = $request->all();
        $final ['payroll_value'] = $request->type_value == '%' ? ($emp->sallary * $request->val) / 100 : $request->val;
        $final ['set_month'] = date('m');
        $final ['status'] = 'HOLD';
        $payroll = Payroll::create($final);

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }

    public function edit($id)
    {
        $employees = User::whereNull('deleted_at')->get();
        $payroll = Payroll::findOrFail($id);
        return view('acp.Payroll.edit', compact('payroll','employees'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required|string',
            'type_value' => 'required|string',
            'payroll_type' => 'required|string',
            'val' => 'required|string',
            'reason' => 'required|string',
        ]);
        $emp = Employee::where('user_id', $request->user_id)->whereNull('deleted_at')->first();
        $final = $request->all();
        $final ['payroll_value'] = $request->type_value == '%' ? ($emp->sallary * $request->val) / 100 : $request->val;
        $final ['set_month'] = date('m');
        $final ['status'] = 'HOLD';
        $payroll = Payroll::findOrFail($id);
        $payroll->update($final);

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function status($id)
    {
        $payroll = Payroll::findOrFail($id);
        if ($payroll->status == 'HOLD'){
            $payroll->status = 'APPROVE';
        }else{
            $payroll->status = 'HOLD';
        }
        $payroll->save();
        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


}
