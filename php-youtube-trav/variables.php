<?php
    // Single line comment
    # Single line comment
    /*
    Multi
    line
    comment
     */

    # DATA TYPES
    $str1 = 'Hello World'; // String
    $number = 5; // Number
    $floats = 5.3; // Float
    $booleans = true; // Boolean
    /*
        - Array
        - Object
        - NULL
        - Resource
     */

    # String Concatenation
    $str1 = 'Hello';
    $str2 = 'World';
    $greeting = $str1.' '.$str2;
    $greeting2 = "$str1 $str2";

    # CONSTANTS
    # Method 1 - matching the case of variable while echo
    define('GREETING', 'Hello Everyone!');
    echo GREETING;

    # Method 2 - not mathching the case of variable while echo
    define('GREETING', 'Hello Everyone!', true);
    echo greeting;
?>
