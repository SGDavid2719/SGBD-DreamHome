<?php

    // Manager      :   susan.b@dreamhome.com   |   DH-sb!2022
    // Supervisor   :   david.f@dreamhome.com   |   DH-df!2022
    // Assistant    :   ann.b@dreamhome.com     |   DH-ab!2022
    // Client       :   astewart@hotmail.com    |   456

    if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include_once('../PHP/Utilities.php');

    if(isset($_POST['login']))
    {
        $user_address=$_POST['eaddress'];
        $user_password=base64_encode($_POST['password']);
    
        // Connection arguments
        $host        = "host = postgresdb";
        $port        = "port = 5432";
        $dbname      = "dbname = DREAMHOME_DB";
        $credentials = "user=DREAMHOME_USER password=DREAMHOME_PASSWORD";

        // Create connection
        $connection = pg_connect("$host $port $dbname $credentials");
        // Check connection
        if(!$connection) {
            die("Connection failed: " . $connection->connect_error);
        }

        $lTable = str_contains($user_address, '@dreamhome.com') ? 'staff' : 'client';
    
        $query="SELECT*FROM $lTable where email='$user_address' and password='$user_password'";
        $result = pg_query($connection, $query);
    
        $data = pg_fetch_array($result);
        $rows = pg_num_rows($result);

        pg_free_result($result);
        pg_close($connection);
    
        if($rows) {
            $_SESSION['fname'] = $data['fname'];
            $_SESSION['lname'] = $data['lname'];
            $_SESSION['role'] = ($lTable == 'staff') ? $data['position'] : 'Client';
            $_SESSION['roleno'] = ($lTable == 'staff') ? $data['staffno'] : $data['clientno'];
            if($lTable == 'staff') $_SESSION['branchno'] = $data['branchno'];
            Redirect('../VIEWS/INDEX/Index.php', false);
        } else {
            ?>
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <strong>Your email address or password are incorrect!</strong> Try it again.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            unset($_POST);
            include_once('../VIEWS/Login.php');
        }
    }
?>