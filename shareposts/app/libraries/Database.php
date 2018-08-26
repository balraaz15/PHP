<?php
	class Database {
		// Connecting to database using PDO
	    private $server = 'localhost';
	    private $username = 'root';
	    private $password = '';
	    private $schema = 'shareposts';
	    private $options = [
	    	PDO::ATTR_PERSISTENT => true,
	    	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	    ];
	    private $pdo;
	    private $table;
	    private $stmt;

	    public function __construct($table) {
	    	try {
	    		$pdo = new PDO('mysql:dbname='.$this->schema.';host='.$this->server, $this->username, $this->password, $this->options);
			    /*
			    The last part (PDO::ATTR_ERRMODE => PDO_ERRMODE_EXEPTION) is important! Without it, the database will not show any errors and it will be very difficult to see if you’ve made any mistakes
			    */
			   $this->pdo = $pdo;
			   $this->table = $table;
	    	} catch(PDOException $e) {
	    		echo $e->getMessage();
	    	}
	    }

	    public function findAll() {
			$this->stmt = $this->pdo->prepare('SELECT * FROM '.$this->table);
			$this->stmt->execute();
			return $this->stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function find($attribute, $value) {
			$this->stmt = $this->pdo->prepare('SELECT * FROM '.$this->table.' WHERE '.$attribute.' = :value');
			$criteria = ['value' => $value];
			$this->stmt->execute($criteria);

			if($this->stmt->rowCount() > 0) {
				return $this->stmt->fetch(PDO::FETCH_OBJ);
			} else {
				return false;
			}
		}

		function save($criteria, $primaryKey) {
			try {
				$send = $this->insert($criteria);
				return $send;
			} catch(Exception $e) {
				$update = $this->update($criteria, $primaryKey);
				return $update;
			}
		}

		function insert($criteria) {
			$attr = array_keys($criteria);

			$attributes = implode(', ', $attr);
			$values = implode(', :', $attr);

			$this->stmt = $this->pdo->prepare('INSERT INTO '.$this->table.'('.$attributes.')
									VALUES(:'.$values.')');
			$this->stmt->execute($criteria);
			return $this->stmt;
		}

		function update($criteria, $primaryKey) {
			$query = 'UPDATE '.$this->table.' SET ';

			$params = [];
			foreach($criteria as $key=>$value) {
				$params[] = $key .' = :'.$key;
			}

			$query .= implode(', ', $params);
			$query .= ' WHERE '.$primaryKey.' = :primaryKey';

			$criteria['primaryKey'] = $criteria[$primaryKey];
			$this->stmt = $this->pdo->prepare($query);

			$this->stmt->execute($criteria);
			return $this->stmt; // returns either true or false
		}

		function delete($attribute, $value) {
			$this->stmt = $this->pdo->prepare('DELETE FROM '.$this->table. ' WHERE '.$attribute. ' = :value');
			$criteria = ['value' => $value];
			$this->stmt->execute($criteria);
			return $this->stmt; // returns either true or false
		}

// =============================================================================================================
// FOR OTHER QUERIES THAT COULD NOT SUFFICE THE ABOVE FUNCTIONS

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