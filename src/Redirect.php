<?php

namespace classes;

class Redirect
{
	private \PDO $db;
	private string $url;

	public function __construct()
	{
		$phinxConfig = include '../phinx.php';
		$database = $phinxConfig['environments']['production'];
		$dsn = $database['adapter'] . ':host=' . $database['host'] . ';dbname=' . $database['name'];
		$username = $database['user'];
		$password = $database['pass'];
		$this->db  = new \PDO($dsn, $username, $password);
	}
	public function openSite()
	{
		$this->url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$sql = "SELECT * FROM short_url WHERE short_url = '$this->url '";
		$result = $this->db->query($sql)->fetchAll();
		if ($result) {
			header('Location: ' .  $result[0]['url']);
		}
		return true;
	}
}