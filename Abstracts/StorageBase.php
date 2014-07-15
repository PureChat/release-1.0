<?php

abstract class Abstracts_StorageBase {

	//-- All of the abstract (required) methods.
	abstract public function __construct();
	abstract public function startConnection();
	abstract public function executeQuery($sql, $params);
	abstract public function getRow($sql, $params);
	abstract public function getRows($sql, $params, $type = PDO::FETCH_ASSOC);
	abstract public function getLastInsertId();
	abstract public function bindDataType($input);

}