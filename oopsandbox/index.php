<?php
	class User {
		protected $name;
		protected $age;

		// Constructor
		public function __construct($name, $age) {
			$this->name = $name;
			$this->age = $age;
		}

		// Setter and getter methods
		public function getName() {
			return $this->name;
		}
		public function setName($name) {
			$this->name;
		}

		// Setter and getter magic methods
		// __set and __get
		public function __get($property) {
			if(property_exists($this, $property)) {
				return $this->$property;
			}
		}

		public function __set($property, $value) {
			if(property_exists($this, $property)) {
				$this->$property = $value;
			}
		}
	}

	/*$u = new User('Tony', 25);

	$u->__set('name', 'Johnny');
	$u->__set('age', 32);

	echo $u->__get('name');
	echo '<br>';
	echo $u->__get('age');*/

	class Customer extends User {
		private $balance;

		public function __construct($name, $age, $balance) {
			$this->balance = $balance;
		}

		public function pay($amount) {
			parent::__construct($name, $age);
			return $this->name . ' paid $' .$amount;
		}

		public function getBalance() {
			return $this->balance;
		}
	}

	$c = new Customer('Harry', 20, 5000);
	echo $c->pay(100);
?>