<?php

namespace App\Http\Controllers;

use App\Models\Know;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KnowController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$departments = Know::whereNull('deleted_at')->get();
		return view('acp.Know.index', compact('departments'));
	}

	public function create()
	{
		return view('acp.Know.create');
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required|string',
		]);
		$department = Know::create($request->all());

		\Session::flash('msg', __('back.successfully_saved'));
		return back();
	}
	public function edit($id)
	{
		$department = Know::findOrFail($id);
		return view('acp.Know.edit',compact('department'));
	}

	public function update(Request $request,$id)
	{
		$this->validate($request, [
			'title' => 'required|string',
		]);
		$department = Know::findOrFail($id);
		$department->title = $request->title;
		$department->save();

		\Session::flash('msg', __('back.successfully_saved'));
		return back();
	}


	public function destroy($id)
	{
		$department = Know::findOrFail($id);
		$department->deleted_at = Carbon::now();
		$department->save();
		\Session::flash('msg', __('back.successfully_deleted'));
		return back();
	}


}
