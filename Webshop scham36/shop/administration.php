<?php
	// Hier kann die Datenbank abgefragt werden und es könnten weitere Infos angezeigt werden
	// welche ein Login benötigen.

    include('elemente.php');
    require_once('uebersetzungen.php');

    if (!isset($_SESSION['USER_ID']) || (trim($_SESSION['USER_ID']) == ''))
    {
        header("location: anmeldung.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Administrationsseite von <?php echo getCompany(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Dies ist die Hauptseite">
		<meta name="author" content="scham36">
		<meta name="date" content="2013-10-11T11:00:00+02:00">
		<link href="css/flexible-columns.css" rel="stylesheet" type="text/css"/>
		
		<script>
			function showReturn()
			{
				var retBtn = document.getElementById("return");
				if (retBtn.style.display == "none")
				{
					retBtn.style.display = "block";
				}
				else
				{
					retBtn.style.display = "none";
				}
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
								<!--------------------------------------------------------------------------->	
								<h2>Administrationsbereich</h2>

								<a href = "abmeldung.php">Abmelden</a>
								<br/><br/>
								<h3>Hallo <?php echo $_SESSION["USERNAME"]; ?>, deine ID ist <?php echo $_SESSION["USER_ID"]; ?>.</h3>
								<p>Du hast auf dieser Webseite schon <?php echo $_SESSION['HITS']; ?> Seiten besucht.</p>

								<h2>Tabellen</h2>
								<button onclick="location.href='administration.php';" class="ym-button" id="return" style="display:block"> zurück </button>
								<br/>
								<?php
									if (!isset($_POST['anzeigen']))
									{
										echo "<form method=\"POST\" action=\"administration.php\">";
										echo "<table>"."<tr>";
										echo "<td>Kategorie auswählen:</td>";
										echo "<td>";
										// Array fuer die Kategorien
										$kategorien = array('farbe', 'groesse', 'kategorie');
										echo "<select name=\"tabelle\">";
										foreach ($kategorien as $kat)
										{
											echo "<option value=\"" . lcfirst($kat) . "\">" . ucfirst($kat) . "</option>";
										}
										echo "</select>";
										echo "</td>";
										echo "</tr>";
										echo "<td>Operation auswählen:</td>";
										echo "<td>";
										// Array fuer die Operationen
										$kategorien = array('anzeigen', 'hinzufuegen', 'loeschen', 'bearbeiten');
										echo "<select name=\"operation\">";
										foreach ($kategorien as $kat) {
											echo "<option value=\"" . $kat . "\">" . ucfirst($kat) . "</option>";
										}
										echo "</select>";
										echo "</td>";
										echo "</tr>";
										echo "<tr>";
										echo "<td>&nbsp;</td>";
										echo "<td><input type=\"submit\" onclick=\"showReturn();\" name=\"anzeigen\" value=\"Los\"></td>";
										echo "</tr>";
										echo "</table>";
										echo "</form>";  
									}
									else
									{
										$table = $_POST['tabelle'];
										$operation = $_POST['operation'];

										switch($operation)
										{
											case "anzeigen" :
												$dbconn = mysqli_connect("localhost", "root", "webshop", "webshop");
												if (mysqli_connect_errno($dbconn))
												{
													echo "Failed to connect to MySQL: " . mysqli_connect_error();
												}
												$sql = "SELECT * FROM $table";
												$result = mysqli_query($dbconn, $sql);

												echo "<table border='1'>
														<tr>
														<th>ID</th>
														<th>Inhalt</th>
														</tr>";
												while ($entry = mysqli_fetch_array($result))
												{
													echo "<tr>";
													echo "<td>" . $entry['id'] . "</td>";
													echo "<td>" . $entry['typ'] . "</td>";
													echo "</tr>";
												}
												echo "</table>";
											break;

											case "hinzufuegen" :
												$location = "Location: einfuegen.php?tabelle=". $table;
												header($location);
												break;
											
											case "loeschen" :
												echo "loeschen von Daten in der Tabelle " . $table;
												break;
											
											case "bearbeiten" :
												echo "bearbeiten von Daten in der Tabelle " . $table;
												break;
											
											default :
												echo "Keine gültige Auswahl getroffen";
												break;
										}
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
