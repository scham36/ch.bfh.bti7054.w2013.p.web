<?php
	// Zum holen der Börsendaten per Webservice
	
    function getStock($stockSymbol)
    {
	    if ($stockSymbol)
	    {
		    // Statement für YQL erzeugen
		    $statment = 'select Name, LastTradePriceOnly from yahoo.finance.quotes where symbol in ("'.$stockSymbol.'") | sort(field="LastTradePriceOnly", descending="true")';
		    // Request-URL zusammensetzen 
		    $base = 'http://query.yahooapis.com/v1/public/yql?';
		    $data = '&format=json&env=http://datatables.org/alltables.env&callback=';
		    $url = $base . 'q=' . urlencode($statment) . $data;
		    // Response einlesen
		    $json = file_get_contents($url);
		    // JSON-Objekt erzeugen
		    $object = json_decode($json);
		    // Knoten auswählen
		    $data = $object->query->results->quote;
		    // Daten in Tabelle ausgeben
		    return "<br /><tr><td>" . $data->Name. " : </td><td>" . $data->LastTradePriceOnly . " &euro;</td></tr>" . "</table>";
	    }
	    else
	    {
		    return "Kein passendes Symbol gefunden.";
	    }
    }
?>
