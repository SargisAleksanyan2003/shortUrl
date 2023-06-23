<?php

use classes\Redirect;

$dotenv = Dotenv\Dotenv::createImmutable(dirname('.env'));
$dotenv->load();

return
	[
		'paths' => [
			'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
			'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
		],
		'environments' => [
			'default_migration_table' => 'phinxlog',
			'default_environment' => 'development',
			'production' => [
				'adapter' => 'mysql',
				'host' => $_ENV['DB_HOST'],
				'name' =>  $_ENV['short_url'],
				'user' =>  $_ENV['DB_USERNAME'],
				'pass' =>  $_ENV['DB_PASSWORD'],
				'port' =>  $_ENV['DB_PORT'],
				'charset' => 'utf8',
			],
			'development' => [
				'adapter' => 'mysql',
				'host' => $_ENV['DB_HOST'],
				'name' =>  $_ENV['short_url'],
				'user' =>  $_ENV['DB_USERNAME'],
				'pass' =>  $_ENV['DB_PASSWORD'],
				'port' =>  $_ENV['DB_PORT'],
				'charset' => 'utf8',
			],
			'testing' => [
				'adapter' => 'mysql',
				'host' => $_ENV['DB_HOST'],
				'name' =>  $_ENV['short_url'],
				'user' =>  $_ENV['DB_USERNAME'],
				'pass' =>  $_ENV['DB_PASSWORD'],
				'port' =>  $_ENV['DB_PORT'],
				'charset' => 'utf8',
			]
		],
		'version_order' => 'creation'
	];