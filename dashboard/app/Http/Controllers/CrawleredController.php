<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Crawlered;

use Illuminate\Http\Request;

class CrawleredController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Crawlered::all();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $req)
	{
		$new = new Crawlered();

		$new->title = $req->input('title');
		$new->url = $req->input('url');
		$new->website = $req->input('website');

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
		return Crawlered::find($id);
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
	public function update($id)
	{
		$edit = Crawlered::find($id);

		if($edit)
		{
			$edit->title = $req->input('title');
			$edit->url = $req->input('url');
			$edit->website = $req->input('website');
			$edit->content = $req->input('content');

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
		$del = Crawlered::find($id);

		if($del)
		{
			if($edit->delete())
			{
				return array('status'=>'Deleted!');
			}
			return array('status'=>'Not Deleted!');
		}
		return array('status'=>'Not Found!');
	}

}
