<?php
    include_once('Login_Action.php');
    session_destroy();
    Redirect("../VIEWS/Login.php",false);
?>