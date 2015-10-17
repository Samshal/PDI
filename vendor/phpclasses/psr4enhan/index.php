<?php

require_once 'Autoloader.php';
// true param for auto-registration in spl_autoload_register() function.
$loader = new Autoloader(true);

// Register a namespace
$loader->registerNamespace('org\\example\\libraries', './org/example/libraries');
new org\example\libraries\DatabaseLibrary();

// Register a new file that has no namespace
$loader->registerFile('NoNamespaceClass', 'org/NoNamespaceClass.php');
new NoNamespaceClass();


// Register an entire namespace 
$loader->registerNamespace('org', 'orgtests');
// Now we can instantiate any of the test classes in org\... namespace
new org\example\controllers\HomeControllerTest();
new org\example\libraries\DatabaseLibraryTest();

// We can register more locations or directories for one namespace 
$loader->registerNamespace('org', 'org');
// now we can instantiate HomeController
new org\example\controllers\HomeController();

// Register a Class that has a diferent filename
$loader->registerFile('SomeClassName', 'index.php');
// Overwrite the last filename for "SomeClassName"
$loader->registerFile('SomeClassName', 'otherClasses/DiferentFileNameAndClassName.php', true);
new SomeClassName();

// Register more than one class per filename
$loader->registerFile('AnotherClass', 'otherClasses/DiferentFileNameAndClassName.php', true);
$loader->registerFile('YetAnotherClass', 'otherClasses/DiferentFileNameAndClassName.php', true);
// It will find it even if the file has not the same name as the class (you should NOT do this but...)
new AnotherClass();
new YetAnotherClass();

