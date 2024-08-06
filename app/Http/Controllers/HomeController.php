<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Employee;
use App\Models\OrderExpense;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use function GuzzleHttp\json_encode;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $period = $request->period ? $request->period : 'today';
        if (is_null($request->period) || $request->period == 'today') {
            $stamte = Carbon::now();
        } elseif ($request->period == 'week') {
            $stamte = Carbon::now()->subWeek();
        } elseif ($request->period == 'month') {
            $stamte = Carbon::now()->subMonth();
        } elseif ($request->period == 'year') {
            $stamte = Carbon::now()->subYear();
        }

        $expenses = OrderExpense::whereDate('created_at', '>=', $stamte)->whereNull('deleted_at')->sum('cost');
        $bookings = Booking::where('booking_at', '>=', $stamte)->whereNull('deleted_at')->get();
        $vehicles = Vehicle::whereNull('deleted_at')->get();
        $vehicleData = Vehicle::whereNull('deleted_at')->get();
        $category = Category::where('title', 'LIKE', "%سواق%")->OrWhere('title', 'LIKE', "%سائق%")->whereNull('deleted_at')->first(['id']);
        $category_call_center = Category::where('title', 'كول سنتر')->OrWhere('title', 'تيم ليدر')->whereNull('deleted_at')->get(['id'])->toArray();
        $category_call_center = array_column($category_call_center, 'id');

        $users = Employee::select('user_id as id')->where('category_id', $category->id)->whereNull('deleted_at')->get();
        $users_call = Employee::select('user_id as id')->whereIn('category_id', $category_call_center)->whereNull('deleted_at')->get();
        $call_center = User::whereIn('id', $users_call)->whereNull('deleted_at')->get(['name'])->toArray();
        $drivers = User::whereIn('id', $users)->whereNull('deleted_at')->get(['name'])->toArray();
        $drivers = array_column($drivers, 'name');
        $call_center = array_column($call_center, 'name');
        $booking_drivers = [];

        foreach ($users as $user) {
            $booking_drivers [] = $bookings->where('driver_id', $user->id)->count();
        }
        $booking_callcenters = [];
        foreach ($users_call as $call_center_user) {
            $booking_callcenters [] = $bookings->where('created_by', $call_center_user->id)->count();
        }

        if (is_null($request->period) || $request->period == 'today') {
            $label = ['categories' => ['1' . __('back.am'), '2' . __('back.am'), '3' . __('back.am'), '4' . __('back.am'), '5' . __('back.am'), '6' . __('back.am'), '7' . __('back.am'), '8' . __('back.am'), '9' . __('back.am'), '10' . __('back.am'), '11' . __('back.am'), '12' . __('back.am'), '1' . __('back.pm'), '2' . __('back.pm'), '3' . __('back.pm'), '4' . __('back.pm'), '5' . __('back.pm'), '6' . __('back.pm'), '7' . __('back.pm'), '8' . __('back.pm'), '9' . __('back.pm'), '10' . __('back.pm'), '11' . __('back.pm'), '12' . __('back.pm')]];

            $cancelKeys = ['00' => 0, '01' => 0, '02' => 0, '03' => 0, '04' => 0, '05' => 0, '06' => 0, '07' => 0, '08' => 0, '09' => 0, '10' => 0, '11' => 0, '12' => 0, '13' => 0, '14' => 0, '15' => 0, '16' => 0, '17' => 0, '18' => 0, '19' => 0, '20' => 0, '21' => 0, '22' => 0, '23' => 0];
            $sureKeys = ['00' => 0, '01' => 0, '02' => 0, '03' => 0, '04' => 0, '05' => 0, '06' => 0, '07' => 0, '08' => 0, '09' => 0, '10' => 0, '11' => 0, '12' => 0, '13' => 0, '14' => 0, '15' => 0, '16' => 0, '17' => 0, '18' => 0, '19' => 0, '20' => 0, '21' => 0, '22' => 0, '23' => 0];
            $waitingKeys = ['00' => 0, '01' => 0, '02' => 0, '03' => 0, '04' => 0, '05' => 0, '06' => 0, '07' => 0, '08' => 0, '09' => 0, '10' => 0, '11' => 0, '12' => 0, '13' => 0, '14' => 0, '15' => 0, '16' => 0, '17' => 0, '18' => 0, '19' => 0, '20' => 0, '21' => 0, '22' => 0, '23' => 0];
            $sureBooks = Booking::where('status', 'finished')->where('booking_at', '>=', $stamte)->whereNull('deleted_at')->get()->groupBy(function ($date) {
                return Carbon::parse($date->booking_at)->format('H');
            })->toArray();
            $cancelBooks = Booking::where('status', 'canceled')->where('booking_at', '>=', $stamte)->whereNull('deleted_at')->get()->groupBy(function ($date) {
                return Carbon::parse($date->booking_at)->format('H');
            })->toArray();
            $waitingBooks = Booking::where('status', 'inprocess')->where('booking_at', '>=', $stamte)->whereNull('deleted_at')->get()->groupBy(function ($date) {
                $date->booking_at = str_replace('T', ' ', $date->booking_at);
//                dd($date->booking_at);
                return Carbon::parse($date->booking_at)->format('H');
//                return \DateTime::createFromFormat('H:i:s', $date->booking_at)->format('H');
            })->toArray();
        } elseif ($request->period == 'week') {
            $label = ['categories' => [__('back.sat'), __('back.sun'), __('back.mon'), __('back.tues'), __('back.wedn'), __('back.thur'), __('back.fri')]];
            $cancelKeys = ['0' => 0, '1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0];
            $sureKeys = ['0' => 0, '1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0];
            $waitingKeys = ['0' => 0, '1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0];


            $sureBooks = Booking::where('status', 'finished')->where('booking_at', '>=', $stamte)->whereNull('deleted_at')->get()->groupBy(function ($date) {
                return Carbon::parse($date->booking_at)->format('D');
            })->toArray();
            $cancelBooks = Booking::where('status', 'canceled')->where('booking_at', '>=', $stamte)->whereNull('deleted_at')->get()->groupBy(function ($date) {
                return Carbon::parse($date->booking_at)->format('D');
            })->toArray();
            $waitingBooks = Booking::where('status', 'inprocess')->where('booking_at', '>=', $stamte)->whereNull('deleted_at')->get()->groupBy(function ($date) {
                return Carbon::parse($date->booking_at)->format('D');
            })->toArray();

        } elseif ($request->period == 'month') {
            $label = ['categories' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30]];

            $cancelKeys = ['01' => 0, '02' => 0, '03' => 0, '04' => 0, '05' => 0, '06' => 0, '07' => 0, '08' => 0, '09' => 0, '10' => 0, '11' => 0, '12' => 0, '13' => 0, '14' => 0, '15' => 0, '16' => 0, '17' => 0, '18' => 0, '19' => 0, '20' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '25' => 0, '26' => 0, '27' => 0, '28' => 0, '29' => 0, '30' => 0,];
            $sureKeys = ['01' => 0, '02' => 0, '03' => 0, '04' => 0, '05' => 0, '06' => 0, '07' => 0, '08' => 0, '09' => 0, '10' => 0, '11' => 0, '12' => 0, '13' => 0, '14' => 0, '15' => 0, '16' => 0, '17' => 0, '18' => 0, '19' => 0, '20' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '25' => 0, '26' => 0, '27' => 0, '28' => 0, '29' => 0, '30' => 0,];
            $waitingKeys = ['01' => 0, '02' => 0, '03' => 0, '04' => 0, '05' => 0, '06' => 0, '07' => 0, '08' => 0, '09' => 0, '10' => 0, '11' => 0, '12' => 0, '13' => 0, '14' => 0, '15' => 0, '16' => 0, '17' => 0, '18' => 0, '19' => 0, '20' => 0, '21' => 0, '22' => 0, '23' => 0, '24' => 0, '25' => 0, '26' => 0, '27' => 0, '28' => 0, '29' => 0, '30' => 0,];

            $sureBooks = Booking::where('status', 'finished')->where('booking_at', '>=', $stamte)->whereNull('deleted_at')->get()->groupBy(function ($date) {
                return Carbon::parse($date->booking_at)->format('d');
            })->toArray();
            $cancelBooks = Booking::where('status', 'canceled')->where('booking_at', '>=', $stamte)->whereNull('deleted_at')->get()->groupBy(function ($date) {
                return Carbon::parse($date->booking_at)->format('d');
            })->toArray();
            $waitingBooks = Booking::where('status', 'inprocess')->where('booking_at', '>=', $stamte)->whereNull('deleted_at')->get()->groupBy(function ($date) {
                return Carbon::parse($date->booking_at)->format('d');
            })->toArray();

        } elseif ($request->period == 'year') {
            $label = ['categories' => [__('back.jan'), __('back.feb'), __('back.mar'), __('back.apr'), __('back.may'), __('back.june'), __('back.july'), __('back.Aug'), __('back.Sep'), __('back.oct'), __('back.nov'), __('back.dec')]];
            $cancelKeys = ['01' => 0, '02' => 0, '03' => 0, '04' => 0, '05' => 0, '06' => 0, '07' => 0, '08' => 0, '09' => 0, '10' => 0, '11' => 0, '12' => 0];
            $sureKeys = ['01' => 0, '02' => 0, '03' => 0, '04' => 0, '05' => 0, '06' => 0, '07' => 0, '08' => 0, '09' => 0, '10' => 0, '11' => 0, '12' => 0];
            $waitingKeys = ['01' => 0, '02' => 0, '03' => 0, '04' => 0, '05' => 0, '06' => 0, '07' => 0, '08' => 0, '09' => 0, '10' => 0, '11' => 0, '12' => 0];


            $sureBooks = Booking::where('status', 'finished')->where('booking_at', '>=', $stamte)->whereNull('deleted_at')->get()->groupBy(function ($date) {
                return Carbon::parse($date->booking_at)->format('m');
            })->toArray();
            $cancelBooks = Booking::where('status', 'canceled')->where('booking_at', '>=', $stamte)->whereNull('deleted_at')->get()->groupBy(function ($date) {
                return Carbon::parse($date->booking_at)->format('m');
            })->toArray();
            $waitingBooks = Booking::where('status', 'inprocess')->where('booking_at', '>=', $stamte)->whereNull('deleted_at')->get()->groupBy(function ($date) {
                return Carbon::parse($date->booking_at)->format('m');
            })->toArray();
        }


        foreach ($cancelBooks as $keyCancel => $cancelBook) {
            $cancelKeys [$keyCancel] = count($cancelBook);
        }
        foreach ($sureBooks as $keySure => $sureBook) {
            $sureKeys [$keySure] = count($sureBook);
        }
        foreach ($waitingBooks as $keyWaiting => $waitingBook) {
            $waitingKeys [$keyWaiting] = count($waitingBook);
        }
        $valuesSeries = [
            ['name' => __('back.canceling'), 'data' => array_values($cancelKeys)],
            ['name' => __('back.sure'), 'data' => array_values($sureKeys)],
            ['name' => __('back.waiting'), 'data' => array_values($waitingKeys)],
        ];
//dd($valuesSeries,$label);

        return view('acp.home', compact( 'bookings', 'expenses', 'vehicles', 'drivers', 'booking_drivers', 'label', 'valuesSeries', 'cancelKeys', 'period', 'vehicleData', 'booking_callcenters','call_center'));
    }


    public function deploy(){
        return Artisan::call('migrate');
    }
}
