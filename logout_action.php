<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamHome Logout</title>
</head>
<body>
    <div>
    <?php
        include_once('login_action.php');
        session_destroy();
        Redirect("login.php",false);
    ?>
    </div>
</body>
</html>