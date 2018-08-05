<?php
	class Person{
		private $name;
		private $email;
		private static $ageLimit = 40; // static variables can be accesed without having to create an object

		// Constructor
		public function __construct($name, $email) {
			$this->name = $name;
			$this->email = $email;
			echo __CLASS__.' created<br>'; // gives the name of the class (MAGIC METHOD)
		}

		public function __destruct(){
			echo __CLASS__.' destructed <br>';
		}

		public function setName($name) {
			$this->name = $name;
		}
		public function setEmail($email) {
			$this->email = $email;
		}

		public function getName() {
			return $this->name;
		}
		public function getEmail() {
			return $this->email;
		}

		// Static method
		public static function getAgeLimit() {
			// While using static properties, self is used instead of $this
			return self::$ageLimit;
		}
	}

	// To access the static variable and method inside of Person class
	// echo Person::$ageLimit; // valid when the static variable is public
	echo Person::getAgeLimit();
	echo "<br>";

	// Without using the constructor method
	/*$person1 = new Person;

	$person1->name = 'John Doe';
	echo $person1->name;

	$person1->setName('John Doe');
	echo $person1->getName();
	echo "<br>";*/

	// Using the constructor method
	/*$person2 = new Person('Fernando', 'test@test.com');
	echo $person2->getName();
	echo "<br>";*/


	class Customer extends Person{
		private $balance;

		public function __construct($name, $email, $balance) {
			parent::__construct($name, $email, $balance);
			$this->balance = $balance;
			echo 'A new '.__CLASS__.' has been created <br>';
		}

		public function setBalance($balance) {
			$this->balance = $balance;
		}

		public function getBalance() {
			return $this->balance;
		}
	}

	$customer1 = new Customer('Nemanja', 'test@test.com', 300);
	echo $customer1->getName();
	echo "<br>";
	echo $customer1->getBalance();
	echo "<br>";
?>