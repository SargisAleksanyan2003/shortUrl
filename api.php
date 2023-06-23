<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname('.env'));
$dotenv->load();


use classes\Api;

echo json_decode("http:\/\/localhost\/s\/7f43");
if (isset($_GET['short_url'])) {
	$short_url =  $_GET['short_url'];
	$short_url = trim($short_url, "'\"");

	$orginal = new Api();
	print_r(json_encode($orginal->getUrl($short_url)));
} else if (isset($_GET['url'])) {
	$url = urldecode(http_build_query($_GET));
	$url = trim($url, "'\"\url=");

	$shortUrl = new Api();
	print_r(json_encode($shortUrl->create($url)));
}