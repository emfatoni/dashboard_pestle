<?php

	require_once 'alchemyapi.php';
	$alchemyapi = new AlchemyAPI();
	
	$demo_url = 'http://www.theguardian.com/world/2014/jan/09/turkey-instability-threatens-economic-success-erdogan';

	$response = $alchemyapi->text('url', $demo_url, null);

	if ($response['status'] == 'OK') {
		//echo '## Response Object ##', PHP_EOL;
		//echo "<em>", print_r($response);, "</em>";

		//echo PHP_EOL;
		//echo '## Extracted Text ##', PHP_EOL;
		//echo 'text: ',PHP_EOL, $response['text'], PHP_EOL;
		//print_r($response['text']);
		//print_r($response);
		//print_r($response);
		echo json_encode($response);
		
	} else {
		//echo 'Error in the text extraction call: ', $response['statusInfo'];
		//print_r(array("error" => $response['statusInfo']));
		echo json_encode(array("error" => $response['statusInfo']));
	}
	//echo $hasil;