<?php

namespace classes;

class MakeUrl
{
	private string $url;
	private string $random;
	private object $db;

	public function __construct()
	{
		$this->db  = new \PDO('mysql:host=localhost;dbname=short_url', 'root', '');
	}


	public function create(string $url)
	{
		$this->url = $url;
		if ($this->checkURL())
			return $this->insert();
		else
			return $this->getError();
	}

	private function insert(): string
	{
		$this->random = $this::getRandomUrl();

		$sql = "INSERT INTO short_url (id, url, short_url) VALUES (:id, :url, :short_url)";
		$this->db->prepare($sql)->execute([
			'id' => null,
			'url' => $this->url,
			'short_url' => $this->random,
		]);
		return $this->random;
	}

	private function getError()
	{
		return 'Ошибка';
	}

	private function checkURL(): bool
	{
		if (filter_var($this->url, FILTER_VALIDATE_URL)) {
			return true;
		}
		return false;
	}

	private static function getRandomUrl(): string
	{

		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		$randomString = '';

		for ($i = 0; $i < 7; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}

		return $_SERVER['HTTP_REFERER'] . 's/' . $randomString;
	}
}