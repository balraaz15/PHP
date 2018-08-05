<?php
	$user = [
		'name' => 'Nemanja',
		'age' => 35,
		'email' => 'test@test.com'
	];

	# Serialize - Generates a storable representation of a value
	// Array cannot be stores in a cookie
	$user = serialize($user);

	setcookie('user', $user, time() + 3600);

	// Serialized array cannot be accessed
	// The code below does not work
	/*$user = $_COOKIE['user'];
	echo $user['name'];*/

	# Unserialize - Cretes a PHP value froma stored representation
	// The array should be unserialized to access the values
	$user = unserialize($_COOKIE['user']);
	echo $user['name'];
	var_dump($user);
?>