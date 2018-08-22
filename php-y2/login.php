<?php
	session_start();

	// Connecting to database using PDO
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $schema = 'test';

    $pdo = new PDO('mysql:dbname='.$schema.';host='.$server, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

	if(isset($_POST['login'])) {
		$check = $pdo->prepare('SELECT * FROM users WHERE username = :username');
		$criteria = ['username' => $_POST['username']];
		$check->execute($criteria);

		if($check->rowCount() == 1) {
			$user = $check->fetch();
			if(password_verify($_POST['password'], $user['password'])) {
				$_SESSION['username'] = $user['username'];
				header('location:index.php');
			} else {
				echo '<p>Password do not match.</p>';
			}
		} else {
			echo '<p>User not found.</p>';
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PHP Login</title>
</head>
<body>
	<form method="POST">
		<label>Username: </label>
		<input type="text" name="username" required>
		<br><br>
		<label>Password: </label>
		<input type="password" name="password" required>
		<br>
		<input type="submit" name="login" value="Sign In">
	</form>
</body>
</html>