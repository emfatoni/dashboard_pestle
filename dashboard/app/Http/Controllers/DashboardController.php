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
		//$req = new AlchemyAPI();
		//$demo_url = 'http://www.theguardian.com/world/2014/jan/09/turkey-instability-threatens-economic-success-erdogan';
		//$demo = $req->text('url', $demo_url, null);

		
		// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		$flavor = 'url';
		$opt = null;
		$data = 'http://www.theguardian.com/world/2014/jan/09/turkey-instability-threatens-economic-success-erdogan';
		$type="keyword";

		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'http://localhost:88/dashboard_pestle/alchemyapi/services.php?flavor='.$flavor.'&opt='.$opt.'&type='.$type.'&data='.$data,
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		curl_close($curl);

		//dd($resp);

		//echo json_encode($resp);
		$manage = (array) json_decode($resp);

		//echo $resp;
		//echo "<br><br>";

		//print_r($manage);
		//echo "<br><br>";
		$json = json_encode($manage);
		//return $json;

		return view('daspestle/testing')->with('hasil', $manage);
	}
	public function cek2()
	{
		$resource = 'http://www.theguardian.com/world/2014/jan/09/turkey-instability-threatens-economic-success-erdogan';
		$type = 'relation';

		$url = 'http://localhost:88/dashboard_pestle/alchemyapi/services.php';
		$data = array(
			'flavor' => 'url',
			'data' => $resource,
			'type' => $type,
			);

		$options = array(
			'http' => array(
				'header' => "Content-type: application/x-www-form-urlencoded",
				'method' => 'POST',
				'content' => http_build_query($data),
				),
			);
		$context = stream_context_create($options);
		$res = file_get_contents($url, false, $context);

		echo "<pre><code>";
		print_r($res);
		echo "</code></pre>";
	}
}
