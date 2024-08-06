<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\OrderExpense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Setting;

class OrderExpenseController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}


	public function index()
	{
		$expenses = OrderExpense::whereNull('deleted_at')->get();

		return view('acp.OrderExpense.index', compact('expenses'));
	}

	public function create($id)
	{
		$booking = Booking::findOrFail($id);
		$expense = OrderExpense::where('booking_id', $booking->id)->get()->toArray();
		$settings = Setting::where('groupe', 'PRICING')->get();
		return view('acp.OrderExpense.create', compact('booking', 'settings', 'expense'));
	}


	public function store(Request $request)
	{
		$this->validate($request, [
			'booking_id' => 'required',
//            'cost' => 'required',
//            'reason' => 'required',
//            'expense_type' => 'required',
		]);
		$expense = OrderExpense::where('booking_id', $request->booking_id)->get()->toArray();
//		if (empty($expense)) {
			$text = [];
			foreach ($request->cost as $key => $value) {
				if ($value) {
					$text [] = __('back.' . $request->reason[$key]) . $value . __('back.l.e');
					$data =
						[
							'booking_id' => $request->booking_id,
							'cost' => $value,
							'reason' => __('back.' . $request->reason[$key]),
							'expense_type' => 'expense',
						];

					$expense = OrderExpense::create($data);
				}
			}
			if ($request->reason_more && $request->cost_more && $request->expense_type_more) {
				foreach ($request->reason_more as $k => $more) {
					$addons = [];
//				if ($more == 'deposit') {
					if ($request->payment_method) {
						$text [] = __('back.' . $request->reason_more[$k]) . $request->cost_more[$k] . __('back.l.e');
						$addons =
							[
								'booking_id' => $request->booking_id,
								'cost' => $request->cost_more[$k],
								'reason' => $request->reason_more[$k],
								'expense_type' => $request->expense_type_more[$k],
								'deposit' => $request->payment_method,
							];
					} else if ($request->cost_more[$k] && $request->reason_more[$k]) {
						$text [] = $request->reason_more[$k] . $request->cost_more[$k] . __('back.l.e');
						$addons =
							[
								'booking_id' => $request->booking_id,
								'cost' => $request->cost_more[$k],
								'reason' => $request->reason_more[$k],
								'expense_type' => $request->expense_type_more[$k],
							];
					}
					if (!empty($addons) && !is_null($addons['cost'])) {
//						dd($addons);
						OrderExpense::create($addons);
					}
				}

			}
//		}

/*
		else{
			$text = [];
			foreach ($request->cost as $key => $value) {
				if ($value) {
					$text [] = __('back.' . $request->reason[$key]) . $value . __('back.l.e');
					$data =
						[
							'booking_id' => $request->booking_id,
							'cost' => $value,
							'reason' => __('back.' . $request->reason[$key]),
							'expense_type' => 'expense',
						];

					$expense = OrderExpense::where('reason',__('back.' . $request->reason[$key]))->first();
					$expense->update($data);
				}
			}
			if ($request->reason_more && $request->cost_more && $request->expense_type_more) {
				foreach ($request->reason_more as $k => $more) {
					$addons = [];
//				if ($more == 'deposit') {
					if ($request->payment_method) {
						$text [] = __('back.' . $request->reason_more[$k]) . $request->cost_more[$k] . __('back.l.e');
						$addons =
							[
								'booking_id' => $request->booking_id,
								'cost' => $request->cost_more[$k],
								'reason' => $request->reason_more[$k],
								'expense_type' => $request->expense_type_more[$k],
								'deposit' => $request->payment_method,
							];
					} else if ($request->cost_more[$k] && $request->reason_more[$k]) {
						$text [] = $request->reason_more[$k] . $request->cost_more[$k] . __('back.l.e');
						$addons =
							[
								'booking_id' => $request->booking_id,
								'cost' => $request->cost_more[$k],
								'reason' => $request->reason_more[$k],
								'expense_type' => $request->expense_type_more[$k],
							];
					}
					if (!empty($addons)) {
						$expense = OrderExpense::where('reason',__('back.' . $request->reason[$key]))->first();
						$expense->update($data);					}
				}

			}
		}
*/
		$booking = Booking::find($request->booking_id);

		$url = 'https://web.whatsapp.com/send?phone=+2' . User::find(json_decode($booking->driver_id)[0])->employee->whatsapp . '&text=' . implode('__<br>__', $text);

		echo "<script>window.location.open('" . $url . "', '_blank')</script>";

		\Session::flash('msg', __('back.successfully_saved'));

		return back();
	}

	public function destroy($id)
	{
		$expense = OrderExpense::findOrFail($id);
		$expense->deleted_at = Carbon::now();
		$expense->save();
		\Session::flash('msg', __('back.successfully_deleted'));
		return back();
	}


}
