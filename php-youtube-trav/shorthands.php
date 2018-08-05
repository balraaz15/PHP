<?php
    # Ternary Operator
    $loggedIn = false;
    // echo ($loggedIn) ? 'You are logged in' : 'You are not logged in';

    $isRegistered = ($loggedIn == true) ? true : false;
    // echo $isRegistered;

    # Nested Ternary
    $age = 7;
    $score = 12;
    // echo 'Your score is: '.($score > 10 ? ($age > 10 ? 'Average' : 'Exceptional') : ($age > 10 ? 'Horrible' : 'Average'));

    $arr = [1,2,3,4,5];
?>

<div>
    <?php if($loggedIn) { ?>
        <h1>Welcome User!</h1>
    <?php } else { ?>
        <h1>Welcome Guest!</h1>
    <?php } ?>
</div>

<div>
    <?php if($loggedIn): ?>
        <h1>Welcome User!</h1>
    <?php else: ?>
        <h1>Welcome Guest!</h1>
    <?php endif; ?>
</div>

<div>
    <?php //foreach($arr as $a): ?>
    <?php //endforeach; ?>

    <?php //for($i=0; i<10; i++): ?>
    <?php //endfor; ?>
</div>
