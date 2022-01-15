<?php

function ConnectToDatabase() 
{
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

function InsertData ($pTable, $pNewData, $pRoleNumber)
{
    foreach (array_keys($pNewData) as $lRow) 
    {
        if(str_contains($pNewData[$lRow], 'SELECT') || str_contains($pNewData[$lRow], 'UNION') || str_contains($pNewData[$lRow], 'OR') || str_contains($pNewData[$lRow], 'AND') || str_contains($pNewData[$lRow], 'WHERE') || str_contains($pNewData[$lRow], 'or') || str_contains($pNewData[$lRow], 'and') || str_contains($pNewData[$lRow], 'DROP') )
        {
            InsertWarning($pTable, 'CRITICAL ERROR', 'INSERT', 'SQL Injection', $_SESSION['roleno']);
            require_once("./Logout_Action.php");
        }
    }

    $lConnection = ConnectToDatabase();

    $lResult = pg_insert($lConnection, $pTable, $pNewData);

    if ($lResult) 
    {
        $lNewData = array('type' => "INFO", 'staffno' => $pRoleNumber, 'eventtype' => "INSERT", 'eventdata' => json_encode($pNewData), 'tablename' => $pTable, 'securityclass' => 4);
        $lSaveLog = pg_insert($lConnection, 'log', $lNewData);
    }

    return $lResult;
}

function EditData ($pTable, $pNewData, $pCondition, $pRoleNumber) 
{
    $lConnection = ConnectToDatabase();

    $lConditionColumn = array_key_first($pCondition);
    $lConditionData = $pCondition["$lConditionColumn"];
    $lCondition = "WHERE $lConditionColumn = '$lConditionData'";

    $lOldData = GetData("*", $pTable, $lCondition);

    $lEditedData = array();
    foreach (array_keys($pNewData) as $lRow) {
        if($pNewData[$lRow] != $lOldData[$lRow]) {   
            $lAuxArray = array($lRow . '_OLD' => $lOldData[$lRow]);
            $lEditedData = array_merge($lEditedData, $lAuxArray);
            $lAuxArray = array($lRow . '_NEW' => $pNewData[$lRow]);
            $lEditedData = array_merge($lEditedData, $lAuxArray);
        }
    }

    $lResult = pg_update($lConnection, $pTable, $pNewData, $pCondition);

    if ($lResult) 
    {
        $lNewData = array('type' => "INFO", 'eventtype' => "EDIT", 'eventdata' => json_encode($lEditedData), 'tablename' => $pTable, 'securityclass' => 4);
        $lRoleData = (str_contains($pRoleNumber, 'CR')) ? array('clientno' => $pRoleNumber) : array('staffno' => $pRoleNumber);
        $lMergedArray = array_merge($lNewData, $lRoleData);
        $lSaveLog = pg_insert($lConnection, 'log', $lMergedArray);
    }

    return $lResult;
}

function InsertWarning ($pTable, $pType, $pEventType, $pDescription, $pRoleNumber) {

    $lConnection = ConnectToDatabase();

    $lNewData = array('type' => $pType, 'eventtype' => $pEventType, 'description' => $pDescription, 'tablename' => $pTable, 'securityclass' => 4);
    $lRoleData = (str_contains($pRoleNumber, 'CR')) ? array('clientno' => $pRoleNumber) : array('staffno' => $pRoleNumber);
    $lMergedArray = array_merge($lNewData, $lRoleData);
    $lSaveLog = pg_insert($lConnection, 'log', $lMergedArray);

}


?>