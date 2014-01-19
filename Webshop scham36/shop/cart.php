<?php
	// Zum anzeigen des Warenkorbs
	// Funktionen sind in Cart.inc.php definiert
	
	include("Cart.inc.php");
	session_start();
	
	// Warenkorb erstellen wenn nicht vorhanden
	if (!isset($_SESSION["cart"]))
		$_SESSION["cart"] = new Cart;
	
	// Artikel zum Warenkorb hinzufügen
	if (isset($_GET["artID"]) && isset($_GET["qty"]))
		$_SESSION["cart"]->addItem($_GET["artID"],$_GET["qty"]);
	
	// Aktuellen Artikel aus Warenkorb entfernen
	if (isset($_GET["artRemoveAll"]))
	{
		$_SESSION["cart"]->removeItemAll($_GET["artRemoveAll"], 1);
	}
	
	// Menge des Artikels manuell überschreiben
	if (isset($_GET["artChangeQty"]))
	{
		$_SESSION["cart"]->changeItemQty($_GET["artChangeQty"], $_GET["artQty"]);
	}
	
	// Menge um 1 erhöhen
	if (isset($_GET["positive"]))
	{
		$_SESSION["cart"]->changeItemOne($_GET["artChangeQty"], 1);
	}
	
	// Menge um 1 reduzieren
	if (isset($_GET["negative"]))
	{
		$_SESSION["cart"]->changeItemOne($_GET["artChangeQty"], -1);
	}
?>
<html><body>
	<h3>Shopping Cart:</h3>
	<?php $_SESSION["cart"]->display(); ?>
	<br/>
	<!--  zum manuellen eingeben
	<form action="cart.php" method="get">
		<input name="artID" />Artikel<br />
		<input name="qty" value="1" />Menge<br />
		<input type="submit" value="Add" />
	</form>
	-->
	<a href="checkout.php">Bestellung senden</a>
</body></html>
