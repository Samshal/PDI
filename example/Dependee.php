<?php
	Namespace Example;
	class Dependee
	{
		public function __construct()
		{
			echo "<br/>DEPENDEE CLASS INSTANTIATED: <br/>";
			echo "I am an important class, because there a lot of dependers relying on me<br/><br/>";
		}

		public function iAmImportant($string)
		{
			echo "METHOD OF DEPENDEE CLASS INSTANTIATED: <br/>";
			echo $string;
		}
	}