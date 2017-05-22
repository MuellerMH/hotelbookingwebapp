<?php
namespace lib\Core;

class API {

	private $requestMethode;
	private $requestURLArray;
	private $DB;
	private $routes;
	private $urlString;

	public function __construct($DB)
	{
		$this->db = $DB;
	}

	public function parseUrl($urlString)
	{
		$this->urlString = $this->prepareRegEx($urlString);
		

		return $this->urlString;
	}

	public function setRequestMethode($methodString)
	{
		$this->requestMethode = $methodString;
	}	

	public function getRequestMethode()
	{
		return $this->requestMethode;
	}	

	public function getController() 
	{
		$controllerName = $this->getControllerName();
		$this->controller = new $controllerName($this->db);
		return $this->controller;
	}

	public function callController()
	{
		$controller = $this->getController();
		$methodeName = 'action'.ucfirst($this->activeRoute[$this->getRequestMethode()]['methode']);
		return $controller->{$methodeName}($this->params);
	}

	private function getControllerName()
	{
		$routeConfig = $this->getRoute($this->prepareRegEx($this->urlString));

		return '\lib\modules\\'.ucfirst($cName).'\\Controller';
	}

	public function getRegExResult($stringUri)
	{
		$result=[];
		preg_match ('/\/([a-z]*)\/([0-9]{1,5})/',$stringUri,$result);
		return $result;
	}

	private function prepareRegEx($stringUri)
	{
		$foundMatch = $this->getRegExResult($stringUri);
		if ( !empty($foundMatch[2]))
		{
			//reservation 
			$placeHolder = $this->findRoute($foundMatch[1].'/');
			// match => :id
			$this->params = $foundMatch[2];
			if ( !empty($placeHolder))
				return str_replace($foundMatch[2],$placeHolder,$this->urlString);
		}
		
		return $stringUri;
		
	}

	private function findRoute($needle)
	{
		foreach ($this->routes as $key => $value) {
			# code...
			$partsOfKeyArray = explode('/',$key);
			if ( strpos($key,$needle) !== false )
			{
				$this->activeRoute = $this->routes[$key];
				return $partsOfKeyArray[2];
			}
		}
		return null;
	}

	public function setRoutes($arrayRoutes)
	{
		$this->routes=$arrayRoutes;
	}

	public function addRoute($requestType,$stringURI,$controller,$methode)
	{
		$this->routes[$stringURI] = [$requestType=>['controller'=>$controller,'method'=>$methode]];
	}
	public function getRoute($key)
	{
		return $this->routes[$key];
	}

}