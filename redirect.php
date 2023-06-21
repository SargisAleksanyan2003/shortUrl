<?php
require_once 'vendor/autoload.php';

class Redirect
{
	private \PDO $db;
	private string $url;

	public function __construct()
	{
		$this->db  = new \PDO('mysql:host=localhost;dbname=short_url', 'root', '');
	}
	public function openSite()
	{
		$this->url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$sql = "SELECT * FROM short_url WHERE short_url = '$this->url '";
		$result = $this->db->query($sql)->fetchAll();
		echo "<pre>";
		header('Location: ' .  $result[0]['url']);
		echo "</pre>";
		//echo 'Короткий URL: ' . $this->random;
		return true;
	}
}

$redirect = new Redirect();
$redirect->openSite();