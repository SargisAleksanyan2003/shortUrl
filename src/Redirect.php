<?php

namespace classes;

use classes\traits\TRedirect;

class Redirect
{
	use TRedirect;
	public function getUrl()
	{
		$this->url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		return $this->openSite();
	}

	private function redirect($url)
	{
		if ($url !== false) {
			header('Location: ' .  $url);
		}
	}
}