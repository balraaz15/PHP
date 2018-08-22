<?php
	// session_start();
 //    if(!isset($_SESSION['username'])) {
 //        header('location:login.php');
 //    }

    require '../dbconnect/connection.php';
    require '../classes/DatabaseTable.php'; // Importing all the basic database query functions

    $personTable = new DatabaseTable($pdo, 'person');
    $messageTable = new DatabaseTable($pdo, 'messages');

  	$listPersons = $personTable->findAll();
  	$listMessages = $messageTable->findAll();

    $templateVars = [
        'listPersons' => $listPersons,
        'listMessages' => $listMessages,
        'personTable' => $personTable
    ];

    $title = 'List Persons and Messages';
    $content = loadTemplate('../views/list-template.php', $templateVars);
?>