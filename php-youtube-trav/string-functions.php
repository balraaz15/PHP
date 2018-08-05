<?php
    # substr() - returns a portion of a string

    $output = substr('Hello', 1); // starts at 1 to the end
    $output = substr('Hello', 1, 3); // starts at 1 index and ends at 3 index

    # strlen() - Returns the length of the string
    $output = strlen('Hello World!');

    # strpos() - Finds the position of the first occurence of a substring
    $output = strpos('Hello World', 'o'); // gives the first occurence index of 'o'
    $output = strrpos('Hello World', 'o'); // give the last occurence index of 'o'

    # trim() - Strips whitespace
    $text = '   Hello World        ';
    $trimmed = trim($text);

    # strtoupper() - Uppercase
    $output = strtoupper('Hello World');
    # strtolower() - Lowercase
    $output = strtolower('Hello World');
    # ucwords() - Capitalize
    $output = ucwords('hello world');

    # str_replace() - Replace all occurence of a search string with replacement
    $text = 'Hello World';
    $output = str_replace('World', 'Everyone', $text); // replaces world with everyone

    # is_string() - checks if string
    $val = '22';
    $output = is_string($val); // returns 1

    # gzcompress() - compress a string
    $string = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

    $compressed = gzcompress($string); // compresses a string to unreadable format

    $original = gzguncompress($compressed); // uncompresses a compressed string
?>
