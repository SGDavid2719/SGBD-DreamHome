<?php

    if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

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

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    function GetData($pColumns, $pTable, $pCriteria)
    {
        $lConnection = ConnectToDatabase();

        $lQuery="SELECT " . $pColumns . " FROM $pTable " . $pCriteria;
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

    function GetAllData($pColumns, $pTable, $pCriteria)
    {
        $lConnection = ConnectToDatabase();

        $lQuery="SELECT " . $pColumns . " FROM $pTable " . $pCriteria;
        $lResult = pg_query($lConnection, $lQuery);

        if($lResult) {
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
        }
        pg_close($lConnection);
        return null;
    }

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    function EditClientData() 
    {
        unset($_POST['submitClientEdition']);
        
        $lConnection = ConnectToDatabase();

        $lNewData = array('telno' => $_POST['telno'], 'preftype' => $_POST['preftype'], 'maxrent' => $_POST['maxrent'], 'email' => $_POST['email'], 'password' => $_POST['password']);

        $lCondition = array('clientno' => $_SESSION['roleno']);

        $lResult = pg_update($lConnection, 'client', $_POST, $lCondition);
        if ($lResult) {
            unset($_POST);
            Redirect('../VIEWS/CLIENT/All_DetailClient.php', false);
        } else {
            echo "User must have sent wrong inputs\n";
        }        
    }

    if(isset($_POST['submitClientEdition'])) EditClientData();

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    function ShowPropertyInfo() 
    {
        $_SESSION['propertyno'] = $_POST['propertyno'];
        unset($_POST['propertyno']);
        Redirect('../VIEWS/PROPERTY/All_ShowProperty.php', false);
    }

    if(isset($_POST['showPropertyInfo'])) ShowPropertyInfo();

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    function EditViewingData() 
    {
        unset($_POST['submitViewingForm']);
        
        $lConnection = ConnectToDatabase();

        // Viewing record identifier
        $lPropertyNumber = $_POST['propertyno'];
        $lClientNumber = $_POST['clientno'];
        $lViewdate = $_POST['viewdate'];
        $lComment = $_POST['comment'];

        // New Data
        $lNewData = array('viewdate' => $_POST['viewdate'], 'comment' => $_POST['comment']);
        // Condition
        $lCondition = array('propertyno' => $_SESSION['propertyno'], 'clientno' => $_SESSION['clientno'], 'viewdate' => $_SESSION['viewdate'], 'comment' => $_SESSION['comment']);

        // Update
        
        $lResult = pg_update($lConnection, 'viewing', $_POST, $lCondition);
        if ($lResult) {
            unset($_POST);
            unset($_SESSION['clientno']);
            unset($_SESSION['propertyno']);
            unset($_SESSION['viewdate']);
            unset($_SESSION['comment']);
            Redirect('../VIEWS/VIEWING/Branch_ReportViewing.php', false);
        } else {
            echo "User must have sent wrong inputs\n";
        }     
    }

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    function InsertPropertyData() 
    {
        unset($_POST['submitAddProperty']);

        $lConnection = ConnectToDatabase();

        $lResult = pg_insert($lConnection, 'propertyforrent', $_POST);
        if ($lResult) {
            unset($_POST);
            Redirect('../VIEWS/PROPERTY/Branch_ListProperties.php', false);
        } else {
            echo "User must have sent wrong inputs\n";
        }  
    }

    /* ------------------------EDIT RECORD--------------------------- */
    
    if(isset($_POST['submitViewingForm'])) EditViewingData();

    /* -------------------------ADD RECORD------------------------------------ */
    if(isset($_POST['submitAddProperty'])) InsertPropertyData();

    /* -------------------------VIEW DETAILS------------------------------------ */
    
    if(isset($_POST['branchQueryPropertyForm'])) {
        $_SESSION['propertyno'] = $_POST['propertyno'];
        unset($_POST['propertyno']);
        Redirect('../VIEWS/PROPERTY/Branch_QueryProperty.php', false);
    }
    if(isset($_POST['branchQueryPropertyViewingForm'])) {
        $_SESSION['propertyno'] = $_POST['propertyno'];
        $_SESSION['clientno'] = $_POST['clientno'];
        $_SESSION['viewdate'] = $_POST['viewdate'];
        $_SESSION['comment'] = $_POST['comment'];
        unset($_POST['propertyno']);
        unset($_POST['clientno']);
        unset($_POST['viewdate']);
        unset($_POST['comment']);
        Redirect('../VIEWS/VIEWING/Branch_QueryViewing.php', false);
    }

    if(isset($_POST['branchAddProperty'])) {
        Redirect('../VIEWS/PROPERTY/Branch_AddProperty.php', false);
    }
    
?>