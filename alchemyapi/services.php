<?php

require_once 'alchemyapi.php';
$api = new AlchemyAPI();

if(empty($_POST["flavor"])||empty($_POST["data"])||empty($_POST["type"])){
	echo json_encode(array("status"=>"not_success", "message"=>"Input empty!"));
}else{
	if($_POST["type"] == "keyword"){
		$res = $api->keywords($_POST["flavor"], $_POST["data"], null);

		if($res["status"] == "OK"){
			echo json_encode($res, JSON_PRETTY_PRINT);
		}else{
			echo json_encode(array("status"=>"not_success", "message"=>"API calling failed!"));
		}
	}else if($_POST["type"] == "text"){
		$res = $api->text($_POST["flavor"], $_POST["data"], null);

		if($res["status"] == "OK"){
			echo json_encode($res, JSON_PRETTY_PRINT);
		}else{
			echo json_encode(array("status"=>"not_success", "message"=>"API calling failed!"));
		}
	}else if($_POST["type"] == "relation"){
		$res = $api->relations($_POST["flavor"], $_POST["data"], null);

		if($res["status"] == "OK"){
			echo json_encode($res, JSON_PRETTY_PRINT);
		}else{
			echo json_encode(array("status"=>"not_success", "message"=>"API calling failed!"));
		}
	}
}