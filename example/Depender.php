<?php
	Namespace Example;
	/*
	 * This example includes the Injector.php script, include Injector_5.php instead, if you haven't upgraded to php 7 yet
	 * (You need to start thinking about upgrading real soon, though)
	*/
	require_once("../src/Injector.php");

	/*
	 * The \PDI\Injector class must be inherited by any classes that makes use of any dependency
	*/
	class Depender extends \PDI\Injector
	{
		public function __construct()
		{
			/*
			 * Leave the parent's constructor (\PDI\Injector()) empty (no parameters) if you already have an autoloader
			 * or do not want to use the autoloader that comes with the package.
			 *
			 * If you don't have an autoloader and you want to autoload your classes manually, set the first parameter to true
			 * ($default_autoloader) and the second parameter should be an array of all your namespaces and their locations
			 * as the key - value pairs respectively.
			 *
			 * For Instance:
			 * $namespaces = array(
			 *					array("Namespace1", "Namespace1Location"),
			 *					array("Namespace2", "Namespace2Location"),
			 *					array("NamespaceN", "NamespaceNLocation")
			 *				);
			 *   parent::__construct(true, $namespaces);
			 * The example above will autoload every class located within the $namespaces array and make them available to PDI
			 * 
			 * parent::__construct(true, array("namespace", "namespaceLocation"))
			 * While the first example will autoload multiple namespaces, the second one above will register and autoload 
			 * just one.
			 * 
			 * parent::__construct() or no "parent __construct" at all will assume you already have an autoloader or you
			 * plan to create one
			*/
			parent::__construct(true, array("\\Example", "./"));
			echo "DEPENDER CLASS INSTANTIATED:<br/> I am the main class that needs a dependent object<br/><br/>";
		}

		public function callDependee()
		{
			echo "METHOD OF DEPENDER CLASS CALLED:<br/> While I am a method in the Depender class, i need to utilise a method from the dependee class<br/>";
			$this->_Example_Dependee->iAmImportant("I am a method of the dependee class. I am very important to the the depender class<br/>");
		}
	}
?>