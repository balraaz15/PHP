<?php
	function findAll($pdo, $table){
		$stmt = $pdo->prepare('SELECT * FROM '.$table);
		$stmt->execute();
		return $stmt;
	}

	function find($pdo, $table, $attribute, $value) {
		$stmt = $pdo->prepare('SELECT * FROM '.$table.' WHERE '.$attribute.' = :value');
		$criteria = ['value' => $value];
		$stmt->execute($criteria);
		return $stmt;
	}

	function save($pdo, $table, $criteria, $primaryKey) {
		try {
			$send = insert($pdo, $table, $criteria);
			return $send;
		} catch(Exception $e) {
			$update = update($pdo, $table, $criteria, $primaryKey);
			return $update;
		}
	}

	function insert($pdo, $table, $criteria) {
		$attr = array_keys($criteria);

		$attributes = implode(', ', $attr);
		$values = implode(', :', $attr);

		$stmt = $pdo->prepare('INSERT INTO '.$table.'('.$attributes.')
								VALUES(:'.$values.')');
		$stmt->execute($criteria);
		return $stmt;
	}

	function update($pdo, $table, $criteria, $primaryKey) {
		$query = 'UPDATE '.$table.' SET ';

		$params = [];
		foreach($criteria as $key=>$value) {
			$params[] = $key .' = :'.$key;
		}

		$query .= implode(', ', $params);
		$query .= ' WHERE '.$primaryKey.' = :primaryKey';

		$criteria['primaryKey'] = $criteria[$primaryKey];
		$stmt = $pdo->prepare($query);

		$stmt->execute($criteria);
		return $stmt; // returns either true or false
	}

	function delete($pdo, $table, $attribute, $value) {
		$stmt = $pdo->prepare('DELETE FROM '.$table. ' WHERE '.$attribute. ' = :value');
		$criteria = ['value' => $value];
		$stmt->execute($criteria);
		return $stmt; // returns either true or false
	}
?>