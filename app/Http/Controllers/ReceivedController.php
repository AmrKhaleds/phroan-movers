<?php

namespace App\Http\Controllers;

use App\Models\Received;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReceivedController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$departments = Received::whereNull('deleted_at')->get();
		return view('acp.Received.index', compact('departments'));
	}

	public function create()
	{
		return view('acp.Received.create');
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required|string',
		]);
		$department = Received::create($request->all());

		\Session::flash('msg', __('back.successfully_saved'));
		return back();
	}
	public function edit($id)
	{
		$department = Received::findOrFail($id);
		return view('acp.Received.edit',compact('department'));
	}

	public function update(Request $request,$id)
	{
		$this->validate($request, [
			'title' => 'required|string',
		]);
		$department = Received::findOrFail($id);
		$department->title = $request->title;
		$department->save();

		\Session::flash('msg', __('back.successfully_saved'));
		return back();
	}


	public function destroy($id)
	{
		$department = Received::findOrFail($id);
		$department->deleted_at = Carbon::now();
		$department->save();
		\Session::flash('msg', __('back.successfully_deleted'));
		return back();
	}


}
