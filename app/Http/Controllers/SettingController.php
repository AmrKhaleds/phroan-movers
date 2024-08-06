<?php

namespace App\Http\Controllers;

use App\Models\SettingAccount;
use App\Models\Account;
use App\Models\Setting;
use App\Models\SettingKM;
use Illuminate\Http\Request;


class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $groups = SettingAccount::select('group')->get()->toArray();
        $array_groups = array_unique(array_column($groups, 'group'));
        $settings = SettingAccount::where('type', 'accounting')->get();
        $accounts = Account::where('parent_id', '!=', 0)->get();
        if (count($settings) > 0) {
            return view('acp.Accounting.setting', compact('settings', 'array_groups', 'settings', 'accounts'));
        } else {
            abort(404);
        }
    }
    public function create()
    {
        $settingKms = SettingKM::all();
	    $settings = Setting::where('groupe','PRICING')->get();

	    return view('acp.Setting.pricing', compact('settingKms','settings'));
    }

    public function New(Request $request)
    {
        $settingKms = SettingKM::latest()->first();
        $newSettingKms = $settingKms->replicate();
        $newSettingKms->start = 0;
        $newSettingKms->to = 0;
        $newSettingKms->average_start = 0;
        $newSettingKms->average_to = 0;
        $newSettingKms->save();
        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }

    public function createGeneral()
    {
        $settings = Setting::where('groupe','GENERAL')->get();
        $settingwahts = Setting::where('groupe','GENERALWHATSAPP')->first();
        return view('acp.Setting.General', compact('settings','settingwahts'));
    }

    public function check(Request $request)
    {
        $settingKms = SettingKM::where('start', '<=', $request->search_keyword)->where('to', '>=', $request->search_keyword)->first();
        $start = $settingKms->average_start * $request->search_keyword;
        $check = $start < 250 ? 250 : $start;
        $to = $settingKms->average_to * $request->search_keyword;
        if ($to < $check) {
            $data = $check;
        } else {
            $data = $to . ' ~ ' . $check;
        }
        return response()->json($data);
    }

    public function checkDuration(Request $request)
    {
        $data = $request->search_keyword * 300;

        return response()->json($data);
    }

    public function store(Request $request)
    {
        foreach ($request->id as $key => $id) {
            $settingKms = SettingKM::find($id);
            $settingKms->start = $request->start[$key];
            $settingKms->to = $request->to[$key];
            $settingKms->average_start = $request->average_start[$key];
            $settingKms->average_to = $request->average_to[$key];
            $settingKms->save();
        }
        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }
    public function storeGeneral(Request $request)
    {
        foreach ($request->id as $key => $id) {
            $setting = Setting::find($id);
            $setting->value = $request->name[$key];
            $setting->save();
        }

	    $settingwhats = Setting::find(23);
	    $settingwhats->value = $request->whatsapp;
	    $settingwhats->save();
        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }
}
