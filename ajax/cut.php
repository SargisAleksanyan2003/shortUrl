<?php
require_once '../vendor/autoload.php';

use classes\MakeUrl;

$dotenv = Dotenv\Dotenv::createImmutable(dirname('../.env'));
$dotenv->load();

$url = $_POST['url'];

$shortUrl = new MakeUrl();

$shortUrl->create($url);
