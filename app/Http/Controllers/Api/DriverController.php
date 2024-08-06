<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use App\Models\Revenue;
use App\Models\Attendant;
use App\Models\AssignCar;
use App\Models\Maintenance;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class DriverController extends Controller
{
    public function Home(Request $request)
    {
        if ($user = CheckAccessToken($request->header('Authorization'))) {
            $bookings = Booking::where('driver_id', $user->id)->whereNull('deleted_at')->get();
//            $revenues = Revenue::where('created_at', Carbon::now())->where('user_id', $user->id)->sum('cost');
            $revenues = Revenue::where('user_id', $user->id)->sum('cost');
            $assigns = AssignCar::where('user_id', $user->id)->whereNull('deleted_at')->latest()->first();
            $maintenances = Maintenance::where('vehicle_id', $assigns->vehicle_id)->whereNull('deleted_at')->sum('cost_maintenance');
            $data = [
                'orders_assigned_me' => (int)$bookings->count(),
                'orders_finished' => (int)$bookings->where('status', 'finished')->count(),
                'orders_pending' => (int)$bookings->where('status', 'inprocess')->count(),
                'orders_costs' => (int)$bookings->sum('price'),
                'revenues' => (int)$revenues,
                'expenses' => (int)$maintenances,
            ];
            return api_response(1, __('api.home'), $data);
        } else {
            return api_response(0, __("api.Unauthorized"), null, 401);
        }

    }

    public function current(Request $request)
    {
        if ($user = CheckAccessToken($request->header('Authorization'))) {
            $bookings = Booking::where('status', '!=', 'finished')->where('driver_id', $user->id)->whereNull('deleted_at')->orderBy('id', 'DESC')->get();

            $data = [];
            foreach ($bookings as $booking) {
                $data [] = [
                    'id' => $booking->id,
                    'client_name' => $booking->client_name,
                    'client_phone' => $booking->client_phone,
                    'km' => $booking->km,
                    'price' => $booking->price,
                    'from_area' => $booking->fromArea->name,
                    'to_area' => $booking->toArea->name,
                ];

            }
            $total = count($data);
            $per_page = 15;
            $current_page = $request->page ?? 1;
            $starting_point = ($current_page * $per_page) - $per_page;

            $data = array_slice($data, $starting_point, $per_page, true);
//            foreach ($datas as $dat) {
//                $data [] = $dat;
//            }
//            dd($data);

            $data = new Paginator($data, $total, $per_page, $current_page, [
                'path' => url('api/driver/current')]);
            $data = $data->toArray();

            return api_response(1, __('api.current'), $data);
        } else {
            return api_response(0, __("api.Unauthorized"), null, 401);
        }

    }

    public function olders(Request $request)
    {
        if ($user = CheckAccessToken($request->header('Authorization'))) {
//            $bookings = Booking::where('status', 'finished')->where('driver_id', $user->id)->where('created_at','<=', Carbon::now())->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
            $bookings = Booking::where('status', 'finished')->where('driver_id', $user->id)->whereNull('deleted_at')->orderBy('id', 'DESC')->get();

            $data = [];
            foreach ($bookings as $booking) {
                $data [] = [
                    'id' => $booking->id,
                    'client_name' => $booking->client_name,
                    'client_phone' => $booking->client_phone,
                    'km' => $booking->km,
                    'price' => $booking->price,
                    'from_area' => $booking->fromArea->name,
                    'to_area' => $booking->toArea->name,
                ];
            }
            $total = count($data);
            $per_page = 15;
            $current_page = $request->page ?? 1;
            $starting_point = ($current_page * $per_page) - $per_page;

            $data = array_slice($data, $starting_point, $per_page, true);
//            foreach ($datas as $dat) {
//                $data [] = $dat;
//            }
//            dd($data);

            $data = new Paginator($data, $total, $per_page, $current_page, [
                'path' => url('api/driver/olders')]);
            $data = $data->toArray();

            return api_response(1, __('api.olders'), $data);
        } else {
            return api_response(0, __("api.Unauthorized"), null, 401);
        }

    }

    public function order(Request $request)
    {
        if ($user = CheckAccessToken($request->header('Authorization'))) {
            $booking = Booking::find($request->id);
            $data = [
                'id' => $booking->id,
                'client_name' => $booking->client_name,
                'client_phone' => $booking->client_phone,
                'created_at' => $booking->created_at,
                'order_num' => '#WF' . $booking->created_at->format('Ymdhi' . $booking->id),
                'from_address' => $booking->from_address,
                'to_address' => $booking->to_address,
                'from_area' => $booking->fromArea->name,
                'to_area' => $booking->toArea->name,
                'km' => $booking->km,
                'price' => $booking->price,
                'vehicle_brand' => $booking->vehicle_brand,
                'vehicle_status' => __('back.' . $booking->vehicle_status),
                'vehicle_number' => $booking->vehicle_number,
                'color_number' => $booking->color_number,
                'own_key' => $booking->own_key == 'on' ? 'on' : 'null',
                'own_license' => $booking->own_license == 'on' ? 'on' : 'null',
                'owner' => $booking->owner == 'on' ? 'on' : 'null',
                'whatsapp_api' => 'https://wa.me/+2' . $booking->client_phone,
                'status' => __('back.' . $booking->status),
            ];

            return api_response(1, __('api.order'), $data);
        } else {
            return api_response(0, __("api.Unauthorized"), null, 401);
        }

    }

    public function ChangeStatus(Request $request)
    {
        if ($user = CheckAccessToken($request->header('Authorization'))) {

            $booking = Booking::find($request->id);

            if ($booking->status == 'inprocess') {
                $booking->status = 'inuploaded';
            } elseif ($booking->status == 'inuploaded') {
                $booking->status = 'finished';
            }
            $booking->save();

            $data = $this->order($request);
            return api_response(1, __('api.status_changed'), $data);
        } else {
            return api_response(0, __("api.Unauthorized"), null, 401);
        }

    }

    public function attendant(Request $request)
    {
        if ($user = CheckAccessToken($request->header('Authorization'))) {
            $attendant = new Attendant();
            $attendant->user_id = $user->id;
            $attendant->check_at = date('Y-m-d H:i:s');
            $attendant->type = $request->type;
            $attendant->save();
            return api_response(1, __('api.checked'), []);
        } else {
            return api_response(0, __("api.Unauthorized"), null, 401);
        }

    }

    public function AddRevenues(Request $request)
    {
        if ($user = CheckAccessToken($request->header('Authorization'))) {

            $revenue = new Revenue();
            $revenue->cost = $request->cost;
            $revenue->status = 'HOLD';
            $revenue->user_id = $user->id;
            $revenue->booking_id = $request->order_id;
            $revenue->note = $request->note;
            $revenue->save();
            $request->id = $request->order_id;
            return $data = $this->order($request)->original;
        } else {
            return api_response(0, __("api.Unauthorized"), null, 401);
        }
    }

    public function Revenues(Request $request)
    {
        if ($user = CheckAccessToken($request->header('Authorization'))) {
            $revenues = Revenue::where('user_id', $user->id)->get();
            $data = [];
            $total_cost = 0;
            foreach ($revenues as $revenue) {
                $total_cost += $revenue->cost;
                $data [] = [
                    'cost' => $revenue->cost,
                    'created_at' => $revenue->created_at,
                    'status' => __('back.' . $revenue->status),
                    'order_num' => '#WF' . $revenue->booking->created_at->format('Ymdhi' . $revenue->booking->id),
                ];
            }
            $total = count($data);
            $per_page = 15;
            $current_page = $request->page ?? 1;
            $starting_point = ($current_page * $per_page) - $per_page;

            $data = array_slice($data, $starting_point, $per_page, true);

            $data = new Paginator($data, $total, $per_page, $current_page, [
                'path' => url('api/driver/revenues')]);
            $data = $data->toArray();
            $data ['total_cost'] = $total_cost;
            return api_response(1, __('api.revenue_today'), $data);
        } else {
            return api_response(0, __("api.Unauthorized"), null, 401);
        }
    }

    public function expenses(Request $request)
    {
        if ($user = CheckAccessToken($request->header('Authorization'))) {
            $assigns = AssignCar::where('user_id', $user->id)->whereNull('deleted_at')->latest()->first();
            $maintenances = Maintenance::where('vehicle_id', $assigns->vehicle_id)->whereNull('deleted_at')->get();
            $data = [];
            $total_cost = 0;
            foreach ($maintenances as $maintenance) {
                $total_cost += $maintenance->cost_maintenance;
                $data [] = [
                    'expense_cost' => $maintenance->cost_maintenance,
                    'status' => __('api.APPROVED'),
                    'cause_damage' => $maintenance->damaged,
                ];
            }
            $total = count($data);
            $per_page = 15;
            $current_page = $request->page ?? 1;
            $starting_point = ($current_page * $per_page) - $per_page;

            $data = array_slice($data, $starting_point, $per_page, true);

            $data = new Paginator($data, $total, $per_page, $current_page, [
                'path' => url('api/driver/expenses')]);
            $data = $data->toArray();
            $data ['total_cost'] = $total_cost;
            return api_response(1, __('api.expense_today'), $data);
        } else {
            return api_response(0, __("api.Unauthorized"), null, 401);
        }
    }

    public function Reports(Request $request)
    {
        if ($user = CheckAccessToken($request->header('Authorization'))) {
//            today || week || month || year

            if ($request->period == 'today') {
                $time = Carbon::now();
            } elseif ($request->period == 'week') {
                $time = Carbon::now()->subWeek();
            } elseif ($request->period == 'month') {
                $time = Carbon::now()->subMonth();
            } elseif ($request->period == 'year') {
                $time = Carbon::now()->subYear();
            } else {
                $time = Carbon::now();
            }
            $bookings = Booking::where('created_at', '>=',$time)->where('driver_id', $user->id)->whereNull('deleted_at')->get();
            $revenues = Revenue::where('created_at', '>=',$time)->where('user_id', $user->id)->sum('cost');
            $assigns = AssignCar::where('created_at', '>=',$time)->where('user_id', $user->id)->whereNull('deleted_at')->latest()->get();
            $maintenances = 0;
            foreach ($assigns as $assign) {
                $maintenances += Maintenance::where('created_at', '>=',$time)->where('vehicle_id', $assign->vehicle_id)->whereNull('deleted_at')->sum('cost_maintenance');
            }
            $data = [
                'orders_assigned_me' => (int)$bookings->count(),
                'orders_finished' => (int)$bookings->where('status', 'finished')->count(),
                'orders_pending' => (int)$bookings->where('status', 'inprocess')->count(),
                'orders_costs' => (int)$bookings->sum('price'),
                'revenues' => (int)$revenues,
                'expenses' => (int)$maintenances,
            ];
            return api_response(1, __('api.profile'), $data);
        } else {
            return api_response(0, __("api.Unauthorized"), null, 401);
        }
    }

}