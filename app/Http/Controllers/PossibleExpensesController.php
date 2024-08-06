<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PossibleExpenses;

class PossibleExpensesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $expenses = PossibleExpenses::whereNull('deleted_at')->get();
        return view('acp.PossibleExpenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('acp.PossibleExpenses.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'expense_name' => 'required|string',
            'cost' => 'required|string',
            'expense_type' => 'required|string',
        ]);
        $expenses = PossibleExpenses::create($request->all());

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }

    public function edit($id)
    {
        $expense = PossibleExpenses::findOrFail($id);
        return view('acp.PossibleExpenses.edit', compact('expense'));
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
            'expense_name' => 'required|string',
            'cost' => 'required|string',
            'expense_type' => 'required|string',
        ]);

        $expenses = PossibleExpenses::findOrFail($id);
        $expenses->update($request->all());

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function destroy($id)
    {
        $expenses = PossibleExpenses::findOrFail($id);
        $expenses->deleted_at = Carbon::now();
        $expenses->save();
        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }

}
