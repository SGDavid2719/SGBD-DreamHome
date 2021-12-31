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

    if(isset($_POST['showPropertyInfo_ALL'])) ShowPropertyInfo();

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    function ShowPropertyInfo2() 
    {
        $_SESSION['propertyno'] = $_POST['propertyno'];
        unset($_POST['propertyno']);
        Redirect('../VIEWS/PROPERTY/Branch_ShowProperty.php', false);
    }

    if(isset($_POST['showPropertyInfo_BRANCH'])) ShowPropertyInfo2();

    
    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    function InsertPropertyData() 
    {
        unset($_POST['submitAddProperty_BRANCH']);

        $lConnection = ConnectToDatabase();

        $lResult = pg_insert($lConnection, 'propertyforrent', $_POST);
        if ($lResult) {
            unset($_POST);
            Redirect('../VIEWS/PROPERTY/Branch_ListProperties.php', false);
        } else {
            echo "User must have sent wrong inputs\n";
        }  
    }

    if(isset($_POST['submitAddProperty_BRANCH'])) InsertPropertyData();

    if(isset($_POST['addProperty_BRANCH'])) Redirect('../VIEWS/PROPERTY/Branch_AddProperty.php', false);

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    function ShowViewingInfo() {
        $_SESSION['viewingno'] = $_POST['viewingno'];
        unset($_POST['viewingno']);
        Redirect('../VIEWS/VIEWING/Branch_ShowViewing.php', false);
    }
    
    if(isset($_POST['showViewingInfo_BRANCH'])) ShowViewingInfo();

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    function EditViewingData() 
    {
        unset($_POST['submitViewingForm']);
        
        $lConnection = ConnectToDatabase();

        $lCondition = array('viewingno' => $_SESSION['viewingno']);
      
        $lResult = pg_update($lConnection, 'viewing', $_POST, $lCondition);
        if ($lResult) {
            unset($_POST);
            unset($_SESSION['viewingno']);
            Redirect('../VIEWS/VIEWING/Branch_ListViewings.php', false);
        } else {
            echo "User must have sent wrong inputs\n";
        }     
    }

    if(isset($_POST['submitViewingEdition'])) EditViewingData();

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    function ShowStaffInfo() {
        $_SESSION['staffno'] = $_POST['staffno'];
        unset($_POST['staffno']);
        Redirect('../VIEWS/STAFF/Branch_ShowStaff.php', false);
    }
    
    if(isset($_POST['showStaffInfo_BRANCH'])) ShowStaffInfo();

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    function InsertStaffData() 
    {
        unset($_POST['submitAddStaff_BRANCH']);

        $lConnection = ConnectToDatabase();

        $lFNameLetter = substr($_POST['fname'], 0, 1);
        $lLNameLetter = substr($_POST['lname'], 0, 1);
        $lCurrentYear = date("Y");

        $_POST['password'] = "DH-" . strtolower($lFNameLetter[0]) . strtolower($lLNameLetter[0]) . "!" . "$lCurrentYear";

        $lResult = pg_insert($lConnection, 'staff', $_POST);
        if ($lResult) {
            unset($_POST);
            Redirect('../VIEWS/PROPERTY/Branch_ListProperties.php', false);
        } else {
            echo "User must have sent wrong inputs\n";
        }  
    }

    if(isset($_POST['submitAddStaff_BRANCH'])) InsertStaffData();

    if(isset($_POST['addStaff_BRANCH'])) Redirect('../VIEWS/STAFF/Branch_AddStaff.php', false);

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    function EditOwnerData() 
    {
        unset($_POST['submitOwnerEdition']);
        
        $lConnection = ConnectToDatabase();

        $lCondition = array('ownerno' => $_POST['ownerno']);

        unset($_POST['ownerno']);
      
        $lResult = pg_update($lConnection, 'owner', $_POST, $lCondition);
        if ($lResult) {
            unset($_POST);
            unset($_SESSION['ownerno']);
            Redirect('../VIEWS/OWNER/Branch_ListOwners.php', false);
        } else {
            echo "User must have sent wrong inputs\n";
        }     
    }

    if(isset($_POST['submitOwnerEdition'])) EditOwnerData();

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    function InsertViewingData() 
    {
        unset($_POST['submitAddViewing_BRANCH']);

        $lConnection = ConnectToDatabase();

        $_POST['viewingno'] = "V" . $_POST['viewingno'];

        $lResult = pg_insert($lConnection, 'viewing', $_POST);
        if ($lResult) {
            unset($_POST);
            Redirect('../VIEWS/VIEWING/Branch_ListViewing.php', false);
        } else {
            echo "User must have sent wrong inputs\n";
        } 
    }

    if(isset($_POST['submitAddViewing_BRANCH'])) InsertViewingData();

    if(isset($_POST['addView_BRANCH'])) Redirect('../VIEWS/VIEWING/Branch_AddViewing.php', false);



?>