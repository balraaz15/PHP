<?php include 'server-info.php'; ?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <title>System Information</title>
    </head>
    <body>
        <div class="container">
            <h1>Server & File Info</h1>
            <?php if($server): ?>
                <ul class="list-group">
                    <?php foreach($server as $key => $value): ?>
                        <li class="list-group-item">
                            <strong><?php echo "$key: "; ?></strong>
                            <?php echo $value; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <h1>Client & File Info</h1>
            <?php if($client): ?>
                <ul class="list-group">
                    <?php foreach($client as $key => $value): ?>
                        <li class="list-group-item">
                            <strong><?php echo "$key: "; ?></strong>
                            <?php echo $value; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </body>
</html>
