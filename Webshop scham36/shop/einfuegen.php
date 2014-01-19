<?php
	// Einfügen von weiteren Datensätzen in die Tabellen
	
    include('elemente.php');

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
		<title>Einfügeseite von <?php echo getCompany(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Dies ist die Hauptseite">
		<meta name="author" content="scham36">
		<meta name="date" content="2013-10-11T11:00:00+02:00">
		<link href="css/flexible-columns.css" rel="stylesheet" type="text/css"/>

		<script language="javascript">
			function anzeigenTabelle(value)
			{
				document.cookie = "sprache=" + value + "; expires=3600; path=/";
				location.reload();
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
								<h2>Eintrag einfügen</h2>
								<?php
									if (isset($_POST['wert']))
									{
												$wert = $_POST['wert'];
												$tabelle = $_POST['tabelle'];
												
												$sql = "INSERT INTO $tabelle ( id, typ ) VALUES ( NULL, '$wert' )";
												mysqli_query($dbconn, $sql);
												header("Location: administration.php");
									}
									else
									{
												$tabelle = $_GET['tabelle'];
												echo "Die Daten werden in die Tabelle " . ucfirst($tabelle) . " eingefügt.";
												
												echo "<form name=\"einfuegen\" action=\"einfuegen.php\" method=\"POST\">";
												echo "<table width=\"510\" border=\"0\">";
												echo "<tr>";
												echo "<td>Wert:</td>";
												echo "<td><input type=\"text\" name=\"wert\" /><input type=\"hidden\" value=\"$tabelle\" name=\"tabelle\" /></td>";
												echo "<td>&nbsp;</td>";
												echo "</tr>";
												echo "<tr>";
												echo "<td>&nbsp;</td>";
												echo "<td><button type=\"submit\" value=\"einfuegen\">Eintrag hinzufügen</button></td>";
												echo "<td>&nbsp;</td>";
												echo "</tr>";
												echo "</table>";
												echo "</form>";
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
