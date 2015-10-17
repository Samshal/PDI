<?php
/**
 * @class PDI\Injector
 * @requires PHP >= 7.0 (compulsory), composer (optional), PHPUnit (optional)
 *
 * use the Injector_5.php script instead if your PHP version is < 7.0
 *
 * @author Samuel Adeshina Shalom [samueladeshina73@gmail.com | http://samshal.github.io]
 * @version 1.0
 * @since 17th Oct 2015
 * @license []
 *        
 */
	Namespace PDI;
	/**
	 * Imports the import.php script which loads the autoloader package.
	 * Displays an error message if the necessary files/packages hasn't been
	 * downloaded (using 'composer install');
	 *
	 * This file may be removed if in a production environment, and the necessary
	 * autoloads included manually
	*/
	include_once("/import.php");

	/**
	 * \PDI\Injector
	 *
	 * @inherits \Autoloader (copyright: Andrei Alexandru Romila)
	*/
	class Injector extends \Autoloader
	{
		/**
		 * Stores a boolean value indicating whether the default autoloader
		 * should be used or not
		 *
		 * @var bool
		 * @access private
		*/
		private $autoloader_state;

		/**
		 * Stores the namespace and namespace directories (locations)
		 * of all classes used (dependee or not)
		 * this array is iterated through by the registerNamespaces method
		 * to register the namespaces using the registerNamespace method found
		 * in the \Autoloader class
		 *
		 * @var array
		 * @access private
		*/
		private $namespace_locations = array();

		/**
		 * Constructor: uses the default autoloader to register all namespaces
		 * if the specified.
		 *
		 * @param $default_autoloader, boolean. Defaults to false (optional)
		 * @param $namepace_locations, array. Defaults to an empty array (optional)
		*/
		public function __construct(bool $default_autoloader = false, array $namespace_locations = array())
		{
			parent::__construct(true);
			$this->autoloader_state = $default_autoloader;
			if (self::useDefaultAutoloader())
			{
				$this->namespace_locations = $namespace_locations;
				self::registerNamespaces();
			}
		}

		/**
		 * registerNamespaces: loops through the global $namespace_location variable and
		 * sets (or registers) a namespace using the registerNamespace
		 * method declared in the \Autoloader class
		 *
		 * @access private
		 * @throws Exception
		 *
		*/
		private function registerNamespaces()
		{
			foreach($this->namespace_locations as $namespace_location)
			{
				if (is_array($namespace_location))
				{
					foreach ($namespace_location as $namespace_location_ind)
					{
						try
						{
							parent::registerNamespace($namespace_location[0], $namespace_location[1]);
						}
						catch(Exception $e)
						{
							return $e->getMessage();
						}
					}
				}
				else
				{
					try
					{
						parent::registerNamespace($this->namespace_locations[0], $this->namespace_locations[1]);
					}
					catch(Exception $e)
					{
						return $e->getMessage();
					}
					break;
				}
			}
		}

		/**
		 * getter: gets the name of an object (usually a class)
		 *
		 * @param $object_name, String. As the name implies, it returns the name of the object to get.
		 * @return object;
		 * @access public
		 *
		 * @example $this->{I_am_an_object_name}. (what happens: __get("I_am_an_object_name"))
		*/
		public function __get(string $object_name)
		{
			self::import($object_name);
			return self::getObject();
		}

		/**
		 * setter: sets the name of an object (usually a class)
		 *
		 * @param $object_name, String. As the name implies, it accepts the name of the object to set.
		 * @param $object_value, Object (Usually a class)
		 * @access public
		 *
		 * @example $this->{I_am_an_object_name} = {I_am_the_object}. (what happens: __set("I_am_an_object_name", "I_am_the_object"))
		*/
		public function __set(string $object_name, $object_value)
		{
			$this->object_name = $object_value;
		}

		/**
		 * import: as the name implies, it loads (imports) the dependee, an object that on a very normal day
		 * would have been injected into the constructor or a setter method as a dependency.
		 *
		 * @param $object, String. The name of the object to load
		 * @return void
		 * @throws an uncaught ClassNotFoundException
		 * @access private
		*/
		private function import($object)
		{
			$object = str_replace("_", "\\", $object);
			try
			{
				if (class_exists($object))
				{
					$this->$object = new $object();					
				}
				else
				{
					throw new \ClassNotFoundException();
				}
			}
			catch(ClassNotFoundException $e)
			{

			}
		}
		/**
		 * getObject: returns the actual value of an object when the __get method is invoked.
		 *
		 * @return object;
		 * @access private
		*/
		private function getObject()
		{
			return $this->object_name;
		}

		/**
		 * useDefaultAutoloader: returns a boolean value indicating whether the built - in autoloader
		 * should be used or not
		 *
		 * @return boolean;
		 * @access private
		*/
		private function useDefaultAutoloader() : bool
		{
			return $this->autoloader_state;
		}
	}
?>