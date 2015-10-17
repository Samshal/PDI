<?php
	require_once("../src/Injector.php");
	//require_once("classTest.php");
	class test extends \Injector
	{
		public function __construct()
		{
		}

		public function showMethodOne()
		{
			$this->test_testest_classTest->methodOne();
			echo "<br/>";
			$this->test_testest_IAmAClass->AndIAmAMethod("ILoveTheIdeaOfBeingLazy");
		}
	}

	$test = new test();
	$test->showMethodOne();
?>