<?php

namespace classes\traits;

use classes\traits\TDb;

trait AddUrl
{
	use TDb;

	private string $random;

	public function create(string $url)
	{
		$this->url = $url;
		if ($this->checkURL())
			return $this->insert();
		else
			return $this->getError('URL не правильный');
	}

	private function checkURL(): bool
	{
		if (filter_var($this->url, FILTER_VALIDATE_URL)) {
			return true;
		}
		return false;
	}

	private function checkExist()
	{
		$sql = "SELECT * FROM short_url WHERE url = '$this->url '";
		$result = $this->db->query($sql)->fetchAll();

		if ($result) {
			return $result[0]['short_url'];
		}

		return false;
	}

	private function insertUrl($random, $original): bool
	{
		$sql = "INSERT INTO short_url (id, url, short_url) VALUES (:id, :url, :short_url)";
		$this->db->prepare($sql)->execute([
			'id' => null,
			'url' => $original,
			'short_url' => $random,
		]);
		return true;
	}

	private static function getRandomUrl(): string
	{
		return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") .
			"://$_SERVER[HTTP_HOST]" . '/s/' . bin2hex(random_bytes(2));
	}
}
