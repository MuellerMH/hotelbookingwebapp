<?php
namespace lib\modules\error;
use lib\Core\Controller as AController;

class Controller extends AController
{
	public function __construct($DB)
	{
		$this->dataBaseConnection = $DB;
	}

	public function action($string=""){
		return "not implement " . $string;
	}
}