<?php
	session_start();
    if(!isset($_SESSION['username'])) {
        header('location:login.php');
    }

    // Connecting to database using PDO
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $schema = 'test';

    $pdo = new PDO('mysql:dbname='.$schema.';host='.$server, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    /*
    The last part (PDO::ATTR_ERRMODE => PDO_ERRMODE_EXEPTION)
    is important! Without it, the database will not show any errors and it will be very difficult to see if you’ve made any mistakes*/

    require 'DatabaseTable.php';

    $personTable = new DatabaseTable($pdo, 'person');
    $messageTable = new DatabaseTable($pdo, 'messages');

	$edit = false;
	if(isset($_GET['eid'])) {
		$edit = true;
		$row = $personTable->find('person_id', $_GET['eid'])->fetch();
    	// $result = $pdo->query('SELECT * FROM person WHERE person_id = '.$_GET['eid']);
    	// $row = $result->fetch();

    	if(isset($_POST['submit'])) {
			$records = [
				'person_id' => $_POST['person_id'],
	            'firstname' => $_POST['firstname'],
	            'lastname' => $_POST['lastname'],
	            'dob' => $_POST['dob'],
	            'email' => $_POST['email']
	        ];

			$update = $personTable->save($records, 'person_id');

			if($update) {
				header('location:index.php?up=1');
			} else {
				echo 'Record Not Updated';
			}
		}
    } else {
    	if(isset($_POST['submit'])) {
	        $records = [
	            'firstname' => $_POST['firstname'],
	            'lastname' => $_POST['lastname'],
	            'dob' => $_POST['dob'],
	            'email' => $_POST['email']
	        ];
	        $result = $personTable->insert($records);

	        if($result) {
	            echo '<p class="alert">New Person Added.</p>';
	        } else {
	            echo '<p class="alert">A Problem Occured.</p>';
	        }
	    }
    }
?>

<h3><?php if($edit) echo 'Edit a Person'; else echo 'Add a person' ?></h3>
<form method="POST">
	<input type="hidden" name="person_id" value="<?php if($edit) echo $row['person_id']; ?>">
    <input type="text" name="firstname" placeholder="Firstname" value="<?php if($edit) echo $row['firstname']; ?>"><br><br>
    <input type="text" name="lastname" placeholder="Lastname" value="<?php if($edit) echo $row['lastname']; ?>"><br><br>
    <input type="date" name="dob" value="<?php if($edit) echo $row['dob']; ?>"><br><br>
    <input type="email" name="email" placeholder="email" value="<?php if($edit) echo $row['email']; ?>"><br><br>
    <input type="submit" name="submit" value="<?php if($edit) echo 'Update'; else echo 'Submit'; ?>">
</form>