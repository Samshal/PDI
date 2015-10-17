<?php
	if (file_exists(__DIR__."/../vendor/autoload.php"))
	{
		require_once(__DIR__."/../vendor/autoload.php");
	}
	else
	{
		exit("[Error] AUTOLOAD FILES MISSING : You need to install composer to use this library");
	}
?>