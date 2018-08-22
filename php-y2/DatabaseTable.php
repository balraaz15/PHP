<?php
	class DatabaseTable {
		private $pdo;
		private $table;

		public function __construct($pdo, $table) {
			$this->pdo = $pdo;
			$this->table = $table;
		}

		public function findAll() {
			$stmt = $this->pdo->prepare('SELECT * FROM '.$this->table);
			$stmt->execute();
			return $stmt;
		}

		public function find($attribute, $value) {
			$stmt = $this->pdo->prepare('SELECT * FROM '.$this->table.' WHERE '.$attribute.' = :value');
			$criteria = ['value' => $value];
			$stmt->execute($criteria);
			return $stmt;
		}

		function save($criteria, $primaryKey) {
			try {
				$send = insert($criteria);
				return $send;
			} catch(Exception $e) {
				$update = update($criteria, $primaryKey);
				return $update;
			}
		}

		function insert($criteria) {
			$attr = array_keys($criteria);

			$attributes = implode(', ', $attr);
			$values = implode(', :', $attr);

			$stmt = $this->pdo->prepare('INSERT INTO '.$this->table.'('.$attributes.')
									VALUES(:'.$values.')');
			$stmt->execute($criteria);
			return $stmt;
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
			$stmt = $this->pdo->prepare($query);

			$stmt->execute($criteria);
			return $stmt; // returns either true or false
		}

		function delete($attribute, $value) {
			$stmt = $this->pdo->prepare('DELETE FROM '.$this->table. ' WHERE '.$attribute. ' = :value');
			$criteria = ['value' => $value];
			$stmt->execute($criteria);
			return $stmt; // returns either true or false
		}
	}
?>