<?php

namespace classes;

use classes\traits\AddUrl;


// Извлекаем необходимые данные для соединения с базой данных

class MakeUrl
{
	use AddUrl;

	private function insert(): bool
	{
		$checkExist = $this->checkExist();

		if ($checkExist === false) {
			$this->random = $this::getRandomUrl();
			if ($this->insertUrl($this->random, $this->url)) {
				echo 'Короткий URL: <a href="' . $this->random . '"> ' . $this->random . '</a>';
			}
			return true;
		}
		echo 'Короткий URL: <a href="' . $checkExist . '"> ' . $checkExist . '</a>';

		return false;
	}

	private function getError(string $error = '')
	{
		echo 'Ошибка: ' . $error;
		return false;
	}
}