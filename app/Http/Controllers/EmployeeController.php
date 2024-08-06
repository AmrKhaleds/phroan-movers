<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function GuzzleHttp\json_encode;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employees = User::where('email', '!=', 'admin@admin.admin')->whereNull('deleted_at')->get();
        return view('acp.Employee.index', compact('employees'));
    }

    public function create()
    {
        $categories = Category::whereNull('deleted_at')->get();
        $team_leaders = User::whereNull('deleted_at')->get();
        return view('acp.Employee.create', compact('categories', 'team_leaders'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'start_work' => 'required',
            'work_hours' => 'required',
            'sallary' => 'required',
            'category_id' => 'required',
            'email' => 'required|string|unique:users',
            'whatsapp' => 'required',
            'start_day' => 'required',
            'team_leader_id' => 'required',
            'sallary_per' => 'required',
            'photo' => 'required',
            'cv' => 'required',
            'id' => 'required',
        ]);
        $password = rand(00000000, 99999999);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($password);
        $user->save();
        $empoyee = new Employee();
        $empoyee->phone = $request->phone;
        $empoyee->start_work = $request->start_work;
        $empoyee->work_hours = $request->work_hours;
        $empoyee->sallary = $request->sallary;
        $empoyee->category_id = $request->category_id;
        $empoyee->whatsapp = $request->whatsapp;
        $empoyee->start_day = $request->start_day;
        $empoyee->team_leader_id = $request->team_leader_id;
        $empoyee->sallary_per = $request->sallary_per;
        $empoyee->photo = uploadFile($request->photo);
        $empoyee->user_id = $user->id;
        $empoyee->cv = uploadFile($request->cv);
        $empoyee->created_by = Auth::user()->name;
        $ids = [];
        foreach ($request->id as $id) {
            $ids [] = uploadFile($id);
        }
        $empoyee->national_id = json_encode($ids);
        $empoyee->save();
        $this->RestPass($user->id);
        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function RestPass($id)
    {
        $pass = rand(00000000, 99999999);
        $employee = User::where('id', $id)->whereNull('deleted_at')->first();
        $employee->password = Hash::make($pass);
        $employee->save();

        $to = $employee->email;
        $subject = 'بيانات تسجيل الدخول';
        $data = [
            'name' => $employee->name,
            'email' => $employee->email,
            'password' => $pass,
        ];
        \Mail::send('acp.credential', $data, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
//            $message->to('hhossammokhtarh@hotmail.com')->subject($subject);
            $message->from('system@khater100100.xyz', 'شركة فرعون لنقل الاثاث');
        });

//        \Session::flash('msg', __('back.successfully_send_password'));
        return back()->with('success_password', $pass);
    }

    public function edit($id)
    {
        $categories = Category::whereNull('deleted_at')->get();
        $employee = User::where('id', $id)->whereNull('deleted_at')->first();
        $team_leaders = User::whereNull('deleted_at')->get();
        return view('acp.Employee.edit', compact('categories', 'team_leaders', 'employee'));
    }

    public function show($id)
    {
        $employee = User::where('id', $id)->whereNull('deleted_at')->first();
        return view('acp.Employee.show', compact('employee'));
    }

    public function profile()
    {
        $employee = User::where('id', Auth::user()->id)->whereNull('deleted_at')->first();
        return view('acp.Employee.show', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'start_work' => 'required',
            'work_hours' => 'required',
            'sallary' => 'required',
            'category_id' => 'required',
            'email' => 'required|string|unique:users,email,' . $id,
            'whatsapp' => 'required',
            'start_day' => 'required',
            'team_leader_id' => 'required',
            'sallary_per' => 'required',
        ]);
        $user = User::where('id', $id)->whereNull('deleted_at')->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
//        $user->password = Hash::make(rand(000000000, 999999999));
        $user->save();
        $empoyee = Employee::where('user_id', $id)->first();
        $empoyee->phone = $request->phone;
        $empoyee->start_work = $request->start_work;
        $empoyee->work_hours = $request->work_hours;
        $empoyee->sallary = $request->sallary;
        $empoyee->category_id = $request->category_id;
        $empoyee->whatsapp = $request->whatsapp;
        $empoyee->start_day = $request->start_day;
        $empoyee->team_leader_id = $request->team_leader_id;
        $empoyee->sallary_per = $request->sallary_per;
        $empoyee->updated_by = Auth::user()->name;
        if ($request->photo) {
            $empoyee->photo = uploadFile($request->photo);
        }
        if ($request->cv) {
            $empoyee->cv = uploadFile($request->cv);
        }
        if ($request->national_id) {
            $ids = [];
            foreach ($request->national_id as $idNat) {
                $ids [] = uploadFile($idNat);
            }
            $empoyee->national_id = json_encode($ids);
        }
        $empoyee->save();
        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->deleted_at = Carbon::now();
        $user->save();
        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }


}
