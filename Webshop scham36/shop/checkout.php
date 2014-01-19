<?php
	// Zum abschliessen der Bestellung
	// Vorname und Nachname müssen eingegeben werden
	
    include("Cart.inc.php");
	
	session_start();
	
	$_SESSION["cart"]->displayCart();
	
	echo
	"<form class='ym-form' name='adressForm' action='pdf-cart.php' method='get'>
		<div class='ym-fbox'>
			<label for='adressForm'>Vorname</label><input type='text' name='firstName' placeholder='Vornamen eingeben' />
			<br/>
			<label for='adressForm'>Nachname</label><input type='text' name='lastName' placeholder='Nachnamen eingeben' />
			<br/>
			<input type='submit' value='Abschliessen' />
		</div>
	</form>";
?>
