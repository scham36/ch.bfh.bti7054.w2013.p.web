<?php
	// 

	function get_param($name, $default)
	{
		if (isset($_GET[$name])) 
            return urldecode($_GET[$name]);
		else 
            return $default;
	}
	
	function add_param($url, $name, $value, $sep="&")
	{
		$new_url = $url . $sep . $name . "=" . urlencode($value); 
		return $new_url;
	}
	
	function menu()
	{
		global $text;
		$lan = get_param("lan", "de");
		echo "<h1>Menu</h1>";
		for ($i = 0; $i < 10; $i++)
		{
            $url = $_SERVER['PHP_SELF'];
            $url = add_param($url, "id", $i, "?");
			$url = add_param($url, "lan", $lan);
			echo "<a href=\"$url\">{$text[$lan]} $i</a><br />";
		}
	}
	
	function content()
	{
		global $text;
		global $title;
		$lan = get_param("lan", "de");
		echo "<h1>" . $title[$lan] . "</h1>";
		echo $text[$lan] . " " . get_param("id", 0);
	}
	
	function language()
	{
		$url = $_SERVER['PHP_SELF'];
		$url = add_param($url, "id", get_param("id", 0), "?");
		echo "<a href=\"" . add_param($url, "lan", "de"). "\">de</a> ";
		echo "<a href=\"" . add_param($url, "lan", "en"). "\">en</a> ";
		echo "<a href=\"" . add_param($url, "lan", "fr"). "\">fr</a> ";
	}
	
	$text = array("de"=>"Seite", "en"=>"Page", "fr"=>"Page");
	$title = array("de"=>"Willkommen", "en"=>"Welcome", "fr"=>"Bonjour");
?>
<html>
	<body>
		<table width="100%">
			<tr valign="top">
				<td width="150">
					<?php menu(); ?>
				</td>
				<td>
					<?php content(); ?>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center"> 
					<?php language(); ?> 		
				</td>
			<tr>
		</table>
	</body>
</html>
