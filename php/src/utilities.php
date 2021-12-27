<?php

    if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

    function ConnectToDatabase() {
        // Connection arguments
        $lHost        = "host = postgresdb";
        $lPort        = "port = 5432";
        $lDBName      = "dbname = DREAMHOME_DB";
        $lCredentials = "user=DREAMHOME_USER password=DREAMHOME_PASSWORD";

        // Create connection
        $lConnection = pg_connect( "$lHost $lPort $lDBName $lCredentials");
        // Check connection
        if(!$lConnection) {
            die("Connection failed: " . $lConnection->connect_error);
        }

        return $lConnection;
    }

    function GetData($pTable, $pCriteria)
    {
        $lConnection = ConnectToDatabase();

        $lQuery="SELECT*FROM $pTable" . $pCriteria;
        $lResult = pg_query($lConnection, $lQuery);
    
        $lData = pg_fetch_array($lResult, NULL, PGSQL_ASSOC);
        $lRows = pg_num_rows($lResult);
    
        if($lRows) {
            return $lData;
        } else {
            // Error
        }
        pg_free_result($lResult);
        pg_close($lConnection);
    }

    function GetAllData($pTable)
    {
        $lConnection = ConnectToDatabase();

        $lQuery="SELECT*FROM $pTable";
        $lResult = pg_query($lConnection, $lQuery);
    
        $lData = pg_fetch_array($lResult, NULL, PGSQL_ASSOC);
        $lRows = pg_num_rows($lResult);
        $lDataArray = array();
    
        if($lRows) {
            while($lData != null) {
                // Success
                array_push($lDataArray, $lData);
                $lData = pg_fetch_array($lResult, NULL, PGSQL_ASSOC);
            }
            return $lDataArray;
        } else {
            // Error
        }
        pg_free_result($lResult);
        pg_close($lConnection);
    }

    function EditClientData() 
    {
        unset($_POST['submitClientForm']);
        
        $lConnection = ConnectToDatabase();

        // Client identifier
        $clientID = $_SESSION['clientno'];
        // New Data
        $lNewData = array('telno' => $_POST['telno'], 'preftype' => $_POST['preftype'], 'maxrent' => $_POST['maxrent'], 'email' => $_POST['email'], 'password' => $_POST['password']);
        // Condition
        $lCondition = array('clientno' => $_SESSION['clientno']);
        // Update
        $lResult = pg_update($lConnection, 'client', $_POST, $lCondition);
        if ($lResult) {
            unset($_SESSION['clientno']);
            Redirect('VIEWS/CLIENT/All_QueryClient.php', false);
        } else {
            echo "User must have sent wrong inputs\n";
        }        
    }

    if(isset($_POST['submitClientForm'])) EditClientData();
    
?>