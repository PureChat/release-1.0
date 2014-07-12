<?php

class Classes_PCDatabase {

	public $database;
	public $storage_path, $available_storage_systems;

	public function __construct($storage_system) {

		$this->available_storage_systems = array(
			'mysql' => 'MySQL',
		);

		if (array_key_exists($storage_system, $this->available_storage_systems)) {
			$this->storage_path = 'Storage_' . $this->available_storage_systems[$storage_system] . '_Interpreter';
			$this->database     = new $this->storage_path();
		} else {
			trigger_error('The storage system defined in your installation (' . $storage_system . ') is either not available or not properly configured.');
		}

		return $this->database;
	}

}