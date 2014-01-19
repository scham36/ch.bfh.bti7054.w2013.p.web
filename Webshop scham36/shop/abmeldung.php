<?php
	// Zum abmelden der Session nach dem Login in der Administrationsseite
	
    session_start();
    session_destroy();
    header("location: index.php");
?>
