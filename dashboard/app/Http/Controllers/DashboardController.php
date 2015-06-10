<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Guzzle\Http\Client;
use App\AlchemyAPI;

use Illuminate\Http\Request;

class DashboardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function __construct()
	{
		//$this->middleware('guest');
	}
	public function index()
	{
		return view('daspestle/home');
	}

	public function politic()
	{
		return view('daspestle/politic');
	}
	public function economy()
	{
		return view('daspestle/economy');
	}
	public function social()
	{
		return view('daspestle/social');
	}
	public function technology()
	{
		return view('daspestle/technology');
	}
	public function legal()
	{
		return view('daspestle/legal');
	}
	public function environment()
	{
		return view('daspestle/environment');
	}
	public function keyword()
	{
		return view('daspestle/keyword');
	}
	public function test()
	{
		return view('daspestle/testing');
	}
	public function cek()
	{
		//$textapi = new \AYLIEN\TextAPI("7d5b07df", "56dac2bd67cd98ff94182ddbbb1884ba");
		//$sentiment = \Aylien::Extract(['url' => 'http://www.theguardian.com/world/2014/jan/09/turkey-instability-threatens-economic-success-erdogan'		]);
		$req = new AlchemyAPI();
		$demo_url = 'http://www.theguardian.com/world/2014/jan/09/turkey-instability-threatens-economic-success-erdogan';
		$demo = $req->text('url', $demo_url, null);
		dd($demo);
	}
}
