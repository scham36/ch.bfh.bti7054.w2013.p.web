<?php
	// Objektorientierter Warenkorb (Klasse Cart) mit Funktionen zum hinzuf�gen, l�schen, Anzahl um 1 erh�hen / reduzieren, Anzahl neu setzen
	
	class Cart
	{
		// Array zum speichern der Artikelnr. und Menge
		private $items = array();
		
		// Artikel hinzuf�gen bzw. um 1 erh�hen wenn schon vorhanden
		public function addItem($art, $qty)
		{
			if (!isset($this->items[$art]))
			{
				$this->items[$art] = 0;
			}
			
			$this->items[$art] += $qty;
		}
		
		// Menge auf Artikel �berschreiben bzw. Artikel l�schen wenn Menge auf 0 gesetzt wird
		public function changeItemQty($art, $qty)
		{
			if (isset($this->items[$art]))
			{
				$this->items[$art] = $qty;
				if ($this->items[$art] <= 0)
				{
					unset($this->items[$art]);
				}
				return true;
			}
			else return false;
		}
		
		// Menge um 1 erh�hen oder reduzieren, wird gel�scht wenn Menge 0
		public function changeItemOne($art, $qty)
		{
			if (isset($this->items[$art]))
			{
				$this->items[$art] += $qty;
				if ($this->items[$art] <= 0)
				{
					unset($this->items[$art]);
				}
				return true;
			}
			else return false;
		}
		
		// Artikel aus Warenkorb entfernen
		public function removeItemAll($art)
		{
			if (isset($this->items[$art]))
			{
				unset($this->items[$art]);
				return true;
			}
			else return false;
		}
		
		// Artikel bzw. Warenkorb anzeigen
		public function display()
		{
			echo "<table border=\"1\">";
			echo "<tr><th>Artikel</th><th>Menge</th><th>Optionen</th></tr>";
			foreach ($this->items as $art=>$qty)
				echo "<tr>
						<td>$art</td>
						<td>
							<form name='qtyForm' action='cart.php' method='get'>
								<input type='hidden' name='artChangeQty' value='$art'/>
								<input name='artQty' value='$qty'/>
								<input name='positive' type='submit' value='1' />
								<input name='negative' type='submit' value='-1' />
								<br/>
								<input type='submit' value='�ndern' />
							</form>
						</td>
						<td>
							<form name='removeForm' action='cart.php' method='get'>
								<input type='hidden' name='artRemoveAll' value='$art'/>
								<input type='submit' value='Remove' />
							</form>
						</td>
					  </tr>";
			echo "</table>";
		}
		
		// Preis eines Artikels holen
		public function getPrice($art)
		{
			$dbconn = mysqli_connect("localhost", "root", "webshop", "webshop");
			if (mysqli_connect_errno($dbconn))
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}

			if ($dbconn)
			{
				// Create SQL query
				$sql = "SELECT * 
							FROM produkte
						WHERE id = '$art'";
				$results = mysqli_query($dbconn, $sql);

				$entry = mysqli_fetch_assoc($results);
				$preis = $entry['preis'];
			}
			
			return $preis;
		}
		
		// Warenkorb zur �berpr�fung anzeigen inkl. Total des Warenkorbs
		public function displayCart()
		{
			$total = 0;
			echo "<table border=\"1\">";
			echo "<tr><th>Artikel</th><th>Menge</th><th>Preis</th></tr>";
			foreach ($this->items as $art=>$qty)
			{
				$sub = $this->getPrice($art) * $qty;
				$total += $sub;
				echo "<tr>
						<td>
							$art
						</td>
						<td>
							$qty
						</td>
						<td>
							$sub
						</td>
					  </tr>";
			}
			echo "</table>";
			echo "<br/>";
			echo "Totalpreis: " . $total . "<br/>";
			echo "<br/>";
		}
		
		// Gibt das Array des Warenkorbs zur�ck (Kopie)
		public function getArray()
		{
			$array = array();
			foreach ($this->items as $art=>$qty)
			{
				$array[$art] = $qty;
			}
			return $array;
		}
	}
?>
