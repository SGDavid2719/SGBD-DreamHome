<?php
    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

    function GetData($pTable, $pCriteria)
    {
        // Connection arguments
        $host        = "host = postgresdb";
        $port        = "port = 5432";
        $dbname      = "dbname = DREAMHOME_DB";
        $credentials = "user=DREAMHOME_USER password=DREAMHOME_PASSWORD";

        // Create connection
        $connection = pg_connect( "$host $port $dbname $credentials");
        // Check connection
        if(!$connection) {
            die("Connection failed: " . $connection->connect_error);
        }

        $query="SELECT*FROM $pTable" . $pCriteria;
        $result = pg_query($connection, $query);
    
        $data = pg_fetch_row($result);
        $rows = pg_num_rows($result);
    
        if($rows) {
            return $data;
        } else {
            // Error
        }
        pg_free_result($result);
        pg_close($connection);
    }
?>