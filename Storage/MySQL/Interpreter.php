<?php

class Storage_MySQL_Interpreter extends Abstracts_StorageBase {

	const DB_NAME = 'release-1.0';
	const DB_HOST = '127.0.0.1';
	const DB_USER = 'root';
	const DB_PASS = '';

	public function __construct() {
		$this->storage_type   = 'database';
		$this->storage_system = 'mysql';
	}

	public function startConnection() {
		try {
			$this->database = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASS);
		} catch (PDOException $e) {
			trigger_error('MySQL Database Connection Failed: ' . $e->getMessage());
		}
	}

}