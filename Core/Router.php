<?php

namespace Core;

/**
* Router Class 
* PHP version 5.5
*/

class Router
{
	/**
	* Associative array of routes (the routing table)
	*/
	protected $routes = [];


	/**
	* Parameters from the matched route
	* @var array
	*/
	protected $params = [];


	/**
	* Add a route to the routing table
	* 
	* @param string $route The route url
	* @param array $params Parameters (controller, action, etc)
	* @return void
	*/
	public function add($route, $params = [])
	{
		//Convert the route to a regular expression: escape forward slashes
		$route =preg_replace('/\//', '\\/', $route);

		//Convert variables e.g {controller}
		$route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

		// Convert variables with custom regular expression e.g {id:\d+}
		$route = preg_replace('/\{([a-z-]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

		//Add start and end delimeters, and case insensitive flag
		$route = '/^'.$route.'$/i';

		$this->routes[$route] = $params;
	}

	/**
	* Get all the routes from the routing table
	* @return array
	*/
	public function getRoutes()
	{
		return $this->routes;
	}

	/**
	* Match the route to the routes in the routing table, setting the $params
	* property if a route is found
	* 
	* @param string $url The route URL
	* 
	* @return boolean true if a match found, false if not
	*/
	public function match($url)
	{
		


		// Match to the fxed URL format /controller/action
		// $reg_exp = "/^(?P<controller>[a-z-]+)\/(?<action>[a-z-]+)$/";
		foreach ($this->routes as $route => $params){
			if (preg_match($route, $url,$matches)){
				// Get named capture gorup values
				// $params = [];
				foreach ($matches as $key => $match) {
					if (is_string($key)){
						$params[$key] = $match;
					}
				}
				$this->params = $params;
				return true;
			}
		}
		return false;
	}

	/**
	* Get the curently matched parameters
	* @return array
	*/
	public function getParams()
	{
		return $this->params;
	}

	/**
	* Dispath the requested url
	* action method
	* @param string $url The route URL
	* @return void
	*
	*/

	public function dispatch($url)
	{
		$url = $this->removedQueryStringVariable($url);
		$url = $this->rTrim($url);
		if ($this->match($url)){
			$controller = $this->params['controller'];
			$controller = $this->convertToStudlyCaps($controller);
			// $controller = "App\Controllers\\".$controller;
			
			if($this->params['controller']==='admin'){
				if(!empty($_SESSION['islogin'])){
					 $controller=$this->getNamespaceAdmin().$controller;
				}
			}else {$controller = $this->getNamespace().$controller;}
			// die($controller);

			if (class_exists($controller)){

				$controller_object = new $controller($this->params);

				$action = $this->params['action'];
				$action = $this->convertToCamelCase($action);
				
				if (is_callable([$controller_object, $action])){
					
					if(!empty($this->params['id'])){
						$controller_object->$action($this->params['id']);
					}else{
						$controller_object->$action();
					}

				} else {
					// echo "method ".$action." in controller ".$controller." not found";
					throw new \Exception("Method $action (in controller $controller) not found");
				}

			} else {
				// echo "Controller class ".$controller." not found";
				throw new \Exception("Controller class $controller not found");
				
			}
		}else {
			// echo "No route matched";
			throw new \Exception("No route matched");
			
		}
	}

	/**
	* Convert the string with hyphens to StudliCaps
	* e.g post-authors =>PostAuthors
	* @param string $string The tring convert
	* @return string
	*/
	protected function convertToStudlyCaps($string)
	{
		return ucwords(str_replace('-', '', $string));
	}

	/**
	* Convert the string with hyphens to camelCase
	* e.g add-new => addNew
	* @param string $string The string to convert
	* @return string
	*/
	protected function convertToCamelCase($string)
	{
		return lcfirst($this->convertToStudlyCaps($string));
	}

	/*
	* A URL of the format localhost/?page (on variable name, no value)
	* wont work. (NB. The .htaccess file convert the first ? to a & when
	* its passed throught to the $_SERVER variable)
	* @param string $ulr The full URL
	* @return string The URL with the query string variables removed
	*/
	protected function removedQueryStringVariable($url)
	{
		if ($url !=''){
			$part = explode('&', $url,2);
			if (strpos($part[0],'=')=== false) {
				$url = $part[0];
			} else {
				$url = '';
			}
		}
		return $url;
	}

	protected function getNamespace()
	{
		$namespace = 'App\Controllers\\';

		if (array_key_exists('namespace', $this->params)){
			$namespace .= $this->params['namespace'].'\\';
		}
		return $namespace;
	}

	protected function getNamespaceAdmin()
	{
		$namespace = 'App\Controllers\Admin\\';

		if (array_key_exists('namespace', $this->params)){
			$namespace .= $this->params['namespace'].'\\';
		}
		return $namespace;
	}

	protected function rTrim($url)
	{
		return rtrim($url,'/\\');
	}
}	
