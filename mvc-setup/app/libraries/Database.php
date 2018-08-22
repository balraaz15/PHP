<?php
	/*
	 * PDO Databse Class
	 * Connect to database
	 * Create prepared statements
	 * Bind Values
	 * Return rows and results
	 */

	class Database {
		private $host = DB_HOST;
		private $username = DB_USER;
		private $password = DB_PASS;
		private $dbname = DB_NAME;

		private $pdo;
		private $stmt;
		private $error;

		public function __construct() {
			try{
				$this->pdo = new PDO('mysql:host='.$this->host. ';dbname=' .$this->dbname, $this->username, $this->password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
			} catch(Exception $e) {
				$this->error = $e->getMessage();
				echo $this->error;
			}
		}

		// Prepare statement with query
		public function query($sql) {
			$this->stmt = $this->pdo->prepare($sql);
		}

		// Bind values
		public function bind($param, $value, $type = null) {
			if(is_null($type)) {
				switch(true) {
					case is_int($value):
						$type = PDO::PARAM_INT;
						break;
					case is_boo($value):
						$type = PDO::PARAM_BOOL;
						break;
					case is_null($value):
						$type = PDO::PARAM_NULL;
						break;
					default:
						$type = PDO::PARAM_STR;
				}
			}

			$this->stmt->bindValue($param, $value, $type);
		}

		// Execute the prepared statement
		public function execute() {
			return $this->stmt->execute();
		}

		// Get result set as array of objects
		public function resultSet() {
			$this->execute();
			return $this->stmt->fetchAll(PDO::FETCH_OBJ);
		}

		// Get single record as object
		public function single() {
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_OBJ);
		}

		// GEt the row count
		public function rowCount() {
			return $this->stmt->rowCount();
		}
	}
?>