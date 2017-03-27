<?php 
namespace lib\module\room;
use \lib\core\Module;
class Controller implements Module {

	//TODO: Do it right!!
	private $childs;

	public function getChilds($key) 
	{
		return $this->childs[$key];
	}

	public function setChilds($key,$value)
	{
		$this->childs[$key] = $value;
	}

	// routing actions
	public function action() 
	{

	}

	public function actionDetail() 
	{

	}

	public function actionEdit()
	{

	}

}