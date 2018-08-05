<?php
	if (isset($_POST['submit'])) {
		$username = htmlentities($_POST['username']);

		// set a cookie
		setcookie('username', $username, time()+3600); // name of a cookie, value, expiration(1 hour)

		header('Location: page1.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PHP Cookie</title>
</head>
<body>
	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<input type="text" name="username" value="" placeholder="Enter Username">
		<br>
		<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>