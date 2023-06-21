<?php
require_once '../vendor/autoload.php';

use classes\MakeUrl;

$url = $_POST['url'];

$shortUrl = new MakeUrl();

$shortUrl->create($url);