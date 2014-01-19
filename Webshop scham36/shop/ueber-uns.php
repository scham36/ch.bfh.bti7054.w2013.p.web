<?php
	// 

    include('elemente.php');
    include('boerse.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Hauptseite von <?php echo getCompany(); ?></title>

		<!-- Mobile viewport optimisation -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link href="css/flexible-columns.css" rel="stylesheet" type="text/css"/>

		<!-- Google Maps -->
		<script type="text/javascript"
			src="http://maps.googleapis.com/maps/api/js?key=AIzaSyClzvhumocd7g8cXFRj4BmyYqwZyuXizDQ&sensor=false">
		</script>
		
		<script>
			var myCenter=new google.maps.LatLng(51.508742,-0.120850);
			var marker;

			function initialize()
			{
				var mapProp =
				{
					center:myCenter,
					zoom:5,
					mapTypeId:google.maps.MapTypeId.ROADMAP
				};

				var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

				marker=new google.maps.Marker(
					{
						position:myCenter,
						animation:google.maps.Animation.BOUNCE
					}
					);

				marker.setMap(map);
			}

			google.maps.event.addDomListener(window, 'load', initialize);
		</script>
		<!-- Google Maps -->
		
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
								<h2>Über uns</h2>
								<p>Hier stehen Details über <?php echo getCompany(); ?> und andere Sachen...</p>
								
								<h2>Börsen-Kurse unserer Lieferanten</h2>
								
								<!-- Ausgelagert in Börse.php-->
								<?php
									echo getStock('ANF');
									echo getStock('VFC');
								?>
								<br/><br/>
								
								<h2>Filialen</h2>
								<p>Wir haben folgende Filialen. Vielleicht befindet sich auch eine in Ihrer Nähe:</p>
								<?php
									if (file_exists("data.xml"))
									{
										$xml=simplexml_load_file("data.xml");
										
										foreach ($xml->branch as $branch)
										{
											echo $branch->name." <br />";
											echo $branch->street." <br />";
											echo $branch->pc . " " . $branch->city." <br /><br />";
										}
									}
									else
									{
										echo "Keine Datei verfügbar.";
									}
								?>

								<div id="googleMap" style="height: 40%;"/>
								<br />
							</div>
						</div>

						<aside class="ym-col3">
							<div class="ym-cbox">
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
