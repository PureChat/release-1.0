<?php

abstract class Abstracts_StorageBase {

	//-- All of the abstract (required) methods.
	abstract public function __construct();
	abstract public function startConnection();

	public $database;

	// $storage_type, $storage_system;
	//-- Common and accessible methods.
	/*public function getStorageType() {
		return $this->storage_type;
	}
	public function getStorageSystem() {
		return $this->storage_system;
	}*/

}