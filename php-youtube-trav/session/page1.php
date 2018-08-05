<?php
	session_start();

	$name = $_SESSION['name'];
	$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>PHP Sessions</title>
</head>
<body>
	<h4>Thank You <?php echo $name; ?>. You have subscribed with the email <?php echo $email; ?></h4>
	<a href="page2.php" title="Go to Page 2">Go to Page 2</a>
</body>
</html>