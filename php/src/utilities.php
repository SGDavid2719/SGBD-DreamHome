<?php
    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

    function GetData($pTable)
    {
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

        $query="SELECT*FROM $pTable";
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