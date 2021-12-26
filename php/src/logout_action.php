<?php
    include_once('login_action.php');
    session_destroy();
    Redirect("VIEWS/login.php",false);
?>