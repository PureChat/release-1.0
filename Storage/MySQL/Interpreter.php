<?php

class Storage_MySQL_Interpreter extends Abstracts_StorageBase {

	const DB_NAME = 'release-1.0';
	const DB_HOST = 'localhost';
	const DB_USER = 'root';
	const DB_PASS = '';

	public function __construct() {}

	public function startConnection() {
		try {
			return new PDO('mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_HOST, self::DB_USER, self::DB_PASS);
		} catch (PDOException $e) {
			trigger_error('MySQL Database Connection Failed: ' . $e->getMessage());
		}
	}

}