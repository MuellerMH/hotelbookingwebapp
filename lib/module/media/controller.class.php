<?php 
namespace lib\module\media;
class Controller {
	private $childs;

	public function getChilds($key) 
	{
		return $this->childs[$key];
	}

	public function setChilds($key,$value)
	{
		$this->childs[$key] = $value;
	}
}