<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Condition;

use Illuminate\Http\Request;

class ConditionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Condition::all();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$new = new Condition();

		$new->condition = $req->input('condition');
		$new->url = $req->input('url');
		$new->website = $req->input('website');
		$new->date = $req->input('date');
		$new->id_metric = $req->input('id_metric');

		if($new->save)
		{
			return array('status'=>'Saved!');
		}
		return array('status'=>'Not Saved!');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Condition::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $req)
	{
		$edit = Condition::find($id);

		if($edit)
		{
			$edit->condition = $req->input('condition');
			$edit->url = $req->input('url');
			$edit->website = $req->input('website');
			$edit->date = $req->input('date');
			$edit->id_metric = $req->input('id_metric');

			if($edit->save())
			{
				return array('status'=>'Saved!');
			}
			return array('status'=>'Not Saved!');
		}
		return array('status'=>'Not Found!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$del = Condition::find($id);

		if($del)
		{
			if($del->delete())
			{
				return array('status'=>'Deleted!');
			}
			return array('status'=>'Not Deleted!');
		}
		return array('status'=>'Not Found!');
	}

}
