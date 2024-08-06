<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $companies = Company::whereNull('deleted_at')->get();
        return view('acp.Company.index', compact('companies'));
    }

    public function create()
    {
        return view('acp.Company.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'logo' => 'required|file',
            'phone' => 'required|string',
            'whatsapp' => 'required|string',
            'address' => 'required|string',
            'manger' => 'required|string',
        ]);
        $final = $request->all();
        $final ['logo'] = uploadFile($request->logo);
        $company = Company::create($final);

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('acp.Company.edit', compact('company'));
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        $bookings = Booking::where('company_id',$company->id)->whereNull('deleted_at')->get();
        return view('acp.Company.show', compact('company','bookings'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required|string',
            'whatsapp' => 'required|string',
            'address' => 'required|string',
            'manger' => 'required|string',
        ]);
        $company = Company::findOrFail($id);
        $final = $request->all();
        if ($request->logo) {
            $final ['logo'] = uploadFile($request->logo);
        }else{
            $final ['logo'] = $company->logo;
        }
        $company->update($final);


        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->deleted_at = Carbon::now();
        $company->save();
        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }

}
