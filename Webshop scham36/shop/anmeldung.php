<?php
	// Zum anmelden in der Administrationsseite.
	
	include('elemente.php');
	require_once('uebersetzungen.php');

	if (isset($_COOKIE['sprache']))
	{
		$translate = new Translator($_COOKIE['sprache']);
	}
	else
	{
		$translate = new Translator('de');
	}
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

		<!--<script src="createcookies.js"></script>-->
		<script language="javascript">
			function createCookieLang(value) {
				document.cookie = "sprache=" + value + "; expires=3600; path=/";
				location.reload();
			}
		</script>
		<script src="pruefung-anmeldung.js"></script>
		<!-- Javascript-Bereich, eine Funktion direkt eingebunden, die andere aus Datei geladen-->

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
								<h2>Anmeldung für Administrationsbereich</h2>

								<form name="anmeldung" action="pruefung.php" onsubmit="return pruefungEingabe()" method="POST">
									<?php $translate->__('Benutzername'); ?>:<br>
									<input type="text" size="24" maxlength="50" name="username"><br><br>

									<?php $translate->__('Passwort'); ?>:<br>
									<input type="password" size="24" maxlength="50" name="password"><br>

									<input type="submit" value="<?php $translate->__('Anmelden'); ?>">
								</form>
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
