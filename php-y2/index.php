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
    The last part (PDO::ATTR_ERRMODE => PDO_ERRMODE_EXEPTION) is important! Without it, the database will not show any errors and it will be very difficult to see if you’ve made any mistakes
    */

    require 'DatabaseTable.php'; // Importing all the basic database query functions

    $personTable = new DatabaseTable($pdo, 'person');
    $messageTable = new DatabaseTable($pdo, 'messages');

    if(isset($_GET['up']) && $_GET['up'] == 1) {
        echo '<p class="alert">Record updated</p>';
    }

    if(isset($_GET['did'])) {
        unset($_GET['up']);
        /*
        (good practice):
        When you know that only one record should be deleted, using LIMIT 1 will prevent other records being deleted if there is a missing WHERE clause
         */
        $del = $pdo->prepare('DELETE FROM person WHERE person_id = :id LIMIT 1');
        $criteria =['id' => $_GET['did']];
        $del->execute($criteria);

        if($del) {
            echo '<p class="alert">Person successfully deleted.</p>';
        } else {
            echo '<p class="alert">An error occured.</p>';
        }
    }

    if(isset($_GET['logout'])) {
        unset($_SESSION['username']);
        session_destroy();
        header('location:login.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PHP Sandbox</title>
  <script>
      let alert = document.querySelector('.alert');
      setTimeout(function(){alert.style.display = "none"}, 3000);
  </script>
</head>
<body>
    <h5 style="float:right;">Welcome back, <?php echo $_SESSION['username']; ?>!  <a href="index.php?logout=1" title="">Logout</a></h5>
    <h3>Search a specific person</h3>
    <form method="POST">
        <input type="text" name="searchField">
        <select name="searchFrom">
            <option value="">-- Select column --</option>
            <option value="firstname">Firstname</option>
            <option value="lastname">Lastname</option>
            <option value="email">Email</option>
            <option value="dob">Date of Birth</option>
        </select>
        <input type="submit" name="search" value="Search">
    </form>

    <!-- Displaying the existing persons based on the value entered in the search box and the column selected from the dropdown -->
    <?php
        if(isset($_POST['search'])){
            $searchValue = $_POST['searchField'];
            if(!empty($_POST['searchFrom'])) {
                // $results = $pdo->prepare('SELECT * FROM person WHERE '.$_POST['searchFrom'].' = :searchValue');
                // $criteria = [
                //     'searchValue' => $searchValue
                // ];
                // $results->execute($criteria);

                $results = $personTable->find($_POST['searchFrom'], $searchValue);
                foreach($results as $row) {
                    echo '<p>'.$row['firstname'].' '.$row['lastname'].' was born on '.$row['dob'].' and their email address is "'.$row['email'].'"</p>';
                }
            } else {
                echo '<p class="alert">Please Select a column to search the value in.</p>';
            }
        }
    ?>

    <h3><a href="addedit.php">Register a new Person</a></h3>

    <!-- Displaying the existing persons based on the value entered in the search box based on their name -->
    <?php
        /*if(isset($_POST['search'])) {
            $searchValue = $_POST['searchField'];
            $results = $pdo->query('SELECT * FROM person WHERE firstname="'.$searchValue.'" OR lastname = "'.$searchValue.'"');
            foreach($results as $row) {
                echo '<p>'.$row['firstname'].' '.$row['lastname'].' was born on '.$row['dob'].' and their email address is "'.$row['email'].'"</p>';
            }
        }*/
    ?>

    <!-- Selecting all the persons that are currently in the database -->
    <?php
        // $results = $pdo->prepare('SELECT * FROM person');
        // $results->execute();

        $results = $personTable->findAll();
        foreach($results as $row) {
            echo '<p>'.$row['firstname'].' '.$row['lastname'].' was born on '.$row['dob'].' and their email address is "'.$row['email'].'"  <a href="addedit.php?eid='.$row['person_id'].'">Edit</a>  <a href="index.php?did='.$row['person_id'].'">Delete</a></p>';
        }
    ?>

    <!-- For posting the message by different persons. -->
    <h3>Send a message.</h3>
    <form method="POST">
        <input type="text" name="message" placeholder="Enter a message">
        <select name="messageSender">
            <option value="">-- Select Sender --</option>
            <?php
                // $results = $pdo->prepare('SELECT * FROM person');
                // $results->execute();

                $results = $personTable->findAll();
                foreach($results as $row):
            ?>
            <option value="<?php echo $row['person_id']; ?>"><?php echo $row['firstname'].' '.$row['lastname']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" name="send" value="Send">
    </form>

    <!-- Inserting the message to database -->
    <?php
        if(isset($_POST['send'])) {
            if(!empty($_POST['message']) && $_POST['messageSender'] != "") {
                date_default_timezone_set('Asia/Kathmandu');
                $date = date('Y-m-d H:i:s');

                // $send = $pdo->prepare('INSERT INTO messages(message, post_date, person_id)
                //                     VALUES(:message, :post_date, :p_id)');
                $criteria = [
                    'message' => $_POST['message'],
                    'post_date' => $date,
                    'person_id' => $_POST['messageSender']
                ];
                // $send->execute($criteria);

                $send = $messageTable->save($criteria, 'message_id');

                if($send) {
                    echo '<p class="alert">Message Sent.</p>';
                } else {
                    echo '<p class="alert">Message NOT sent.</p>';
                }
            } else if(empty($_POST['message'])) {
                echo '<p class="alert">Message not entered.</p>';
            } else {
                echo '<p class="alert">Please select a sender</p>';
            }
        }
    ?>

    <!-- Displaying all the messages -->
    <?php
        // $messages = $pdo->prepare('SELECT * FROM messages');
        // $messages->execute();

        $messages = $messageTable->findAll();

        foreach($messages as $msg) {
            // $person = $pdo->prepare('SELECT * FROM person WHERE person_id = :p_id');
            // $criteria = ['p_id' => $msg['person_id']];
            // $person->execute($criteria);
            // $p = $person->fetch();

            // echo $msg['person_id'];
            $person = $personTable->find('person_id', $msg['person_id'])->fetch();

            echo '<p>'.$person['firstname'].' '.$person['lastname'].' sent <strong>'.$msg['message'].'</strong> on '.$msg['post_date'].'</p>';
        }
    ?>
</body>
</html>