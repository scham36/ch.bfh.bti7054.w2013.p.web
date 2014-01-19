<?php
	// Zum prüfen des Benutzers auf der Administrationsseite
	
    ob_start();
    session_start();

    require_once("db-connect.php");

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, benutzername, passwort FROM benutzer WHERE benutzername='$username' LIMIT 1;";
    $result = mysqli_query($dbconn, $sql);
    $data = mysqli_fetch_assoc($result);
    
	// Wenn nicht gültige Eingabe, bleibe auf Anmeldung, ansonsten auf Administrationsseite
    if ($password != $data['passwort'] || mysqli_num_rows($result) == 0)
    {
        header('Location: anmeldung.php');
    }
	else
    {
        session_regenerate_id();
        $_SESSION['USER_ID'] = $data['id'];
        $_SESSION['USERNAME'] = $data['benutzername'];
        session_write_close();
        header('Location: administration.php');
    }
?>
