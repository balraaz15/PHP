<?php
    // Message variables for alerts when empty values or invalid email
    $msg = '';
    $msgClass = '';

    // Check for submit
    if (filter_has_var(INPUT_POST, 'submit')) {
        // Get form data
        // htmlspecialchars - Convert special characters to HTML entities
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['msg']);

        // Check required fields
        if(!empty($email) && !empty($name) && !empty($message)) {
            // Check email in server site
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $msg = 'Please use valid email';
                $msgClass = 'alert-danger';
            } else {
                # Send Email (Sending email won't work on Xampp. It has to be on the live site)
                // Recipient email
                $toEmail = 'raazsanz9@gmail.com';
                // Subject
                $subject = 'Contact Request From '.$name;
                // Body
                $body = '<h2>Contact Request</h2>
                            <h4>Name: </h4><p>'.$name.'</p>
                            <h4>Email: </h4><p>'.$email.'</p>
                            <h4>Message: </h4><p>'.$message.'</p>';

                // Email Headers
                $headers = "MIME-Version:1.0" ."\r\n";
                $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

                // Additional Headers
                $headers .= "From: " .$name. "<".$email.">". "\r\n";

                if (mail($toEmail, $subject, $body, $headers)) {
                    // Email sent
                    $msg = 'Your email has been sent.';
                    $msgClass = 'alert-success';
                } else {
                    $msg = 'Your email is not sent.';
                    $msgClass = 'alert-danger';
                }
            }
        } else {
            $msg = 'Please fill in all the fields.';
            $msgClass = 'alert-danger';
        }
    }

?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
        <title>Contact Us</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand">Contact</a>
                </div>
            </div>
        </nav>

        <div class="container" style="padding-top:50px;">
            <!-- For alert message if values are empty or email is invalid -->
            <?php if($msg != ''): ?>
                <div class="alert <?php echo $msgClass; ?>">
                    <?php echo $msg; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?php echo isset($_POST['name']) ? $name : '' ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" id="email" value="<?php echo isset($_POST['email']) ? $email : '' ?>">
                </div>
                <div class="form-group">
                    <label for="msg">Message</label>
                    <textarea name="msg" class="form-control" id="msg"><?php echo isset($_POST['msg']) ? $message : '' ?></textarea>
                </div>
                <br>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                <!-- <button type="button" name="submit" class="btn btn-primary">Submit</button>
                    Button element does not work in php code (strange :( ))-->
            </form>
        </div>
    </body>
</html>
