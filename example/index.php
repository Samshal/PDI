<?php
	
	require_once("Depender.php");

	/*
	*	Instantiate the Depender Class like a pro ;) [No need to worry about any dependencies]
	*/
	$dependerClass = new Example\Depender(); //
	/*
	*	Use a method that makes use of properties/attributes from other classes (Dependee class in this case)
	*	without passing those objects (or classes) as parameter!
	*/
	$dependerClass->callDependee(); //isn't this interesting?
?>