<?php

class Storage_MySQL_Interpreter extends Abstracts_StorageBase {

	const DB_NAME = 'release-1.0';
	const DB_HOST = 'localhost';
	const DB_USER = 'root';
	const DB_PASS = '';

	public $pdo;

	public $last_insert_id;

	public function __construct() {}

	public function startConnection() {
		try {
			$this->pdo = new PDO('mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_HOST, self::DB_USER, self::DB_PASS);
		} catch (PDOException $e) {
			trigger_error('MySQL Database Connection Failed: ' . $e->getMessage());
		}
	}

	public function executeQuery($sql, $params = array()) {
		try {
			$stmt = $this->pdo->prepare($sql);
			if (!empty($params)) {
				foreach ($params as $key => $value) {
					$row_data = $this->bindDataType($value);
					$stmt->bindParam(':' . $key, $row_data['value'], $row_data['type']);
					$stmt->bindValue($key, $value);
				}
			}
			$stmt->execute();
			$stmt->closeCursor();
			unset($stmt);
		} catch (PDOException $e) {
			trigger_error($e->getMessage());
		}
	}

	public function getRow($sql, $params = array()) {
		$result = array();
		try {
			$stmt = $this->pdo->prepare($sql);
			if (!empty($params)) {
				foreach ($params as $key => $value) {
					$row_data = $this->bindDataType($value);
					$stmt->bindParam(':' . $key, $row_data['value'], $row_data['type']);
					$stmt->bindValue($key, $value);
				}
			}
			$stmt->execute();
			$result = $stmt->fetchColumn(0);

			$stmt->closeCursor();
			unset($stmt);
		} catch (PDOException $e) {
			trigger_error($e->getMessage());
		}

		return $result;
	}

	/*
	 * PDO::FETCH_ASSOC: Returns an associated array by column names.
	 * PDO::FETCH_NUM: Returns an indexed array by column number.
	 * PDO::FETCH_BOTH: Returns both an associated array and numerical by columns.
	 */
	//-- TODO: $params should eventually accept ? rather than :column.
	public function getRows($sql, $params = array(), $type = PDO::FETCH_ASSOC) {
		$result = array();
		try {
			$stmt = $this->pdo->prepare($sql);
			if (!empty($params)) {
				foreach ($params as $key => $value) {
					$row_data = $this->bindDataType($value);
					$stmt->bindParam(':' . $key, $row_data['value'], $row_data['type']);
					$stmt->bindValue($key, $value);
				}
			}
			$stmt->execute();
			$result = $stmt->fetch($type);

			$stmt->closeCursor();
			unset($stmt);
		} catch (PDOException $e) {
			trigger_error($e->getMessage());
		}

		return $result;
	}

	public function getLastInsertId() {
		return $this->pdo->lastInsertId();
	}

	/*
	 * Assigns a PDO PARAM to 'type' and sanitizes 'value'.
	 */
	public function bindDataType($input) {
		$response = array(
			'value' => $input,
			'type' => '',
		);

		if (empty($response['value'])) {
			$response['type'] = PDO::PARAM_NULL;
		} else if (is_int($response['value'])) {
			$response['type'] = PDO::PARAM_INT;
		} else if (is_string($response['value'])) {
			$response['type'] = PDO::PARAM_STR;
			$response['value'] = htmlspecialchars(trim($response['value']), ENT_QUOTES);
		} else if (is_bool($response['value'])) {
			$response['type'] = PDO::PARAM_BOOL;
		}

		return $response;
	}

}