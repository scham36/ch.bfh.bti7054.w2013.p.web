<?php
	// Ausgelagerte Funktionalität zum Aufbau der DB-Verbindung
	// Wird mit >require_once("db-connect.php");< in den jeweiligen php-Dateien eingebunden
	
    $host = "localhost";
    $username = "root";
    $password = "webshop";
    $dbase= "webshop";

    $dbconn = mysqli_connect($host, $username, $password, $dbase);
    if (mysqli_connect_errno($dbconn)) {
        echo "Failed to connect to database: " . mysqli_connect_error();
    }
?>
