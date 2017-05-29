<?php
namespace lib\Core;

class API {

	private $requestMethode;
	private $requestURLArray;
	private $DB;
	private $routes=[];
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
		if ( !empty($controllerName))
			$this->controller = new $controllerName($this->db);
		else
			$this->controller = new \lib\modules\error\Controller();
		return $this->controller;
	}

	public function callController()
	{
		$controller = $this->getController();
		$methodeName = 'action'.$this->getControllerMethod();
		if ( method_exists($controller, $methodeName))
			return $controller->{$methodeName}($this->params);
		return $controller->action($methodeName);
	}

	private function getControllerName()
	{
		$routeKey = $this->prepareRegEx($this->urlString);
		$routeConfig = $this->getRoute($routeKey);
		if ( !empty($routeConfig[$this->getRequestMethode()]['controller']))
			return $routeConfig[$this->getRequestMethode()]['controller'];
		else 
			return '\lib\modules\error\Controller';
	}
	private function getControllerMethod()
	{
		$routeKey = $this->prepareRegEx($this->urlString);
		$routeConfig = $this->getRoute($routeKey);
		if ( !empty($routeConfig[$this->getRequestMethode()]['methode']))
			return $routeConfig[$this->getRequestMethode()]['methode'];
		else 
			return 'action';
	}

	public function getRegExResult($stringUri)
	{
		$result=[];
		preg_match ('/\/([a-z]*)\/([0-9]{1,5})/',$stringUri,$result);
		return $result;
	}

	private function prepareRegEx($stringUri)
	{
		$this->urlString = $stringUri;
		$foundMatch = $this->getRegExResult($stringUri);

		if ( !empty($foundMatch[2]))
		{
			//reservation 
			$placeHolder = $this->findRoute($foundMatch[1].'/');
			// match => :id
			$this->params = $foundMatch[2];
			if ( !empty($placeHolder))
				return str_replace($foundMatch[2],$placeHolder,$this->urlString);
			return $this->urlString;
		} 
		return $this->urlString;
		
	}
	// /reservation/1
	// try to search /reservation/:id
	private function findRoute($needle)
	{
		if ( is_array($this->routes)) {
			foreach ($this->routes as $key => $value) {
				$partsOfKeyArray = explode('/',$key);
				if ( strpos($key,$needle) !== false )
				{
					$this->activeRoute = $this->routes[$key];
					return $partsOfKeyArray[2];
				}
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