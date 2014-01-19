<?php
	// Zum modifizieren der Einträge in der DB

	// TOTO Fertigmachen...
	
	
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
								<h2>Änderungen</h2>
								<?php
									$sql = "SELECT * FROM farbe";
									$result = mysqli_query($dbconn, $sql);

									echo "<table border='1'>
											<tr>
											<th>ID</th>
											<th>Bezeichnung</th>
											<th></th>
											</tr>";

									while ($entry = mysqli_fetch_array($result))
									{
										echo "<tr>";
										echo "<td>" . $entry['id'] . "</td>";
										echo "<td>" . $entry['typ'] . "</td>";
										echo "<td><a href=\"produkt.php?id=" . $entry['id'] . "\">Aktualisieren</a> <a href=\"produkt.php?id=" . $entry['id'] . "\">Löschen</a>";
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
