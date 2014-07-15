<?php

class Storage_MySQL_Guest {

	public $database;

	public function __construct(Storage_MySQL_Interpreter $database) {
		$this->database = $database;
	}

	public function registerUser($form_data) {
		$query = '
			INSERT INTO pc_users(display_name, email_address, password, roles_id, activation_code, ip_address, hostname)
			VALUES (:display_name, :email_address, :password, :roles_id, :activation_code, :ip_address, :hostname)
		';
		$this->database->executeQuery($query, $form_data);
	}

	public function getNewUserId() {
		return $this->database->getLastInsertId();
	}

	public function checkDisplayExists($display_name) {
		$query = '
			SELECT COUNT(*)
			FROM pc_users
			WHERE display_name = :display_name
		';
		$count = (int) $this->database->getRow($query, array('display_name' => $display_name));
		if ($count !== 0) {
			return true;
		} else {
			return false;
		}
	}

	public function checkEmailExists($email_address) {
		$query = '
			SELECT COUNT(*)
			FROM pc_users
			WHERE email_address = :email_address
		';
		$count = (int) $this->database->getRow($query, array('email_address' => $email_address));
		if ($count !== 0) {
			return true;
		} else {
			return false;
		}
	}

	public function isValidActivationCode($activation_code) {
		$query = '
			SELECT COUNT(*)
			FROM pc_users
			WHERE activation_code = :activation_code
		';
		$count = (int) $this->database->getRow($query, array('activation_code' => $activation_code));
		if ($count !== 0) {
			return true;
		} else {
			return false;
		}
	}

	public function activateUser($activation_code) {
		$query = '
			UPDATE pc_users
			SET activation_status = 1
			WHERE activation_code = :activation_code
		';
		$this->database->executeQuery($query, array('activation_code' => $activation_code));
	}

	public function isActivated($activation_code) {
		$query = '
			SELECT activation_status
			FROM pc_users
			WHERE activation_code = :activation_code
			LIMIT 1
		';
		$result = (int) $this->database->getRow($query, array('activation_code' => $activation_code));
		if ($result === 1) {
			return true;
		} else {
			return false;
		}
	}

}