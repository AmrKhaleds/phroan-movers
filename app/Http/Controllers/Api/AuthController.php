<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class AuthController extends Controller
{

    private function getPaginator(Request $request, $items)
    {
        $total = count($items); // total count of the set, this is necessary so the paginator will know the total pages to display
        $page = $request->page ?? 1; // get current page from the request, first page is null
        $perPage = 1; // how many items you want to display per page?
        $paginator = Paginator($items, $total, $perPage, $page, [
            'path' => $this->request->url(),
            'query' => $this->request->query(),
        ]);
    }

    public function Login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'phone' => 'required|string|max:255',
            'password' => 'required|string',
            'fire_token' => 'required',
        ]);
        if ($validation->fails()) {
            return api_response(2, $validation->errors()->all()[0], []);
        } else {
            $user = User::where('phone', $request->phone)->first();
            if (!is_null($user)) {
                if (Hash::check($request->password, $user->password)) {
//                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    $user->token = GenerateAccessToken();
                    $user->fire_token = $request->fire_token;
                    $user->save();

                    $data = ['user_id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'phone' => $user->profile->phone, 'photo' => !is_null($user->profile->photo) ? getFile($user->profile->photo) : NULL, 'access_token' => $user->token];

                    return api_response(1, __('api.logined'), $data);
                } else {
                    return api_response(3, __('api.phone_not_incorrect'));
                }
            } else {
                return api_response(4, __('api.you_are_not_registered'));
            }
        }
    }

    public function MainProfile(Request $request)
    {
        if ($user = CheckAccessToken($request->header('Authorization'))) {
            $data = ['name' => $user->name, 'phone' => $user->profile->phone, 'photo' => !is_null($user->profile->photo) ? getFile($user->profile->photo) : NULL,'start_work'=>$user->profile->start_work,'work_hours'=>$user->profile->work_hours .' '.__('back.hours'),'sallary'=>(int)$user->profile->sallary.__('back.L.E'),'sallary_per'=>__('back.'.$user->profile->sallary_per),'category'=>$user->profile->department->title];

            return api_response(1, __('api.profile'), $data);
        } else {
            return api_response(0, __("api.Unauthorized"), null, 401);
        }

    }


    public function getNotifcations(Request $request)
    {
        if ($user = CheckAccessToken($request->header('Authorization'))) {
            $notifcations = Notification::where('user_id',$user->id)->get();
            foreach ($notifcations as $notifcation){
                $notifcation->setAttribute('ago',$notifcation->created_at->diffForHumans());
            }
            return api_response(1, __('api.notifications'), $notifcations);
        } else {
            return api_response(0, __("api.Unauthorized"), null, 401);
        }

    }

    public function Notifcations(Request $request)
    {
        if ($user = CheckAccessToken($request->header('Authorization'))) {
            $notifcation = Notification::find($request->notifcation_id);
            $notifcation->is_read = 0;
            $notifcation->save();
            return api_response(1, __('api.notifications'), ['result' => $notifcation]);
        } else {
            return api_response(0, __("api.Unauthorized"), null, 401);
        }

    }

    public function Profile(Request $request)
    {
        if ($user = CheckAccessToken($request->header('authorization'))) {
            $fav_sport_id = [];
            $fav_sport = [];
            if ($user->profile->fav_sport_id) {
                foreach (json_decode($user->profile->fav_sport_id) as $sport) {
                    $sports = Sport::find($sport->sport_id);
                    if ($sports) {
                        $name = (array)json_decode($sports->name);
                        $fav_sport_id [] = ['sport' => $name[$user->lang], 'rate' => $sport->rate];
                        $fav_sport [] = $name[$user->lang];
                    }
                }
            }
            $rate = Rate::where('type', 'FRINED')->where('type_id', $user->id)->get();

            $data = ['user_id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'rate' => count($rate) > 0 ? round(($rate->sum('rate') / (5 * count($rate))) * 5, 1) : 3, 'verified' => TRUE, 'fav_sport' => $fav_sport_id, 'sport' => implode(", ", $fav_sport), 'phone' => $user->profile->phone, 'photo' => !is_null($user->profile->photo_id) ? getPhoto($user->profile->photo_id) : NULL, 'access_token' => $user->token, 'age' => $user->profile->age, 'live' => $user->live == 'True' ? 'True' : 'False'];
            return api_response(1, '', $data);
        } else {
            return api_response('error', __("api.Unauthorized"), null, 401);
        }

    }

}
