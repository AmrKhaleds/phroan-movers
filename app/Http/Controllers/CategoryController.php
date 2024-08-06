<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $departments = Category::whereNull('deleted_at')->get();
        return view('acp.Category.index', compact('departments'));
    }

    public function create()
    {
        return view('acp.Category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
        ]);
        $department = Category::create($request->all());

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }
    public function edit($id)
    {
        $department = Category::findOrFail($id);
        return view('acp.Category.edit',compact('department'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'title' => 'required|string',
        ]);
        $department = Category::findOrFail($id);
        $department->title = $request->title;
        $department->save();

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function destroy($id)
    {
        $department = Category::findOrFail($id);
        $department->deleted_at = Carbon::now();
        $department->save();
        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }


}
