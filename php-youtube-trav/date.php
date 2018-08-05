<?php
    /*
    echo date('d'); // Day
    echo date('m'); // Month
    echo date('Y'); // Year
    echo date('l'); // Day of the week
    */
    echo date('Y/m/d');
    echo "  ";

    /*
    echo date('h'); // hour
    echo date('i'); // minutes
    echo date('s'); // seconds
    echo date('a'); // AM or PM
    */

    //set timezone
    date_default_timezone_set('Asia/Kathmandu');

    echo date('h:i:sa');

    /*
        Unix timestamp is a long integer containing the number of seconds between the Unix Epoch(January 1 1970 00:00:00 GMT) and the time specified.
     */
    $timestamp = mktime(10, 14, 54, 9, 10, 1981); // hours, mins, ,secs, month, day, year
    echo $timestamp;

    // Converting timestamp to date
    echo date('m-d-Y h:i:sa', $timestamp);

    # String to time
    $timestamp2 = strtotime('7:00pm March 22 2016');
    $timestamp3 = strtotime('tomorrow');
    $timestamp4 = strtotime('next Sunday');
    $timestamp5 = strtotime('+2 Days');

    echo "<br>";
    echo date('m-d-Y h:i:sa', $timestamp2);
    echo "<br>";
    echo date('m-d-Y h:i:sa', $timestamp3);
    echo "<br>";
    echo date('m-d-Y h:i:sa', $timestamp4);
    echo "<br>";
    echo date('m-d-Y h:i:sa', $timestamp5);
?>
