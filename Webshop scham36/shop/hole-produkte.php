<?php
	// Zum filtern der Produkte über DropDown auf der Hauptseite
	
    require_once('db-connect.php');

    $id = intval($_GET['id']);
    $cat = $_GET['cat'];
    $sql = "SELECT * FROM produkte";

    if ($id > 0)
    {
        $sql = "SELECT produkte.id AS id,
                    produkte.bezeichnung AS bezeichnung,
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
                    WHERE $cat=$id";
    }

    $result = mysqli_query($dbconn, $sql);
    if (mysqli_num_rows($result) == 0)
    {
        echo "Keine Produkte vorhanden.";
    }
    else
    {
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
			echo "<td>" . $entry['bezeichnung'] . "</td>";
			echo "<td>" . $entry['beschreibung'] . "</td>";
			echo "<td>" . $entry['gruppe'] . "</td>";
			echo "<td>" . $entry['kategorie'] . "</td>";
			echo "<td>" . $entry['hersteller'] . "</td>";
			echo "<td><a href=\"produkt.php?id=" . $entry['id'] . "\">Details</a> <a href=\"produkt.php?id=" . $entry['id'] . "\">Kaufen</a>";
			echo "</tr>";
		}
		echo "</table>";
    }
    mysqli_close($dbconn);
?> 
