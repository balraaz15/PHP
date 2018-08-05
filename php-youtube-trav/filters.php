<?php
    # FILTERS AND VALIDATIONS
    #
    # PHP - Types of filters: http://php.net/manual/en/filter.filters.php

    // Check if variable of specified type exists
    // Check for posted data

    # bool filter_has_var ( int $type , string $variable_name )
    # INPUT_GET, INPUT_POST, INPUT_COOKIE, INPUT_SERVER, or INPUT_ENV.


    /*if (isset($_POST['submit'])) {
        if ($_POST['email'] != '') {
            if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
                echo 'Email is valid';
            } else {
                echo 'Email is not valid';
            }
        } else {
            echo 'Please enter email';
        }
    }*/

    if (filter_has_var(INPUT_POST, 'email')) {
        $email = $_POST['email'];

        // Remove illegal chars
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        echo $email.'<br>';

        echo "Data Found <br>";
        // if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email is valid <br>";
        } else {
            echo "Email is not valid <br>";
        }
    } else {
        echo "Please enter email <br>";
    }

    # Types of Validation
    /*
        - FILTER_VALIDATE_EMAIL
        - FILTER_VALIDATE_BOOLEAN
        - FILTER_VALIDATE_FLOAT
        - FILTER_VALIDATE_INT
        - FILTER_VALIDATE_IP
        - FILTER_VALIDATE_REGEXP
        - FILTER_VALIDATE_URL
     */

    # Types of sanitization
    /*
        - FILTER_SANITIZE_EMAIL
        - FILTER_SANITIZE_ENCODED
        - FILTER_SANITIZE_NUMBER_FLOAT
        - FILTER_SANITIZE_NUMBER_INT
        - FILTER_SANITIZE_SPECIAL_CHARS
        - FILTER_SANITIZE_STRING
        - FILTER_SANITIZE_URL
     */

    # Integer Validation
    /*$var = '23';
    if(filter_var($var, FILTER_VALIDATE_INT)) {
        echo "$var is a number";
    } else {
        echo "$var is not a number";
    }*/

    # Integer Sanitization
    /*$var = '35khk3532lk6h23k4';
    var_dump(filter_var($var, FILTER_SANITIZE_NUMBER_INT)); // removes other characters except numbers
    echo filter_var($var, FILTER_SANITIZE_NUMBER_INT);*/

    # Special characters sanitization (XSS Attack example)
    /*$var = "<script>alert('CAUTION: You have been attacked!');</script>";
    // echo $var; // runs the script
    echo filter_var($var, FILTER_SANITIZE_SPECIAL_CHARS); // converts the script tag to harmless entities. Does not run the script */

    # To specify the validation for each field and different options
    // Using filter_input_array() - Gets external variables and optionally filters them
    /*$filters = [
        'email' => FILTER_VALIDATE_EMAIL,
        'data' => array(
            'filter' => FILTER_VALIDATE_INT,
            'options' => array(
                'min_range' => 1,
                'max_range' => 100
            )
        )
    ];

    print_r(filter_input_array(INPUT_POST, $filters));*/

    // Using filter_var_array() - Gets multiple variables and optionally filters them
    /*$arr = array(
        'name' => 'nemanja vidic',
        'age' => '35',
        'email' => 'nemanja@email.com'
    );

    $filters = array(
        'name' => array(
            'filter' => FILTER_CALLBACK, // allows to apply a function specified in options
            'options' => 'ucwords'
        ),
        'age' => array(
            'filter' => FILTER_VALIDATE_INT,
            'options' => array(
                'min_range' => 1,
                'max_range' => 100
            )
        ),
        'email' => FILTER_VALIDATE_EMAIL
    );

    $vars = filter_var_array($arr, $filters);
    var_dump($vars);*/
?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="email">
    <input type="text" name="data">
    <input type="submit" name="submit" value="Submit">
</form>
