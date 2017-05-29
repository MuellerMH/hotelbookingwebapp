<?php
namespace lib\Core;

abstract class Controller {
	public abstract function __construct($db);
	

	public function action($string=""){
		return "not implement " . $string;
	}
}