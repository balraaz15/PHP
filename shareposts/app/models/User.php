<?php
	class User {
		private $db;

		public function __construct() {
			$this->db = new Database('users');
		}

		public function register($data) {
			$data = array_slice($data, 1, 3);
			$result = $this->db->save($data, 'id');

			if($result) {
				return true;
			} else {
				return false;
			}
		}

		// Login User
		function login($email, $password) {
			$row = $this->findUserByAttr('email', $email);

			$hashed_password = $row->password;
			if(password_verify($password, $hashed_password)) {
				return $row;
			} else {
				return false;
			}
		}

		// Find user by attribute
		public function findUserByAttr($attr, $value) {
			$result = $this->db->find($attr, $value);

			// Check row
			if($result != false) {
				return $result;
			} else {
				return false;
			}
		}
	}
?>