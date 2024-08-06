<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account;
use Illuminate\Http\Request;

class CustomersBalanceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function CustomersBalance()
    {

//        $clients = User::where('type','client')->orderBy('id', 'desc')->get();
        $accounts = Account::where('parent_id',account_setting('accounting','sales','client_account')['value'])->get();
        return view('Dashboard.Accounting.CustomersBalance.customers_balances', compact('accounts'));
    }

    public function Show($id)
    {
        $client = User::findOrFail($id);
        $balances = [];
        return view('Dashboard.Accounting.CustomersBalance.show', compact('client','balances'));
    }

}
