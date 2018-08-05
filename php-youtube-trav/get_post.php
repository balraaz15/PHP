<?php
    /*
        Cross-site scripting attacks(XSS Attacks):
        custom script tags send through the input fileds of the form

        htmlentities - Convert all applicable characters to HTML entities
     */
    /*
    if(isset($_GET['name'])) {
        print_r($_GET);
        echo $_GET['name'];
        // To prevent the XSS ATTACK
        $name = htmlentities($_GET['name']);
        echo $name;
    }

    if(isset($_POST['name'])) {
        print_r($_POST);
        echo $_POST['name'];
        // To prevent XSS Attack
        $name = htmlentities($_POST['name']);
        echo $name;
    }

    if(isset($_REQUEST['name'])) {
        print_r($_REQUEST);
        echo $_REQUEST['name'];
        // To prevent XSS Attack
        $name = htmlentities($_REQUEST['name']);
        echo $name;
    }

   echo $_SERVER['QUERY_STRING']; // gives the query string as it would appear on URL
   */
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>My Website</title>
    </head>
    <body>
        <form method="get" action="get_post.php">
            <div>
                <label>Name</label><br>
                <input type="text" name="name">
            </div>
            <div>
                <label>email</label><br>
                <input type="text" name="email">
            </div>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>
