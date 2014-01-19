<?php
	// 
	
    session_start();
	// Herumspielen mit der Session Variable
	if (empty($_SESSION))
	{
		$_SESSION['HITS'] = 1;
	}
	else
	{
		$_SESSION['HITS'] = $_SESSION['HITS'] + 1;
	}

	// Externe Dateien einbinden
    require_once("db-connect.php");

	// Konstanten
    $company = 'scham36';
    $slogan = 'Kleider und mehr';

	// Allgemeine Funktionen, die von überall her verwendet werden
    function getCompany()
    {
        global $company;
        return $company;
    }

    function getSlogan()
    {
        global $slogan;
        return $slogan;
    }
    function getHeader()
    {
        global $company;
        global $slogan;
        return "<a href=\"scham36.php\">" . $company . "</a>" . " - " . $slogan;
    }

    function getFooter()
    {
        global $company;
        return $company . " - " . getYear();
    }

    function menu_left_OLD()
    {
        // Menü Array
        $menu = array('Damen' => array('Hosen', 'Oberteile', 'Röcke', 'Schuhe', 'Unterwäsche'),
                      'Herren' => array('Hosen', 'Hemden', 'T-Shirts', 'Schuhe', 'Unterwäsche')
            );
        foreach ($menu as $gender => $elements)
		{
            echo $gender;
            echo "<br/>";
            foreach ($elements as $element)
			{
                echo $element;
                echo"<br/>";
            }
        }
    }

	// Menü erstellen
    function getMenu()
    {
        echo "<a href=\"javascript:createCookieLang('de')\">de</a>";
        echo " - ";
        echo "<a href=\"javascript:createCookieLang('fr')\">fr</a>";
        echo " - ";
        echo "<a href=\"javascript:createCookieLang('en')\">en</a>";
        echo "<br /><br />";

		// Datenbankverbindung aufbauen
        $dbconn = mysqli_connect("localhost", "root", "webshop", "webshop");
        if (mysqli_connect_errno($dbconn))
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        if ($dbconn)
        {
            $sql1 = "SELECT * FROM kategorie";
            $sql2 = "SELECT * FROM gruppe LIMIT 0,2";
            $results1 = mysqli_query($dbconn, $sql1);
            $results2 = mysqli_query($dbconn, $sql2);
            $damen = array();
            $herren = array();
            while ($entry = mysqli_fetch_assoc($results1))
            {
                if ($entry["gruppe"] == 1)
                {
                    array_push($damen, $entry["typ"]);
                }
                else
                {
                    array_push($herren, $entry["typ"]);
                }
            }
			
            while ($entry = mysqli_fetch_assoc($results2))
            {
                if ($entry["typ"] == "Damen")
                {
                    echo "<b>" . $entry["typ"] . "</b><ul>";
                    foreach ($damen as $entry)
                    {
                        echo "<li><a href=\"index.php?cat=$entry&gruppe=1\">" . $entry . "</a></li>";
                    }
                }
                else
                {
                    echo "<b>" . $entry["typ"] . "</b><ul>";
                    foreach ($herren as $entry)
                    {
                        echo "<li><a href=\"index.php?cat=$entry&gruppe=2\">" . $entry . "</a></li>";
                    }
                }
             echo "</ul><br/>";
            }

			// Menu array
			$links = array(
				array('Produkt-Katalog', 'pdf-katalog.php'),
				array('Über uns', 'ueber-uns.php'),
				array('Administration', 'administration.php')
			);
            echo "<ul>";
            foreach ($links as $link)
			{
                echo "<li><a href=\"$link[1]\">" . $link[0] . "</a>";
            }
            echo "</ul>";
        }
		else
        {
            echo "DB connection error";
        }
		
		// Datenbankverbindung schliessen
        mysqli_close($dbconn);
    }

	// DropDowns erstellen
    function createDD($table)
    {
        $dbconn = mysqli_connect("localhost", "root", "webshop", "webshop");
        if (mysqli_connect_errno($dbconn))
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        if ($dbconn)
        {
                echo "<td><select name=\"$table\" onchange=\"showProducts(this.value, '$table')\">";
                echo "<option value=\"" . ucfirst($table) . "\">" . ucfirst($table) . "</option>";
                $sql = "SELECT * FROM $table";
                $results = mysqli_query($dbconn, $sql);
                while ($entry = mysqli_fetch_assoc($results))
                {
                    switch($table)
                    {
                    case hersteller:
                        echo "<option value=\"" . $entry['id'] . "\">" . $entry['fname'] . "</option>";
                        break;
                    default:
                        echo "<option value=\"" . $entry['id'] . "\">" . $entry['typ'] . "</option>";
                        break;
                    }
                }
			    echo "</select>";
        }
        else
        {
            echo "DB connection error";
        }
        mysqli_close($dbconn);
    }

	// Hilfsfunktionen
    function getPage()
    {
        date_default_timezone_set("Europe/Zurich");
        $this_page = $_SERVER['PHP_SELF'];
        return $this_page;
	}

    function getYear()
    {
        date_default_timezone_set("Europe/Zurich");
        return date("Y");
    }
?>
