<?php
	// Zum anzeigen der Detailansicht der Produkte

    include('elemente.php');
    require_once("db-connect.php");
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
							<!--------------------------------------------------------------------------->	
							<?php
								// ID holen
								$id = $_GET['id'];

								if ($dbconn)
								{
								// SQL Query erstellen
								$sql = "SELECT produkte.bezeichnung AS bezeichnung,
										produkte.beschreibung AS beschreibung,
											produkte.bild AS bild,
											gruppe.typ AS gruppe,
											kategorie.typ AS kategorie,
											hersteller.fname AS hersteller,
											groesse.typ AS groesse,
											produkte.preis AS preis FROM produkte
										JOIN hersteller ON produkte.hersteller=hersteller.id
										JOIN kategorie ON produkte.kategorie=kategorie.id
										JOIN groesse ON produkte.groesse=groesse.id
										JOIN gruppe ON produkte.gruppe=gruppe.id
										WHERE produkte.id=$id";
								$results = mysqli_query($dbconn, $sql);

								$entry = mysqli_fetch_assoc($results);
								
								echo "<h2>" . $entry['bezeichnung'] . "</h2>";
								echo "<img src=\"images/" . $entry['bild'] . "\" alt=\"" . $entry['bezeichnung'] . "\"></img>";
								echo "<br/>" . "\n";
								echo "<p>" . $entry['beschreibung'] . "</p>";
								echo "<table>"."\n";
								echo "<tr>"."\n";
								echo "<td width=\"150\">"."Hersteller:"."</td>";
								echo "<td>" . $entry['hersteller'] . "</td>";
								echo "</tr>" . "\n";
								echo "<tr>" . "\n";
								echo "<td>" . "Groesse:" . "</td>";
								echo "<td>" . $entry['groesse'] . "</td>";
								echo "</tr>" . "\n";
								echo "<tr>" . "\n";
								echo "</table>"."\n";
								echo "<br/>"."\n";
								echo "<p><a href=\"cart.php?artID=" . $id . "&qty=1\">Kaufen</a></p>";
								echo "<p><a href=\"index.php\" role=\"button\">Zurück zu Übersicht</a></p>";
								}
							?>
							<!--------------------------------------------------------------------------->	
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
