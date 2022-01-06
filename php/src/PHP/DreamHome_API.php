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
    $lConnection = ConnectToDatabase();

    $lResult = pg_insert($lConnection, $pTable, $pNewData);

    if ($lResult) 
    {
        $lNewData = array('staffno' => $pRoleNumber, 'eventtype' => "INSERT", 'eventdata' => json_encode($pNewData), 'tablename' => $pTable);
        $lSaveLog = pg_insert($lConnection, 'log', $lNewData);
    }

    return $lResult;
}

function EditData ($pTable, $pNewData, $pCondition, $pRoleNumber) 
{
    $lConnection = ConnectToDatabase();

    $lResult = pg_update($lConnection, $pTable, $pNewData, $pCondition);

    if ($lResult) 
    {
        $lNewData = array('eventtype' => "EDIT", 'eventdata' => json_encode($pNewData), 'tablename' => $pTable);
        $lRoleData = (str_contains($pRoleNumber, 'CR')) ? array('clientno' => $pRoleNumber) : array('staffno' => $pRoleNumber);
        $lMergedArray = array_merge($lNewData, $lRoleData);
        $lSaveLog = pg_insert($lConnection, 'log', $lMergedArray);
    }

    return $lResult;
}


?>