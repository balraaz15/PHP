<?php
	// Connecting to database using PDO
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $schema = 'test';

    $pdo = new PDO('mysql:dbname='.$schema.';host='.$server, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    /*
    The last part (PDO::ATTR_ERRMODE => PDO_ERRMODE_EXEPTION) is important! Without it, the database will not show any errors and it will be very difficult to see if you’ve made any mistakes
    */
?>