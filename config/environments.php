<?php

function environment()
{
	$server_name = $_SERVER["SERVER_NAME"];

	if (strcmp($server_name, "localhost") === 0 ) {
		$data = [
	        'default' => [
	            'className' => 'Cake\Database\Connection',
	            'driver' => 'Cake\Database\Driver\Mysql',
	            'persistent' => false,
	            'host' => '192.168.10.201',
	            'username' => 'admin',
	            'password' => 'VAtQvWbzynEA',
	            'database' => 'bramo_fortune',
	            'encoding' => 'utf8',
	            'timezone' => 'UTC',
	            'flags' => [],
	            'cacheMetadata' => true,
	            'log' => false,
	            'quoteIdentifiers' => false,
	            'url' => env('DATABASE_URL', null),
	        ],

	        'test' => [
	            'className' => 'Cake\Database\Connection',
	            'driver' => 'Cake\Database\Driver\Mysql',
	            'persistent' => false,
	            'host' => 'localhost',
	            //'port' => 'non_standard_port_number',
	            'username' => 'my_app',
	            'password' => 'secret',
	            'database' => 'test_myapp',
	            'encoding' => 'utf8',
	            'timezone' => 'UTC',
	            'cacheMetadata' => true,
	            'quoteIdentifiers' => false,
	            'log' => false,
	            //'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
	            'url' => env('DATABASE_TEST_URL', null),
	        ],
	    ];
	} else {
		$data = [
	        'default' => [
	            'className' => 'Cake\Database\Connection',
	            'driver' => 'Cake\Database\Driver\Mysql',
	            'persistent' => false,
	            'host' => 'localhost',
	            'username' => 'root',
	            'password' => '',
	            'database' => 'buramo',
	            'encoding' => 'utf8',
	            'timezone' => 'UTC',
	            'flags' => [],
	            'cacheMetadata' => true,
	            'log' => false,
	            'quoteIdentifiers' => false,
	            'url' => env('DATABASE_URL', null),
	        ],

	        'test' => [
	            'className' => 'Cake\Database\Connection',
	            'driver' => 'Cake\Database\Driver\Mysql',
	            'persistent' => false,
	            'host' => 'localhost',
	            //'port' => 'non_standard_port_number',
	            'username' => 'my_app',
	            'password' => 'secret',
	            'database' => 'test_myapp',
	            'encoding' => 'utf8',
	            'timezone' => 'UTC',
	            'cacheMetadata' => true,
	            'quoteIdentifiers' => false,
	            'log' => false,
	            //'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
	            'url' => env('DATABASE_TEST_URL', null),
	        ],
	    ];
	}

	return $data;
}