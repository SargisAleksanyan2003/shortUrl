<?php

namespace classes;

use classes\traits\AddUrl;
use classes\traits\TRedirect;

class Api
{
	use AddUrl, TRedirect;

	private function insert(): string
	{
		$checkExist = $this->checkExist();
		if ($checkExist === false) {
			$this->random = $this::getRandomUrl();
			if ($this->insertUrl($this->random, $this->url)) {
				return $this->random;
			}
		}
		return $checkExist;
	}

	public function getUrl($url)
	{
		$this->url = $url;
		return $this->openSite();
	}

	private function redirect($url): string
	{
		return $url;
	}

	private function getError(string $error = '')
	{
		return 'Ошибка: ' . $error;;
	}
}
