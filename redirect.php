<?php
require_once 'vendor/autoload.php';

use classes\Redirect;

$dotenv = Dotenv\Dotenv::createImmutable(dirname('.env'));
$dotenv->load();

$redirect = new Redirect();
$redirect->getUrl();