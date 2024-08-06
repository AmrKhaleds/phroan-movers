<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Worker;

class WorkerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $workers = Worker::where('parent_id', 0)->whereNull('deleted_at')->get();
        return view('acp.Worker.index', compact('workers'));
    }

    public function create(Request $request)
    {
        return view('acp.Worker.create',compact('request'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
//            'job_type' => 'required',
            'phone2' => 'required',
        ]);

        $final = $request->all();
        if (is_null($request->parent)) {
            $final ['parent_id'] = 0;
        } else {
            $worker = Worker::findOrFail($request->parent);

            $final ['parent_id'] = $request->parent;
            $final ['job_type'] = $worker->job_type;
        }

        $worker = Worker::create($final);

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }

    public function show(Request $request,$id)
    {
        $work = Worker::where('id', $id)->whereNull('deleted_at')->firstOrFail();
        $workers = Worker::where('parent_id', $id)->whereNull('deleted_at')->get();
        return view('acp.Worker.show', compact('workers','work'));
    }

    public function edit(Request $request,$id)
    {
        $worker = Worker::findOrFail($id);
        return view('acp.Worker.edit', compact('worker','request'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
//            'job_type' => 'required',
            'phone2' => 'required',
        ]);
        $worker = Worker::findOrFail($id);
        $final = $request->all();
//dd($final);
        if (!is_null($worker->parent) && $worker->parent === 0) {
            $final ['parent_id'] = 0;
        } else {
            $final ['job_type'] = $worker->parentAccounts->job_type;
        }
        $worker->update($final);

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function destroy($id)
    {
        $worker = Worker::findOrFail($id);
        $worker->deleted_at = Carbon::now();
        $worker->save();
        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }


}