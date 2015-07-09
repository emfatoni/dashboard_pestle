<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Guzzle\Http\Client;
use App\AlchemyAPI;
use App\Metric;
use App\Crawlered;

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
		return view('template');
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
	}	public function test()
	{
		return view('daspestle/testing');
	}
	public function cek()
	{		//$textapi = new \AYLIEN\TextAPI("7d5b07df", "56dac2bd67cd98ff94182ddbbb1884ba");
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
		$resource = 'International clients of brokers and insurers that are attracted to Brazil by its stable political and economic environment face levels of bureaucracy, taxes, crime and corruption that typically are far greater than in their home markets, experts say.';
		$type = 'relation';

		$url = 'https://services.cogitoapi.com/1.0/kernel/summary';
		$data = array(
			'text' => $resource
			);

		$options = array(
			'http' => array(
				'header' => "Content-type: application/x-www-form-urlencoded\r\nApikey: vb4tb7qpm7tm8zqen3sz3ya5",
				'method' => 'POST',
				'content' => http_build_query($data),
				),
			);
		$context = stream_context_create($options);
		$res = file_get_contents($url, false, $context);

		echo "<code>";
		$decode = json_decode($res);
		print_r($decode->analysisResult->summary->mainSentences[0]);
		echo "</code>";
	}
	public function cek3()
	{
		$resource = "";
		$type = 'relation';

		$url = 'https://services.cogitoapi.com/1.0/kernel/summary';
		$data = array(
			'flavor' => 'url',
			'data' => $resource,
			'type' => $type,
			);

		$options = array(
			'http' => array(
				'header' => "Content-type: application/x-www-form-urlencoded\r\n",
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

	public function crawling()
	{
		// AREA
		$req = Metric::where('name', '=', 'area')->take(1)->get()->toArray();
		$area = $req[0];

		$area_key = explode(',', $area['keywords']);

		// POLITIC
		$req = Metric::where('name', '=', 'politic')->take(1)->get()->toArray();
		$politic = $req[0];

		$politic_key = explode(',', $politic['keywords']);

		$que = $politic_key[0].' '.$area_key[0];

		// $urls = $this->crawl(str_replace(' ', '+', $que));

		foreach($urls as $url){
			$new = new Crawlered();
			$new->title = $url['title'];
			$new->url = $url['url'];
			$new->website = $url['website'];

			$new->save();
		}

		// dd($urls);
	}

	public function analyze($obj){
		
		$resource = $obj->url;
		$type = 'text';

		$url = 'http://localhost:88/dashboard_pestle/alchemyapi/services.php';

		$data = array(
			'flavor' => 'url',
			'data' => $resource,
			'type' => $type,
			);

		$options = array(
			'http' => array(
				'header' => "Content-type: application/x-www-form-urlencoded\r\n",
				'method' => 'POST',
				'content' => http_build_query($data),
				),
			);
		$context = stream_context_create($options);
		$res = file_get_contents($url, false, $context);

		$mg = (array) json_decode($res);

		// while()

		return $mg;
	}

	public function muain()
	{
		$urls = Crawlered::all();
		$arr = array();

		$berhasil = 0;

		foreach($urls as $url){
			// $arr[] = $url;
			// echo $url->title."<br>";
			$wow = $this->analyze($url);

			if($wow['status'] == 'OK'){
				$url->content = $wow['text'];
				if($url->save()){
					$berhasil++;
				}
			}
		}

		echo $berhasil;
	}

	// //

	public function crawl(Request $req)
	{
		$q = $req->input('query');

		if(($q === null)||($q === '')){
			return json_encode(array('status' => 'query empty'));
		}

		$q = str_replace(' ', '+', $q);

		$key = 'AIzaSyCuXlh6HdSLy-hjxlnpOUv7uH58Mon7PTY';
		$cx = '010284409504547172167:v_6u_hoi8rq';

		$qstring = 'https://www.googleapis.com/customsearch/v1?'.'key='.$key.'&cx='.$cx.'&q='.$q;

		$reqs = file_get_contents($qstring);

		$hsl = (array) json_decode($reqs);

		$out = array();
		$sites = $hsl['items'];

		foreach($sites as $site){
			$temp = array();
			$temp["title"] = $site->title;
			$temp["url"] = $site->link;
			$temp["website"] = $site->displayLink;
			$out[] = $temp;
		}

		return json_encode($out);
	}

	public function content_ext(Request $req){
		
		$resource = $req->input('url');
		$type = 'text';

		$url = 'http://localhost:88/dashboard_pestle/alchemyapi/services.php';

		$data = array(
			'flavor' => 'url',
			'data' => $resource,
			'type' => $type,
			);

		$options = array(
			'http' => array(
				'header' => "Content-type: application/x-www-form-urlencoded\r\n",
				'method' => 'POST',
				'content' => http_build_query($data),
				),
			);
		$context = stream_context_create($options);
		$res = file_get_contents($url, false, $context);

		$mg = (array) json_decode($res);

		return json_encode($mg);
	}

	public function keyword_ext(Request $req){
		
		$resource = $req->input('title');
		$type = 'keyword';

		$url = 'http://localhost:88/dashboard_pestle/alchemyapi/services.php';

		$data = array(
			'flavor' => 'text',
			'data' => $resource,
			'type' => $type,
			);

		$options = array(
			'http' => array(
				'header' => "Content-type: application/x-www-form-urlencoded\r\n",
				'method' => 'POST',
				'content' => http_build_query($data),
				),
			);
		$context = stream_context_create($options);
		$res = file_get_contents($url, false, $context);

		$mg = (array) json_decode($res);

		return json_encode($mg);
	}

	public function sentiment_anl(Request $req){
		
		$resource = $req->input('text');
		$type = 'sentiment';

		$url = 'http://localhost:88/dashboard_pestle/alchemyapi/services.php';

		$data = array(
			'flavor' => 'text',
			'data' => $resource,
			'type' => $type,
			);

		$options = array(
			'http' => array(
				'header' => "Content-type: application/x-www-form-urlencoded\r\n",
				'method' => 'POST',
				'content' => http_build_query($data),
				),
			);
		$context = stream_context_create($options);
		$res = file_get_contents($url, false, $context);

		$mg = (array) json_decode($res);

		return json_encode($mg);
	}

}

