<?php

namespace classes;


// Извлекаем необходимые данные для соединения с базой данных

class MakeUrl
{
	private string $url;
	private string $random;
	private object $db;

	public function __construct()
	{
		$phinxConfig = include '../phinx.php';
		$database = $phinxConfig['environments']['production'];
		$dsn = $database['adapter'] . ':host=' . $database['host'] . ';dbname=' . $database['name'];
		$username = $database['user'];
		$password = $database['pass'];
		$this->db  = new \PDO($dsn, $username, $password);
	}

	public function create(string $url)
	{
		$this->url = $url;
		if ($this->checkURL())
			return $this->insert();
		else
			return $this->getError('URL не правильный');
	}

	private function insert(): bool
	{
		if ($this->checkExist()) {
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
		return false;
	}

	private function checkExist(): bool
	{
		$sql = "SELECT * FROM short_url WHERE url = '$this->url '";
		$result = $this->db->query($sql)->fetchAll();

		if ($result) {
			echo 'Короткий URL: <a href="' .  $result[0]['short_url'] . '"> ' .  $result[0]['short_url'] . '</a>';

			return false;
		}

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