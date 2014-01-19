<?php
	// Hauptseite mit Menüs usw.

    include('elemente.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Hauptseite von <?php echo getCompany(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Dies ist die Hauptseite">
		<meta name="author" content="scham36">
		<meta name="date" content="2013-10-11T11:00:00+02:00">
		<link href="css/flexible-columns.css" rel="stylesheet" type="text/css"/>

		<script>
		function showProducts(id, cat)
		{
			// TODO: Nach jeder Auswahl die anderen DropDowns reseten
			//document.getElementById("Dropdown").value = 0;
			if (id == "")
			{
				document.getElementById("produkte").innerHTML = "";
				return;
			}
			
			if (window.XMLHttpRequest)
			{
				xmlhttp=new XMLHttpRequest();
			}
			else
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange = function()
			{
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
					document.getElementById("produkte").innerHTML=xmlhttp.responseText;
				}
			}
			
			xmlhttp.open("GET", "hole-produkte.php?id=" + id + "&cat=" + cat, true);
			xmlhttp.send();
		}
		</script>
	</head>
	<body>
		<div class="ym-wrapper">
			<div class="ym-wbox">
				<header>
					<h1><?php echo getCompany(); ?>&nbsp;<img src="images/scham36.png" alt="Logo" /></h1><?php echo getSlogan(); ?>
				</header>
				<main>
					<div class="ym-column linearize-level-1">
						<div class="ym-col1">
							<div class="ym-cbox">
								<h2>Produkte</h2>

								<?php
									createDD('kategorie');
									createDD('hersteller');
								?>
								<button onclick="location.reload();" class="ym-button">Reset</button>
								
								<?php
									if (empty($_GET["gruppe"]) || empty($_GET["cat"]))
									{
										$sql = "SELECT produkte.id AS id,
													produkte.bezeichnung AS bezeichnung,
													produkte.bezeichnung AS beschreibung,
													produkte.bild AS bild,
													gruppe.typ AS gruppe,
													kategorie.typ AS kategorie,
													hersteller.fname AS hersteller,
													groesse.typ AS groesse,
													produkte.preis AS preis FROM produkte
												JOIN hersteller ON produkte.hersteller=hersteller.id
												JOIN kategorie ON produkte.kategorie=kategorie.id
												JOIN groesse ON produkte.groesse=groesse.id
												JOIN gruppe ON produkte.gruppe=gruppe.id";
									}
									else
									{
										$gruppe = $_GET["gruppe"];
										$cat =  $_GET["cat"];
												
										$sql = "SELECT produkte.id AS id,
													produkte.bezeichnung AS bezeichnung,
													produkte.bezeichnung AS beschreibung,
													produkte.bild AS bild,
													gruppe.typ AS gruppe,
													kategorie.typ AS kategorie,
													hersteller.fname AS hersteller,
													groesse.typ AS groesse,
													produkte.preis AS preis FROM produkte
												JOIN hersteller ON produkte.hersteller=hersteller.id
												JOIN kategorie ON produkte.kategorie=kategorie.id and kategorie.typ = '$cat'
												JOIN groesse ON produkte.groesse=groesse.id
												JOIN gruppe ON produkte.gruppe=gruppe.id and gruppe.id = $gruppe";
									}
									
									$result = mysqli_query($dbconn, $sql);

									echo "<div id=\"produkte\">";
									echo "<br />";
									echo "<table>
											<tr>
											<th>Bild</th>
											<th>Bezeichnung</th>
											<th>Beschreibung</th>
											<th>Gruppe</th>
											<th>Kategorie</th>
											<th>Hersteller</th>
											<th></th>
											</tr>";

									while ($entry = mysqli_fetch_array($result))
									{
										$filename = explode(".", $entry['bild']);
										echo "<tr>";
										echo "<td>" . "<img src=\"images/" . $filename[0] . "-tn." . $filename[1] . "\" alt=\"" . $entry['bezeichnung'] . "\"></img>" . "</td>";
										echo "<td><a href=\"produkt.php?id=" . $entry['id'] . "\">" . $entry['bezeichnung'] . "</a></td>";
										echo "<td>" . $entry['beschreibung'] . "</td>";
										echo "<td>" . $entry['gruppe'] . "</td>";
										echo "<td>" . $entry['kategorie'] . "</td>";
										echo "<td>" . $entry['hersteller'] . "</td>";
										echo "<td><a href=\"produkt.php?id=" . $entry['id'] . "\">Details</a> <a href=\"cart.php?artID=" . $entry['id'] . "&qty=1\">Kaufen</a>";
										echo "</tr>";
									}
									echo "</table>";

									mysqli_close($dbconn);

									echo "</div>";
								?>
							</div>
						</div>

						<aside class="ym-col3">
							<div class="ym-cbox">
								<h2>Kategorien</h2>
								<div class="ym-contain-dt">
									<?php echo getMenu(); ?>
								</div>
							</div>
						</aside>
					</div>
				</main>
				<footer>
					<p><?php echo getFooter(); ?></p>
				</footer>
			</div>
		</div>
	</body>
</html>
