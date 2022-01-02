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

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    // SHOW INFO PAGE
    function ShowLeaseInfo() {
        $_SESSION['contractno'] = $_POST['contractno'];
        unset($_POST['showContractInfo_BRANCH']);
        unset($_POST['contractno']);
        Redirect('../VIEWS/LEASE/Branch_ShowLease.php', false);
    }
    
    if(isset($_POST['showContractInfo_BRANCH'])) ShowLeaseInfo();

    // SHOW EDIT PAGE
    function ShowEditingLeaseInfo() {
        $_SESSION['contractno'] = $_POST['contractno'];
        unset($_POST['editContractInfo_BRANCH']);
        unset($_POST['contractno']);
        Redirect('../VIEWS/LEASE/Branch_EditLease.php', false);
    }

    if(isset($_POST['editContractInfo_BRANCH'])) ShowEditingLeaseInfo();

    // SUBMIT EDITION
    function EditLeaseData() 
    {
        unset($_POST['submitLeaseEdition']);
        
        $lConnection = ConnectToDatabase();

        $lCondition = array('contractno' => $_POST['contractno']);

        unset($_POST['contractno']);
      
        $lResult = pg_update($lConnection, 'contract', $_POST, $lCondition);
        if ($lResult) {
            unset($_POST);
            unset($_SESSION['contractno']);
            Redirect('../VIEWS/LEASE/Branch_ListLeases.php', false);
        } else {
            echo "User must have sent wrong inputs\n";
        }     
    }

    if(isset($_POST['submitLeaseEdition'])) EditLeaseData();

    // SHOW ADD PAGE
    function ShowAddLease() {
        unset($_POST['addContract_BRANCH']);
        Redirect('../VIEWS/LEASE/Branch_AddLease.php', false);
    }

    if(isset($_POST['addContract_BRANCH'])) ShowAddLease();

    // SUBMIT ADDITION
    function InsertLeaseData() 
    {
        unset($_POST['submitAddLease_BRANCH']);

        $lConnection = ConnectToDatabase();

        $_POST['contractno'] = "LN" . $_POST['contractno'];

        $lResult = pg_insert($lConnection, 'contract', $_POST);
        if ($lResult) {
            unset($_POST);
            Redirect('../VIEWS/LEASE/Branch_ListLeases.php', false);
        } else {
            echo "User must have sent wrong inputs\n";
        } 
    }

    if(isset($_POST['submitAddLease_BRANCH'])) InsertLeaseData();

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    // SHOW BRANCH INFO
    if(isset($_POST['editBranchInfo_BRANCH'])) Redirect('../VIEWS/BRANCH/Branch_EditBranch.php', false);

    // SUBMIT EDITION
    function EditBranchData() 
    {
        unset($_POST['submitBranchEdition']);
        
        $lConnection = ConnectToDatabase();

        $lCondition = array('addressno' => $_SESSION['addressno']);

        unset($_POST['addressno']);
      
        $lResult = pg_update($lConnection, 'address', $_POST, $lCondition);
        if ($lResult) {
            unset($_POST);
            unset($_SESSION['addressno']);
            Redirect('../VIEWS/BRANCH/All_ListBranches.php', false);
        } else {
            echo "User must have sent wrong inputs\n";
        }     
    }

    if(isset($_POST['submitBranchEdition'])) EditBranchData();

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    // SHOW BRANCH STAFF PAGE
    if(isset($_POST['showBranchStaff_BRANCH'])) Redirect('../VIEWS/STAFF/Branch_ListStaff.php', false);

    // SHOW EDIT PAGE
    function ShowEditingStaffInfo() {
        $_SESSION['staffno'] = $_POST['staffno'];
        unset($_POST['editStaffInfo_BRANCH']);
        unset($_POST['staffno']);
        Redirect('../VIEWS/STAFF/Branch_EditStaff.php', false);
    }

    if(isset($_POST['editStaffInfo_BRANCH'])) ShowEditingStaffInfo();

    // SUBMIT EDITION
    function EditStaffData() 
    {
        unset($_POST['submitStaffEdition']);
        
        $lConnection = ConnectToDatabase();

        $lCondition = array('staffno' => $_SESSION['staffno']);

        unset($_POST['staffno']);
      
        $lResult = pg_update($lConnection, 'staff', $_POST, $lCondition);
        if ($lResult) {
            unset($_POST);
            unset($_SESSION['staffno']);
            Redirect('../VIEWS/STAFF/Branch_ListStaff.php', false);
        } else {
            echo "User must have sent wrong inputs\n";
        }     
    }

    if(isset($_POST['submitStaffEdition'])) EditStaffData();

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    // SHOW BRANCH PROPERTIES PAGE
    if(isset($_POST['showBranchProperties_BRANCH'])) Redirect('../VIEWS/PROPERTY/Branch_ListProperties.php', false);

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    // SHOW EDIT PAGE
    function ShowEditingOwnerInfo() {
        $_SESSION['ownerno'] = $_POST['ownerno'];
        unset($_POST['editOwnerInfo_ALL']);
        unset($_POST['ownerno']);
        Redirect('../VIEWS/OWNER/Branch_EditOwner.php', false);
    }

    if(isset($_POST['editOwnerInfo_ALL'])) ShowEditingOwnerInfo();

    // SHOW BRANCH PROPERTIES PAGE
    if(isset($_POST['showBranchOwners_BRANCH'])) Redirect('../VIEWS/OWNER/Branch_ListOwners.php', false);

    // SHOW ADD PAGE
    function ShowAddOwner() {
        unset($_POST['addOwner_BRANCH']);
        Redirect('../VIEWS/OWNER/Branch_AddOwner.php', false);
    }

    if(isset($_POST['addOwner_BRANCH'])) ShowAddOwner();

    // SUBMIT ADDITION
    function InsertOwnerData() 
    {
        unset($_POST['submitOwnerAddition']);

        $lConnection = ConnectToDatabase();

        $_POST['ownerno'] = "CO" . $_POST['ownerno'];

        $lResult = pg_insert($lConnection, 'owner', $_POST);
        if ($lResult) {
            unset($_POST);
            Redirect('../VIEWS/OWNER/Branch_ListOwners.php', false);
        } else {
            echo "User must have sent wrong inputs\n";
        } 
    }

    if(isset($_POST['submitOwnerAddition'])) InsertOwnerData();

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    // SHOW EDIT PAGE
    function ShowEditingClientInfo() {
        $_SESSION['clientno'] = $_POST['clientno'];
        unset($_POST['ediClientInfo_ALL']);
        unset($_POST['clientno']);
        Redirect('../VIEWS/CLIENT/Branch_EditClient.php', false);
    }

    if(isset($_POST['ediClientInfo_ALL'])) ShowEditingClientInfo();

    // SHOW BRANCH PROPERTIES PAGE
    if(isset($_POST['showBranchClients_BRANCH'])) Redirect('../VIEWS/CLIENT/Branch_ListClients.php', false);

    // SHOW ADD PAGE
    function ShowAddClient() {
        unset($_POST['addClient_BRANCH']);
        Redirect('../VIEWS/CLIENT/Branch_AddClient.php', false);
    }

    if(isset($_POST['addClient_BRANCH'])) ShowAddClient();

    // SUBMIT EDITION
    function EditClientData_Branch() 
    {
        unset($_POST['submitClientEdition_BRANCH']);
        
        $lConnection = ConnectToDatabase();

        $lCondition = array('clientno' => $_SESSION['clientno']);

        unset($_POST['clientno']);
        $lResult = pg_update($lConnection, 'client', $_POST, $lCondition);
        if ($lResult) {
            unset($_POST);
            unset($_SESSION['clientno']);
            Redirect('../VIEWS/CLIENT/Branch_ListClients.php', false);
        } else {
            echo "User must have sent wrong inputs\n";
        }     
    }

    if(isset($_POST['submitClientEdition_BRANCH'])) EditClientData_Branch();

    // SUBMIT ADDITION
    function InsertClientData() 
    {
        unset($_POST['submitClientAddition']);

        $lConnection = ConnectToDatabase();

        $_POST['clientno'] = "CR" . $_POST['clientno'];

        $lResult = pg_insert($lConnection, 'client', $_POST);
        if ($lResult) {
            unset($_POST);
            Redirect('../VIEWS/CLIENT/Branch_ListClients.php', false);
        } else {
            echo "User must have sent wrong inputs\n";
        } 
    }

    if(isset($_POST['submitClientAddition'])) InsertClientData();

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    // SHOW BRANCH LEASES PAGE
    if(isset($_POST['showBranchLeases_ALL'])) Redirect('../VIEWS/LEASE/Branch_ListLeases.php', false);

?>