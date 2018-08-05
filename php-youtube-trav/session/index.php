<?php
    # SESSIONS
    if (isset($_POST['submit'])) {
        session_start(); // start the session

        $_SESSION['name'] = htmlentities($_POST['name']);
        $_SESSION['email'] = htmlentities($_POST['email']);

        header('Location: page1.php');
    }
?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>PHP Sessions</title>
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" name="name" placeholder="Enter name">
            <input type="text" name="email" placeholder="Enter email">
            <input type="submit" name="submit" placeholder="Submit">
        </form>
    </body>
</html>
