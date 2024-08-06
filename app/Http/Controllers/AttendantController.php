<?php

namespace App\Http\Controllers;

use App\Models\Attendant;
use App\Models\Category;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendantController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($type)
    {
        if ($type == 'driver') {
            $category = Category::where('title', 'LIKE', "%سواق%")->OrWhere('title', 'LIKE', "%سائق%")->whereNull('deleted_at')->first(['id']);
            $users = Employee::where('category_id', $category->id)->whereNull('deleted_at')->get(['user_id']);
        } elseif ($type == 'mangers') {
            $category = Category::where('title', '!=', "سائقين")->whereNull('deleted_at')->get(['id']);
            $users = Employee::whereIn('category_id', $category)->whereNull('deleted_at')->get(['user_id']);
        }
        $attendants = Attendant::whereIn('user_id', $users)->orderBy('id', 'DESC')->get();
        $title = __('back.'.$type);
        return view('acp.Attendants.index', compact('attendants','title'));
    }

    public function Status($id)
    {
        $attendant = Attendant::findOrFail($id);
        if ($attendant->status == 'HOLD') {
            $attendant->status = 'APPROVED';
            $attendant->approved_by = Auth::user()->id;
        } else {
            $attendant->status = 'HOLD';
            $attendant->approved_by = null;
        }
        $attendant->save();
        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }
}
