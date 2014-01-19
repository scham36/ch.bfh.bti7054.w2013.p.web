<?php
	// Code gestohlen von http://tympanus.net/codrops/
	
	class Translator
	{
		private $language = 'de';
		private $lang = array();
		   
		public function __construct($language)
		{
			$this->language = $language;
		}
		
		private function findString($string)
		{
			if (array_key_exists($string, $this->lang[$this->language]))
			{
				echo $this->lang[$this->language][$string];
				return;
			}
			echo $string;
		}
		
		private function splitStrings($string)
		{
			return explode(';', trim($string));
		}
		
		public function __($string)
		{
			if (!array_key_exists($this->language, $this->lang))
			{
				if (file_exists($this->language . '.txt')) {
					$strings = array_map(array($this, 'splitStrings'), file($this->language . '.txt'));
					foreach ($strings as $k => $v)
					{
						$this->lang[$this->language][$v[0]] = $v[1];
					}
					return $this->findString($string);
				}
				else
				{
					echo $string;
				}
			}
			else
			{
				return $this->findString($string);
			}
		}
	}
?>
