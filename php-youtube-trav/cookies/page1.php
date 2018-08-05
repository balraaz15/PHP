<?php
	// Change the cookie
	/*setcookie('username', 'Frank', time()+(86400 * 30));*/

	// Delete cookie
	/*setcookie('username', $username, time()-3600);*/

	if (count($_COOKIE) > 0) {
		echo 'There are ' .count($_COOKIE). ' cookies saved <br>';
	} else {
		'There are no cookies saved';
	}

	if (isset($_COOKIE['username'])) {
		echo 'User '. $_COOKIE['username']. ' is set.';
	} else {
		echo "User is not set.";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PHP Cookies</title>
	<link rel="stylesheet" href="">
</head>
<body>

</body>
</html>