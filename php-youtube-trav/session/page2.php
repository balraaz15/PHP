<?php
	session_start();

	var_dump($_SESSION);

	$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest';
	$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>PHP Sessions</title>
</head>
<body>
	<h1>Hello <?php echo $name; ?></h1>
	<a href="page3.php" title="">Unset the session name</a>
</body>
</html>