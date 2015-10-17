<?php
namespace org\example\controllers;

use org\AbstractController;

class HomeController extends AbstractController {
	function __construct() {
		var_dump(__CLASS__);
	}
}
