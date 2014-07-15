<?php

class Processes_Activate {

	public $database;
	public $activate;
	public $activation_code;

	public function __construct($database) {
		$this->database        = $database;
		$this->activate        = new Storage_MySQL_Guest($this->database);
		$this->activation_code = '';
	}

	public function setActivationCode($activation_code) {
		$this->activation_code = $activation_code;
	}

	public function activateUser() {
		if ($this->activate->isValidActivationCode($this->activation_code) === true) {
			$this->activate->activateUser($this->activation_code);
		}
	}

	public function getActivationStatus() {
		if ($this->activate->isActivated($this->activation_code) === true) {
			return 'account_active';
		} else {
			return 'account_inactive';
		}
	}
}