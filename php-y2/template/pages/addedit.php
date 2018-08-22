<?php
	require '../dbconnect/connection.php';
    require '../classes/DatabaseTable.php'; // Importing all the basic database query functions

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
				echo '<p class="alert alert-success alert-dismissible fade show" role="alert">Person Updated!</p>';
			} else {
				echo '<p class="alert alert-success alert-dismissible fade show" role="alert">Person not Updated</p>';
			}
		}

		$templateVars = [
	    	'title' => 'Add or Edit',
	    	'edit' => $edit,
	    	'row' => $row
	    ];

    } else {
    	if(isset($_POST['submit'])) {
	        $records = [
	            'firstname' => $_POST['firstname'],
	            'lastname' => $_POST['lastname'],
	            'dob' => $_POST['dob'],
	            'email' => $_POST['email']
	        ];
	        $insert = $personTable->save($records, 'person_id');

	        if($insert) {
	            echo '<p class="alert alert-success alert-dismissible fade show" role="alert">New Person Added.</p>';
	        } else {
	            echo '<p class="alert alert-warning alert-dismissible fade show" role="alert">A Problem Occured.</p>';
	        }
	    }

	    $templateVars = [
	    	'title' => 'Add or Edit',
	    	'edit' => $edit
	    ];

    }

    $title = 'Add or Edit Persons';
    $content = loadTemplate('../views/addedit-template.php', $templateVars);
?>