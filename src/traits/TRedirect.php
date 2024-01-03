<?php

namespace classes\traits;

use classes\traits\TDb;

trait TRedirect
{
	use TDb;
	public function openSite()
	{
		$sql = "SELECT * FROM $_ENV[DB_DATABASE] WHERE short_url = :email";
        $query = $this->db->prepare($sql);
        $query->execute([
            "email" => $this->url
        ]);

        $result = $query->fetch(\PDO::FETCH_ASSOC);

        if (!empty($result)) {
			return $this->redirect($result['url']);
		}
		return false;
	}
}