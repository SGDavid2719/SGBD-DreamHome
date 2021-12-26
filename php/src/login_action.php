<?php

    session_start();

    include_once('utilities.php');

    if(isset($_POST['login']))
    {
        $user_address=$_POST['eaddress'];
        $user_password=$_POST['password'];
    
        // Connection arguments
        $host        = "host = postgresdb";
        $port        = "port = 5432";
        $dbname      = "dbname = POSTGRES_DB";
        $credentials = "user = POSTGRES_USER password=POSTGRES_PASSWORD";

        // Create connection
        $connection = pg_connect( "$host $port $dbname $credentials");
        // Check connection
        if(!$connection) {
            die("Connection failed: " . $connection->connect_error);
        }
    
        $query="SELECT*FROM credentials where email='$user_address' and password='$user_password'";
        $result = pg_query($connection, $query);
    
        $data = pg_fetch_row($result);
        $rows = pg_num_rows($result);
    
        if($rows) {
            $username=$data[1];
            $_SESSION['username']=$username;
            Redirect('VIEWS/index.php', false);
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