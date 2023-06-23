<?php

namespace classes\traits;

use classes\traits\TDb;

trait TRedirect
{
	use TDb;
	public function openSite()
	{
		$sql = "SELECT * FROM short_url WHERE short_url = '$this->url '";
		$result = $this->db->query($sql)->fetchAll();
		if ($result) {
			return $this->redirect($result[0]['url']);
		}
		return false;
	}
}