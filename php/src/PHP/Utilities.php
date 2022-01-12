<?php

    if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    Require_once("DreamHome_API.php");

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    /* CLIENT SECTION */

    // SUBMIT EDITION --> CLIENT
    if(isset($_POST['submitClientEdition'])) 
    {
        unset($_POST['submitClientEdition']);

        $lNewData = $_POST;
        $lCondition = ($_SESSION['role'] == 'Client') ? array('clientno' => $_SESSION['roleno']) : array('clientno' => $_SESSION['clientno']);
        $lResult = EditData('client', $lNewData, $lCondition, $_SESSION['roleno']);

        unset($_POST);

        if ($lResult == false) 
        {
            $lClientNo = ($_SESSION['role'] == 'Client') ? $_SESSION['roleno'] : $_SESSION['clientno'];
            $lDescription = 'Error editing client: ' . $lClientNo;
            InsertWarning('client', 'ERROR', 'EDIT', $lDescription, $_SESSION['roleno']);
        }

        if ($_SESSION['role'] == 'Client') 
        {
            unset($_SESSION['clientno']);
            Redirect('../VIEWS/CLIENT/All_DetailClient.php', false); 
        }  
        else Redirect('../VIEWS/CLIENT/All_ListClients.php', false); 
    }

    // SUBMIT PASSWORD EDITION --> CLIENT
    if(isset($_POST['submitClientPasswordEdition'])) 
    {
        unset($_POST['submitClientPasswordEdition']);

        $lPreviousPassword = $_POST['password'];

        $lClientNumber = $_SESSION['roleno'];
        $lClientPreviousPassword = GetData('client.password', 'client', "WHERE client.clientno='$lClientNumber'");

        if (base64_decode($lClientPreviousPassword['password']) == $_POST['password'] && $_POST['newPassword1'] == $_POST['newPassword2']) 
        {
            $lNewData = array('password' => base64_encode($_POST['newPassword1']));
            $lCondition = array('clientno' => $_SESSION['roleno']);
            $lResult = EditData('client', $lNewData, $lCondition, $_SESSION['roleno']);

            if ($lResult == false) 
            {
                $lDescription = 'Error editing client password: ' . $_SESSION['roleno'];
                InsertWarning('client', 'ERROR', 'EDIT', $lDescription, $_SESSION['roleno']);
            }
        }
        unset($_POST);
        Redirect('../VIEWS/CLIENT/All_DetailClient.php', false); 
    }
    
    // SHOW EDIT PAGE --> CLIENT
    if(isset($_POST['editClientInfo_ALL'])) 
    {
        $_SESSION['clientno'] = $_POST['clientno'];
        unset($_POST['editClientInfo_ALL']);
        unset($_POST['clientno']);
        Redirect('../VIEWS/CLIENT/All_EditClient.php', false);
    }

    // SHOW ADD PAGE --> CLIENT
    if(isset($_POST['addClient'])) 
    {
        unset($_POST['addClient']);
        Redirect('../VIEWS/CLIENT/All_AddClient.php', false);
    }

    // SUBMIT ADDITION --> CLIENT
    if(isset($_POST['submitClientAddition'])) 
    {
        unset($_POST['submitClientAddition']);

        $_POST['clientno'] = "CR" . $_POST['clientno'];
        $lFNameLetter = substr($_POST['fname'], 0, 1);
        $lLNameLetter = substr($_POST['lname'], 0, 1);
        $lCurrentYear = date("Y");
        $lPassword = "DH-" . strtolower($lFNameLetter[0]) . strtolower($lLNameLetter[0]) . "!" . "$lCurrentYear";
        $_POST['password'] = base64_encode($lPassword);
        $lNewData = $_POST;
        $lResult = InsertData('client', $lNewData, $_SESSION['roleno']);

        if ($lResult == false)
        {
            $lDescription = 'Error inserting client';
            InsertWarning('client', 'ERROR', 'INSERT', $lDescription, $_SESSION['roleno']);
        }
        
        unset($_POST);
        Redirect('../VIEWS/CLIENT/All_ListClients.php', false);
    }

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    /* PROPERTY SECTION */

    // SHOW INFO PAGE --> PROPERTY
    if(isset($_POST['showPropertyInfo_BRANCH']) || isset($_POST['showPropertyInfo_ALL'])) {
        $_SESSION['propertyno'] = $_POST['propertyno'];
        $_SESSION['all_or_branch'] = (isset($_POST['showPropertyInfo_BRANCH'])) ? 'showPropertyInfo_BRANCH' : 'showPropertyInfo_ALL';
        unset($_POST['propertyno']);
        Redirect('../VIEWS/PROPERTY/Branch_ShowProperty.php', false);
    }
    
    // SUBMIT ADDITION --> PROPERTY
    if(isset($_POST['submitAddProperty_BRANCH']))
    {
        unset($_POST['submitAddProperty_BRANCH']);

        $lResult = InsertData('propertyforrent', $_POST, $_SESSION['roleno']);

        if ($lResult == false) 
        {
            $lDescription = 'Error inserting property for rent';
            InsertWarning('propertyforrent', 'ERROR', 'INSERT', $lDescription, $_SESSION['roleno']);
        }

        unset($_POST);
        Redirect('../VIEWS/PROPERTY/Branch_ListProperties.php', false); 
    }

    // PENDING ADDRESS EDITION
    // SUBMIT EDITION --> PROPERTY
    if(isset($_POST['submitPropertyEdition'])) 
    {
        unset($_POST['submitPropertyEdition']);

        $lNewData = $_POST;
        $lCondition = array('propertyno' => $_POST['propertyno']);
        $lResult = EditData('propertyforrent', $lNewData, $lCondition, $_SESSION['roleno']);

        if ($lResult == false)
        {
            $lDescription = 'Error editing property for rent: ' . $_POST['propertyno'];
            InsertWarning('propertyforrent', 'ERROR', 'EDIT', $lDescription, $_SESSION['roleno']);
        }

        unset($_POST);

        if ($_SESSION['role'] != 'Manager') 
        {
            Redirect('../VIEWS/PROPERTY/Branch_ListProperties.php', false); 
        }  
        else Redirect('../VIEWS/PROPERTY/All_ListProperties.php', false); 
    }

    // PENDING PROPERTY ADDITION (ADDRESS ISSUE)

    // SHOW ADDITION PAGE --> PROPERTY
    if(isset($_POST['addProperty_BRANCH'])) Redirect('../VIEWS/PROPERTY/Branch_AddProperty.php', false);

    // SHOW BRANCH LIST PAGE --> PROPERTY
    if(isset($_POST['showBranchProperties_BRANCH'])) Redirect('../VIEWS/PROPERTY/Branch_ListProperties.php', false);

    // SHOW EDIT PAGE --> PROPERTY
    if(isset($_POST['editPropertyInfo_ALL']) || isset($_POST['editPropertyInfo_BRANCH'])) 
    {
        $_SESSION['propertyno'] = $_POST['propertyno'];
        $_SESSION['all_or_branch'] = (isset($_POST['editPropertyInfo_ALL'])) ? 'editPropertyInfo_ALL' : 'editPropertyInfo_BRANCH';
        unset($_POST['propertyno']);
        Redirect('../VIEWS/PROPERTY/Branch_EditProperty.php', false);
    }

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    /* OWNER SECTION */

    if(isset($_POST['submitOwnerEdition'])) 
    {
        unset($_POST['submitOwnerEdition']);

        $lCondition = array('ownerno' => $_POST['ownerno']);
        unset($_POST['ownerno']);
        $lNewData = $_POST;
      
        $lResult = EditData('owner', $lNewData, $lCondition, $_SESSION['roleno']);

        if ($lResult == false) 
        {
            $lDescription = 'Error editing owner: ' . $_SESSION['ownerno'];
            InsertWarning('owner', 'ERROR', 'EDIT', $lDescription, $_SESSION['roleno']);
        }
        
        unset($_POST);
        unset($_SESSION['ownerno']);
        Redirect('../VIEWS/OWNER/Branch_ListOwners.php', false);
    }

    // SHOW EDIT PAGE --> OWNER
    if(isset($_POST['editOwnerInfo_ALL'])) 
    {
        $_SESSION['ownerno'] = $_POST['ownerno'];
        unset($_POST['editOwnerInfo_ALL']);
        unset($_POST['ownerno']);
        Redirect('../VIEWS/OWNER/Branch_EditOwner.php', false);
    }

    // SHOW BRANCH PAGE --> OWNER
    if(isset($_POST['showBranchOwners_BRANCH'])) Redirect('../VIEWS/OWNER/Branch_ListOwners.php', false);

    // SHOW ADD PAGE --> OWNER
    if(isset($_POST['addOwner_BRANCH'])) 
    {
        unset($_POST['addOwner_BRANCH']);
        Redirect('../VIEWS/OWNER/Branch_AddOwner.php', false);
    }

    // SUBMIT ADDITION
    if(isset($_POST['submitOwnerAddition'])) 
    {
        unset($_POST['submitOwnerAddition']);

        $_POST['ownerno'] = "CO" . $_POST['ownerno'];
        $lNewData = $_POST;
        $lResult = InsertData('owner', $lNewData, $_SESSION['roleno']);

        if ($lResult == false) 
        {
            $lDescription = 'Error inserting owner';
            InsertWarning('owner', 'ERROR', 'INSERT', $lDescription, $_SESSION['roleno']);
        }

        unset($_POST);
        Redirect('../VIEWS/OWNER/Branch_ListOwners.php', false);
    }

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
    
    /* VIEWING SECTION */

    // SHOW INFO PAGE --> VIEWING
    if(isset($_POST['showViewingInfo_BRANCH']))
    {
        $_SESSION['viewingno'] = $_POST['viewingno'];
        unset($_POST['viewingno']);
        Redirect('../VIEWS/VIEWING/Branch_ShowViewing.php', false);
    }

    // SHOW EDIT PAGE --> VIEWING
    if(isset($_POST['editViewingInfo_BRANCH'])) 
    {
        $_SESSION['viewingno'] = $_POST['viewingno'];
        unset($_POST['editViewingInfo_BRANCH']);
        unset($_POST['viewingno']);
        Redirect('../VIEWS/VIEWING/Branch_EditViewing.php', false);
    }

    if(isset($_POST['submitViewingEdition'])) 
    {
        unset($_POST['submitViewingEdition']);

        $lNewData = $_POST;
        $lCondition = array('viewingno' => $_SESSION['viewingno']);
        $lResult = EditData('viewing', $lNewData, $lCondition, $_SESSION['roleno']);

        if ($lResult == false) 
        {
            $lDescription = 'Error editing viewing: ' . $_SESSION['viewingno'];
            InsertWarning('viewing', 'ERROR', 'EDIT', $lDescription, $_SESSION['roleno']);
        }
        
        unset($_POST);
        unset($_SESSION['viewingno']);
        Redirect('../VIEWS/VIEWING/Branch_ListViewings.php', false);
    }

    if(isset($_POST['submitAddViewing_BRANCH']))
    {
        unset($_POST['submitAddViewing_BRANCH']);

        $_POST['viewingno'] = "V" . $_POST['viewingno'];
        $lNewData = $_POST;

        $lResult = InsertData('viewing', $lNewData, $_SESSION['roleno']);    

        if ($lResult == false) 
        {
            $lDescription = 'Error inserting viewing';
            InsertWarning('viewing', 'ERROR', 'INSERT', $lDescription, $_SESSION['roleno']);
        }

        unset($_POST);
        Redirect('../VIEWS/VIEWING/Branch_ListViewings.php', false);
    }

    if(isset($_POST['addView_BRANCH'])) Redirect('../VIEWS/VIEWING/Branch_AddViewing.php', false);

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    /* CONTRACT/LEASE SECTION */

    // SHOW INFO PAGE --> CONTRACT/LEASE
    if(isset($_POST['showContractInfo_BRANCH'])) 
    {
        $_SESSION['contractno'] = $_POST['contractno'];
        unset($_POST['showContractInfo_BRANCH']);
        unset($_POST['contractno']);
        Redirect('../VIEWS/LEASE/Branch_ShowLease.php', false);
    }

    // SHOW EDIT PAGE --> CONTRACT/LEASE

    if(isset($_POST['editContractInfo_BRANCH']))
    {
        $_SESSION['contractno'] = $_POST['contractno'];
        unset($_POST['editContractInfo_BRANCH']);
        unset($_POST['contractno']);
        Redirect('../VIEWS/LEASE/Branch_EditLease.php', false);
    }

    // SUBMIT EDITION --> CONTRACT/LEASE

    if(isset($_POST['submitLeaseEdition']))
    {
        unset($_POST['submitLeaseEdition']);

        $lCondition = array('contractno' => $_POST['contractno']);
        unset($_POST['contractno']);
        $lNewData = $_POST;
    
        $lResult = EditData('contract', $lNewData, $lCondition, $_SESSION['roleno']);

        if ($lResult == false) 
        {
            $lDescription = 'Error editing contract: ' . $_POST['contractno'];
            InsertWarning('contract', 'ERROR', 'EDIT', $lDescription, $_SESSION['roleno']);
        }

        unset($_POST);
        unset($_SESSION['contractno']);
        Redirect('../VIEWS/LEASE/Branch_ListLeases.php', false);
    }

    // SHOW ADD PAGE --> CONTRACT/LEASE
    if(isset($_POST['addContract_BRANCH'])) 
    {
        unset($_POST['addContract_BRANCH']);
        Redirect('../VIEWS/LEASE/Branch_AddLease.php', false);
    }

    // SUBMIT ADDITION --> CONTRACT/LEASE
    if(isset($_POST['submitAddLease_BRANCH'])) 
    {
        unset($_POST['submitAddLease_BRANCH']);

        $_POST['contractno'] = "LN" . $_POST['contractno'];
        $lNewData = $_POST;

        $lResult = InsertData('contract', $lNewData, $_SESSION['roleno']);

        if ($lResult == false)
        {
            $lDescription = 'Error inserting contract';
            InsertWarning('contract', 'ERROR', 'INSERT', $lDescription, $_SESSION['roleno']);
        }

        unset($_POST);
        Redirect('../VIEWS/LEASE/Branch_ListLeases.php', false);
    }

    // SHOW BRANCH LEASES PAGE
    if(isset($_POST['showBranchLeases_ALL'])) Redirect('../VIEWS/LEASE/Branch_ListLeases.php', false);

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
    
    if(isset($_POST['showStaffInfo_BRANCH'])) 
    {
        $_SESSION['staffno'] = $_POST['staffno'];
        unset($_POST['staffno']);
        Redirect('../VIEWS/STAFF/Branch_ShowStaff.php', false);
    }

    if(isset($_POST['submitAddStaff_BRANCH']))
    {
        unset($_POST['submitAddStaff_BRANCH']);

        $lFNameLetter = substr($_POST['fname'], 0, 1);
        $lLNameLetter = substr($_POST['lname'], 0, 1);
        $lCurrentYear = date("Y");
        $lPassword = "DH-" . strtolower($lFNameLetter[0]) . strtolower($lLNameLetter[0]) . "!" . "$lCurrentYear";
        $_POST['password'] = base64_encode($lPassword);

        $lResult = InsertData('staff', $_POST, $_SESSION['roleno']);

        if ($lResult == false) 
        {
            $lDescription = 'Error inserting staff';
            InsertWarning('staff', 'ERROR', 'INSERT', $lDescription, $_SESSION['roleno']);
        }        

        unset($_POST);
        Redirect('../VIEWS/STAFF/Branch_ListStaff.php', false);
    }

    if(isset($_POST['addStaff_BRANCH'])) Redirect('../VIEWS/STAFF/Branch_AddStaff.php', false);

    // SHOW BRANCH STAFF PAGE
    if(isset($_POST['showBranchStaff_BRANCH'])) Redirect('../VIEWS/STAFF/Branch_ListStaff.php', false);

    if(isset($_POST['editStaffInfo_BRANCH'])) 
    {
        $_SESSION['staffno'] = $_POST['staffno'];
        unset($_POST['editStaffInfo_BRANCH']);
        unset($_POST['staffno']);
        Redirect('../VIEWS/STAFF/Branch_EditStaff.php', false);
    }

    // SUBMIT EDITION
    if(isset($_POST['submitStaffEdition'])) 
    {
        unset($_POST['submitStaffEdition']);

        $lCondition = array('staffno' => $_SESSION['staffno']);
        unset($_POST['staffno']);
        $lNewData = $_POST;
        $lResult = EditData('staff', $lNewData, $lCondition, $_SESSION['roleno']);

        if ($lResult == false) 
        {
            $lDescription = 'Error editing staff: ' . $_SESSION['staffno'];
            InsertWarning('staff', 'ERROR', 'EDIT', $lDescription, $_SESSION['roleno']);
        }

        unset($_POST);
        unset($_SESSION['staffno']);
        Redirect('../VIEWS/STAFF/Branch_ListStaff.php', false);
    }

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    // SHOW INFO PAGE --> BRANCH
    if(isset($_POST['editBranchInfo_BRANCH'])) Redirect('../VIEWS/BRANCH/Branch_EditBranch.php', false);

    // SUBMIT EDITION
    if(isset($_POST['submitBranchEdition']))
    {
        unset($_POST['submitBranchEdition']);

        $lCondition = array('addressno' => $_SESSION['addressno']);
        unset($_POST['addressno']);
        $lNewData = $_POST;
      
        $lResult = EditData('address', $lNewData, $lCondition, $_SESSION['roleno']);

        unset($_POST);
        unset($_SESSION['addressno']);

        if ($lResult == false) 
        {
            $lDescription = 'Error editing branch: ' . $_SESSION['addressno'];
            InsertWarning('branch', 'ERROR', 'EDIT', $lDescription, $_SESSION['roleno']);
        }        

        Redirect('../VIEWS/BRANCH/All_ListBranches.php', false);
    }

    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    // SHOW EDIT PAGE --> VIEWING

    if(isset($_POST['editNewspaperInfo']))
    {
        $_SESSION['newspaperno'] = $_POST['newspaperno'];
        //print_r($_POST['newspaperno']);
        unset($_POST['editNewspaperInfo']);
        unset($_POST['newspaperno']);
        Redirect('../VIEWS/NEWSPAPER/Branch_EditNewspaper.php', false);
    }

    // SUBMIT EDITION
    if(isset($_POST['submitNewspaperEdition']))
    {
        unset($_POST['submitNewspaperEdition']);

        $lCondition = array('newspaperno' => $_SESSION['newspaperno']);
        unset($_POST['newspaperno']);
        $lNewData = $_POST;
      
        $lResult = EditData('newspaper', $lNewData, $lCondition, $_SESSION['roleno']);

        unset($_POST);
        unset($_SESSION['newspaperno']);

        if ($lResult == false) 
        {
            $lDescription = 'Error editing newspaper: ' . $_SESSION['newspaperno'];
            InsertWarning('newspaper', 'ERROR', 'EDIT', $lDescription, $_SESSION['roleno']);
        }

        Redirect('../VIEWS/NEWSPAPER/All_ListNewspapers.php', false);
    }

    // SHOW ADD PAGE --> NEWSPAPER
    if(isset($_POST['addNewspaper'])) 
    {
        unset($_POST['addNewspaper']);
        Redirect('../VIEWS/NEWSPAPER/Branch_AddNewspaper.php', false);
    }

    // SUBMIT ADDITION --> NEWSPAPER
    if(isset($_POST['submitNewspaperAddition'])) 
    {
        unset($_POST['submitNewspaperAddition']);

        $_POST['newspaperno'] = "NS" . $_POST['newspaperno'];
        $lNewData = $_POST;

        $lResult = InsertData('newspaper', $lNewData, $_SESSION['roleno']);

        unset($_POST);

        if ($lResult == false) 
        {
            $lDescription = 'Error inserting newspaper';
            InsertWarning('newspaper', 'ERROR', 'INSERT', $lDescription, $_SESSION['roleno']);
        }

        Redirect('../VIEWS/NEWSPAPER/All_ListNewspapers.php', false);
    }

?>