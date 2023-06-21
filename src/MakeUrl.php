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
			return $this->getError('URL не правильный');
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
		echo 'Короткий URL: <a href="' . $this->random . '"> ' . $this->random . '</a>';
		return true;
	}

	private function getError(string $error = '')
	{
		echo 'Ошибка: ' . $error;
		return false;
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
		return $_SERVER['HTTP_REFERER'] . 's/' . bin2hex(random_bytes(2));
	}
}