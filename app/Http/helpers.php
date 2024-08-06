<?php


if (!function_exists('api_response')) {
    function api_response($status, $message, $data = null, $status_code = 200)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response, $status_code);
    }
}


if (!function_exists('GenerateAccessToken')) {

    function GenerateAccessToken()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 200; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return 'Bearer ' . $randomString;

    }

}


if (!function_exists('CheckAccessToken')) {

    function CheckAccessToken($token)
    {
        if (isset($token) && !is_null($token)) {
            if (strpos($token, 'Bearer ') !== false) {
//                $barer = str_replace("Bearer ", "","$token");
                $barer = $token;
                $user = \App\Models\User::where('token', $barer)->first();
                if (!is_null($user)) {
                    return $user;
                } else {
                    return null;

                }
            }
        } else {
            return null;
        }
    }

}


if (!function_exists('nBetween')) {
    function nBetween($varToCheck, $high, $low) {
        if($varToCheck < $low) return false;
        if($varToCheck > $high) return false;
        return true;
    }
}


if (!function_exists('SendNotification')) {

    function sendNotification($message, $tokens, $topic, $title,$type,$id)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $firebase_key = 'AAAAZxFrOK4:APA91bGC8Wh2nBSI0ITX1O9RAfx7vREh0A8fomWJxmPjUzWeWf1fZlK0ZvqRJNBDLMLWYiIoNe8NGxHRyOjZNZeXiS7z-61xtPuh1Vv7E_BeXFinCfOsC0jmQWn7m2H2WxlN6loPqDQG';
        if (!empty($tokens)) {
            $fields = array(
                "registration_ids" => $tokens,
//        "to" => '/topics/' . $topic,
                "notification" => array(
                    "title" => $title,
                    "body" => $message,
                    "sound" => "default",
                    "icon" => asset('assets/images/logo-144.png'),
                    "badge" => "1",
                    "click_action" => "FLUTTER_NOTIFICATION_CLICK"
                ),
                "data" => array(
                    "id" => $id,
                    "title" => $title,
                    "body" => $message,
                    "type" => $type,
                    "sound" => "default",
                    "icon" => asset('assets/images/logo-144.png'),
                    "badge" => "1",
                    "click_action" => "https://team-upnow.com"
                ),
                "priority" => "high"
            );
        }
        elseif ($topic == 'all') {
            $fields = array(
//                "registration_ids" => $tokens,
                "to" => '/topics/' . $topic,
                "notification" => array(
                    "title" => $title,
                    "body" => $message,
                    "sound" => "default",
                    "icon" => asset('assets/images/logo-144.png'),
                    "badge" => "1",
                    "click_action" => "FLUTTER_NOTIFICATION_CLICK"
                ),
                "data" => array(
                    "id" => $id,
                    "title" => $title,
                    "body" => $message,
                    "type" => $type,
                    "sound" => "default",
                    "icon" => asset('assets/images/logo-144.png'),
                    "badge" => "1",
                    "click_action" => "https://team-upnow.com"
                ),
                "priority" => "high"
            );

        }
        else{
            $fields = array(
                "registration_ids" => $tokens,
//                "to" => '/topics/' . $topic,
                "notification" => array(
                    "title" => $title,
                    "body" => $message,
                    "sound" => "default",
                    "icon" => asset('assets/images/logo-144.png'),
                    "badge" => "1",
                    "click_action" => "FLUTTER_NOTIFICATION_CLICK"
                ),
                "data" => array(
                    "id" => $id,
                    "title" => $title,
                    "body" => $message,
                    "type" => $type,
                    "sound" => "default",
                    "icon" => asset('assets/images/logo-144.png'),
                    "badge" => "1",
                    "click_action" => "https://team-upnow.com"
                ),
                "priority" => "high"
            );
//dd($fields);
        }

        $topk = [];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: key=' . $firebase_key,
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
        //print_r($result);
        //exit;
    }

}


if (!function_exists('uploadFile')) {
    function uploadFile($file)
    {
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/'), $fileName);
            $file = new App\Models\File();
            $file->name = $fileName;
            $file->save();
            return $file->id;

    }
}

if (!function_exists('getFile')) {
    function getFile($file_id)
    {
        $file = App\Models\File::find($file_id);
        return $file != null ? url('uploads/'.$file->name) : null;
    }
}

if (!function_exists('getSetting')) {
    function getSetting($data)
    {
        $query = App\Models\Setting::where('name',$data)->first();
        return $query;
    }
}


if (!function_exists('account_setting')) {
    function account_setting($type, $group, $key = '')
    {
        $setting = \App\Models\SettingAccount::where('type', $type)->where('group', $group)->get()->toArray();
        if ($key != '') {
            $setting = $setting[array_search($key, array_column($setting, 'key'))];
        }
        return $setting;
    }
}

if (!function_exists('searchArray')) {
	function searchForValue($value, $array,$k = 'reason',$result ='cost') {
		foreach ($array as $key => $val) {
			if ($val[$k] === $value) {
				return $val[$result];
			}
		}
		return null;
	}
}
