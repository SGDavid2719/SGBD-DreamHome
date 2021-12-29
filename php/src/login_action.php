<?php

    // Manager      :   susan.b@dreamhome.com   |   DH-sb!2021
    // Supervisor   :   david.f@dreamhome.com   |   DH-df!2021
    // Assistant    :   ann.b@dreamhome.com     |   DH-ab!2021
    // Client       :   astewart@hotmail.com    |   456

    if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include_once('utilities.php');

    if(isset($_POST['login']))
    {
        $user_address=$_POST['eaddress'];
        $user_password=$_POST['password'];
    
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
    
        if($rows) {
            $_SESSION['fname'] = $data['fname'];
            $_SESSION['lname'] = $data['lname'];
            $_SESSION['role'] = ($lTable == 'staff') ? $data['position'] : 'Client';
            if($lTable == 'staff') $_SESSION['branchno'] = $data['branchno'];
            if($lTable == 'staff') $_SESSION['staffno'] = $data['staffno'];
            Redirect('VIEWS/INDEX/Index.php', false);
        } else {
            ?>
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <strong>Your email address or password are incorrect!</strong> Try it again.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            include_once('VIEWS/login.php');
        }
        pg_free_result($result);
        pg_close($connection);
    }
?>