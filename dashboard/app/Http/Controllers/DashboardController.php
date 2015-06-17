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
		$resource = 'International clients of brokers and insurers that are attracted to Brazil by its stable political and economic environment face levels of bureaucracy, taxes, crime and corruption that typically are far greater than in their home markets, experts say.

Many companies come to Brazil because the business environment is more familiar than the other BRIC countries (Brazil, Russia, India and China), said Keith Martin, Rio de Janeiro-based director of international trade and investments with Aon Risk Solutions, a unit of Aon Corp. It also has a more stable public and private sector and a better-proven legal framework than some other BRIC countries, he said.

However, it is not without issues, said Mr. Martin. Myriad complex tax rules, corruption and a slow legal process are hurdles to overcome, he said.

The levels of bureaucracy and lack of transparency of rules make Brazil a difficult country to do business in, said Corina Monaghan, New York-based vp at Aon Risk Solutions\' political risk practice. “The complexity of tax rules is a real shock for investors, and compliance is difficult because there is a lot of over-complication and rules that are not common in the U.S.,” she said.

The huge opportunities for foreign companies in Brazil\'s growing economy have to be weighed up against the country\'s relatively high taxes and labor costs, said Carlos Caicedo, analyst and head of the Latin American team at London-based political risk consultancy Exclusive Analysis Ltd.

“Foreign companies need to be aware of the high costs of labor and taxes in Brazil. The tax system is antiquated and has grown into a monster, with many layers of taxes,” he said.

Labor laws are generous to workers and distort the labor market, said Mr. Caicedo. There is a large “informal” job market in Brazil because “favorable employee rights” discourage employment on a full-time basis, he said.

The tort system, which is similar to that in Continental Europe, also is bureaucratic, marked by a large number of appeals and the slow processing of court documentation, said Mr. Martin.

One of the main problems for foreign investors in Brazil is corruption in Brazilian government ministries, said Mr. Caicedo. Several companies have fallen foul of corruption; for example a tender process for building a metropolitan rail system in São Paulo was canceled after newspapers announced the winners six months before the closing date.

The levels of political risk in Brazil are now far lower than a decade ago, said Ms. Monaghan. But, while Brazil is politically stable, there are differences in risk between its 27 states and 5,000 municipalities, she said.

For example, Brazilian foreign exchange rules freely allow dividends and capital to be repatriated to investors outside the country, but some restrictions are imposed by certain states, and this is not always well understood, she said.

Political risk in Brazil has changed a lot in the past decade, said James Thomas, Miami-based political risk and trade credit underwriting manager for Zurich North America.

“Ten years ago, people were buying currency convertibility insurance, but this is rarely purchased today. The country now has low levels of political risk compared with its neighbors, and expropriation risk and political violence are not really an issue,” he said.

However there is interest in political risk insurance for heavily regulated sectors like mining and power by virtue of their complexity, said Mr. Thomas.

%%BREAK%%

Despite little risk of political violence, there is concern among foreign companies with personal security and crime.

Kidnap and ransom and high crime rates are problems in Brazil, said Thomaz Favaro, London-based security and political risk analyst in the Americas team at global risk consultancy Control Risks, a unit of Control Risks Group Holdings Ltd. “The security environment has failed to keep pace with gains in the economy,” he said.

Crime has been reduced in major cities like Rio de Janeiro and São Paulo, but it has spread to smaller cities, and crime rates have risen in the north and northeast parts of the country and midsize cities, said Mr. Favaro. The bulk is petty crime and robbery, although theft is a particular problem. “Law enforcement on the road is poor, and it is easy for thieves to steal cargo, even on major highways,” he said.

Brazil is a relatively open market for foreign companies, but there are restrictions.

As a country Brazil believes in technology transfer, said Mr. Favaro. If the government looks to develop a sector, it will want to make sure that the domestic economy benefits, he said.

“Foreign investment has to help develop local industry, and the regulations are there to protect local industry,” said Mr. Marques.

In some sectors companies are required to source at least 60% of goods and services internally, and local content comes at an additional cost, he said. For example a joint-venture oil company might be required to buy its rigs from Brazilian manufacturers.

There also is potential for increased levels of government intervention in strategic sectors such as oil and gas, including increased taxes and harsher regulation, said Mr. Favaro. However the risk of expropriation remains “negligible,” he said.

Rule changes spur interest in risk management

Under the state-run reinsurance monopoly that existed in Brazil until 2008, there were few incentives for insurers and insureds to invest in risk management, said Mr. Marques.

As a result, loss prevention measures are not well developed in Brazil, but that is changing, and companies are showing more interest in risk management services now the market has opened up, he said.

Aon Corp.’s operations in Brazil also have observed a growing interest in risk management services like enterprise risk management, said Aon Risk Solutions’ Mr. Martin. “As Brazilian businesses increasingly list on stock exchanges in São Paulo, New York and London, modern risk management tools are becoming more common,” he said.

Risk management is developing, but it would be dangerous to assume it is the same across all sectors and companies, said Hugh Burgess, New York-based chief executive of the Americas region for Allianz Global Corporate & Specialty, part of Munich-based Allianz S.E.

“There is a wide spectrum of risk management in Brazil, but it is improving and I expect relevant legislation—like fire prevention or corporate governance—will come in line with international standards over time,” he said.';
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
}
