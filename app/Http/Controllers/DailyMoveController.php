<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyMove;
use App\Models\Account;
use App\Models\DailyMoveItem;
use App\Models\PaymentsMethod;
use Illuminate\Support\Facades\Auth;

class DailyMoveController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dailymoves = DailyMove::all();
        return view('acp.Accounting.DailyMove.index', compact('dailymoves'));
    }

    public function create()
    {
        $accounts = Account::where('parent_id','!=',0)->get();
        $last = DailyMove::where('type_name', 'DailyMove')->latest()->first();
        $payments = PaymentsMethod::all();
        return view('acp.Accounting.DailyMove.create', compact('accounts','last','payments'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'num_dailymove' => 'required|string',
            'date' => 'required|string',
            'account_id' => 'required|array',
            'debtor' => 'required|array',
            'creditor' => 'required|array',
            'debtorTotal' => 'required|string',
            'creditorTotal' => 'required|string',
        ]);
        $daily_move = new DailyMove();
        $daily_move->date = $request->date;
        $daily_move->registration_number = $request->num_dailymove;
        $daily_move->created_by = Auth::user()->id;
        $daily_move->payments_method_id = $request->payments_method_id;
        $daily_move->debtor = $request->debtorTotal;
        $daily_move->creditor = $request->creditorTotal;
        $daily_move->type = 'قيض مبيعات';
        $daily_move->type_name = 'DailyMove';
        $daily_move->document = $request->document ? uploadFile($request->document, null, 'new') : null;
        $daily_move->notes = $request->notes;
        $daily_move->save();
        foreach ($request->account_id as $index => $value) {
            $item = new DailyMoveItem();
            $item->account_id = $request->account_id[$index];
            $item->creditor = $request->creditor[$index];
            $item->debtor = $request->debtor[$index];
            $item->notes = $request->noteItem ? $request->noteItem[$index] : '';
            $item->daily_move_id = $daily_move->id;
            $item->save();
            $accou = Account::findOrFail($item->account_id[$index]);
            $accou->balance = $accou->balance + ($item->creditor[$index] + $item->debtor[$index]);
            $accou->save();
        }
        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function edit($id)
    {
        $accounts = Account::all();
        $daily_move = DailyMove::findOrFail($id);

        return view('acp.Accounting.DailyMove.edit', compact('accounts', 'daily_move'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'reference' => 'required|string',
            'num_dailymove' => 'required|string',
            'date' => 'required|string',
            'account_id' => 'required|array',
            'debtor' => 'required|array',
            'creditor' => 'required|array',
            'debtorTotal' => 'required|string',
            'creditorTotal' => 'required|string',
            'notes' => 'required|string',
        ]);
        $daily_move = DailyMove::findOrFail($id);
        $daily_move->ref = $request->reference;
        $daily_move->date = $request->date;
        $daily_move->registration_number = $request->num_dailymove;
        $daily_move->created_by = Auth::user()->id;
        $daily_move->debtor = $request->debtorTotal;
        $daily_move->creditor = $request->creditorTotal;
        $daily_move->document = $request->document ? uploadFile($request->document, null, 'new') : null;
        $daily_move->notes = $request->notes;
        $daily_move->save();
        foreach ($daily_move->dailyMoveItem as $dailyMoveItem) {
            $dailyMoveItem->delete();
        }
        foreach ($request->account_id as $index => $value) {
            $item = new DailyMoveItem();
            $item->account_id = $request->account_id[$index];
            $item->creditor = $request->creditor[$index];
            $item->debtor = $request->debtor[$index];
            $item->notes = $request->noteItem ? $request->noteItem[$index] : '';
            $item->daily_move_id = $daily_move->id;
            $item->save();

        }

        \Session::flash('msg', __('back.successfully_updated'));
        return back();
    }


    public function destroy($id)
    {
        $daily_move = DailyMove::findOrFail($id);
        foreach ($daily_move->dailyMoveItem as $dailyMoveItem) {
            $dailyMoveItem->delete();
        }
        $daily_move->delete();

        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }

}