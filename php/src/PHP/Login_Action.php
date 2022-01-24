<?php

    if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include_once('../PHP/Utilities.php');

    if(isset($_POST['login']))
    {
        $lUserAddress=$_POST['eaddress'];
        $lUserPassword=base64_encode($_POST['password']);
    
        // Connection arguments
        $lHost        = "host = postgresdb";
        $lPort        = "port = 5432";
        $lDBName      = "dbname = DREAMHOME_DB";
        $lCredentials = "user=DREAMHOME_USER password=DREAMHOME_PASSWORD";

        // Create connection
        $lConnection = pg_connect("$lHost $lPort $lDBName $lCredentials");
        // Check connection
        if(!$lConnection) {
            die("Connection failed: " . $lConnection->connect_error);
        }

        if(str_contains($lUserAddress, 'SELECT') || str_contains($lUserAddress, 'UNION') || str_contains($lUserAddress, ' OR ') || str_contains($lUserAddress, 'AND') || str_contains($lUserAddress, 'WHERE') || str_contains($lUserAddress, ' or ') || str_contains($lUserAddress, 'and') || str_contains($lUserAddress, 'DROP') || str_contains($lUserPassword, 'SELECT') || str_contains($lUserPassword, 'UNION') || str_contains($lUserPassword, ' OR ') || str_contains($lUserPassword, 'AND') || str_contains($lUserPassword, 'WHERE') || str_contains($lUserPassword, ' or ') || str_contains($lUserPassword, 'and') || str_contains($lUserPassword, 'DROP'))
        {
            $lNewData = array('type' => "CRITICAL ERROR", 'description' => "SQL Injection while trying to login", 'eventdata' => '', 'securityclass' => 4);
            $lSaveLog = pg_insert($lConnection, 'securitylog', $lNewData);
            ?>
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <strong>Do not insert code you do not understand!</strong> Try it again.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            unset($_POST);
            include_once('../VIEWS/Login.php');
        } 
        else 
        {
            $lTable = str_contains($lUserAddress, '@dreamhome.com') ? 'staff' : 'client';
    
            $query="SELECT*FROM $lTable where email='$lUserAddress' and password='$lUserPassword'";
            $result = pg_query($lConnection, $query);
        
            $data = pg_fetch_array($result);
            $rows = pg_num_rows($result);
        
            if($rows) {
                $_SESSION['fname'] = $data['fname'];
                $_SESSION['lname'] = $data['lname'];
                $_SESSION['role'] = ($lTable == 'staff') ? $data['position'] : 'Client';
                $_SESSION['roleno'] = ($lTable == 'staff') ? $data['staffno'] : $data['clientno'];
                $_SESSION['rolesecurityclass'] = ($lTable == 'staff') ? $data['staffsecurityclass'] : $data['clientsecurityclass'];
                if($lTable == 'staff') $_SESSION['branchno'] = $data['branchno'];
                // End connection
                pg_free_result($result);
                pg_close($lConnection);
                // Redirection
                Redirect('../VIEWS/INDEX/Index.php', false);
            } else {
                $lSessionData = "Email Address : " . $lUserAddress . ", Password : " . $lUserPassword;
                $lNewData = array('type' => "WARNING", 'description' => "Wrong access", 'eventdata' => $lSessionData, 'securityclass' => 4);
                $lSaveLog = pg_insert($lConnection, 'securitylog', $lNewData);
                ?>
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <strong>Your email address or password are incorrect!</strong> Try it again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                unset($_POST);
                // End connection
                pg_free_result($result);
                pg_close($lConnection);
                include_once('../VIEWS/Login.php');
            }
        }
    }
?>