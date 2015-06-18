<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Site;

use Illuminate\Http\Request;

class SiteController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Site::all();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $req)
	{
		$new = new Site();

		$new->name = $req->input('name');
		$new->url = $req->input('url');
		$new->id_metric = $req->input('id_metric');

		if($new->save())
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
		return Site::find($id);
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
		$edit = Site::find($id);

		if($edit)
		{
			$edit->name = $req->input('name');
			$edit->url = $req->input('url');
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
		$del = Site::find($id);

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
