<!-- ARRAYS -->
<?php
    # PHP - Array Functions: http://php.net/manual/en/ref.array.php
    #
    
    # Types of Arrays
    /*
        - Indexed
        - Associative
        - Multi-dimensional
     */

    # Indexed
    $people = array('Kevin', 'Jeremy', 'Sara');
    $ids = array(1,2,3);
    $cars = ['Honda', 'Toyota', 'Ford'];

    // Adding to array (with index)
    $cars[3] = 'Tesla';
    // Adding to array (without index) - adds to last
    $cars[] = 'Jaguar';

    // Array methods
    echo count($cars); // Size of an array
    print_r($cars); // Echo for arrays - Prints the entire array
    var_dump($cars); // More informative than print_r (can be used for variables as well)


    # Associative
    // Using key value pair
    $people = array(
        'Nemanja' => 30,
        'Anthony' => 21
    );
    echo $people['Nemanja']; // prints 30

    $ids = [
        15 => 'Nemanja',
        11 => 'Anthony'
    ];
    echo $ids[15]; // prints Nemanja

    // Adding to array
    $people['David'] = 25;

    // Type casting and overwriting
    $array = [
        1 => "a",
        "1" => "b",
        1.5 => "c",
        true => "d"
    ];
    /*
        As all the keys inthe above example are cast to 1, the value will be overwritten on every new element and the last assigned value "d" is only the left over.
     */


    # Multi-Dimensional
    $cars = [
        ['Honda', 20, 10],
        ['Toyota', 30, 20],
        ['Ford', 25, 15, ['Petrol', 30]]

        // array('Honda', 20, 10),
        // array('Toyota', 30, 20),
        // array('Ford', 25, 15, array('Petrol', 30))
    ];
    var_dump($cars[2][3]);
    echo $cars[2][3][0]; // prints Toyota

?>
