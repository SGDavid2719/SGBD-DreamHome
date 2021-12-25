<?php
    $host        = "host = postgresdb";
    $port        = "port = 5432";
    $dbname      = "dbname = POSTGRES_DB";
    $credentials = "user = POSTGRES_USER password=POSTGRES_PASSWORD";

    $db = pg_connect("$host $port $dbname $credentials");
    if(!$db) {
        echo "Error : Unable to open database\n";
    } else {
        echo "Opened database successfully\n";
    }
?>