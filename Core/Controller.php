<?php

namespace Core;
use \Core\Model;
/**
* Base Controller
*
*/

abstract class  Controller
{
	/**
	* Parameter from the matced route
	* @var array
	*/
	protected $route_params = [];

	/**
	* Class constructor
	* @param array $route_params Parameters from the route
	* @return void
	*/
	public function __construct($route_params)
	{
		$this->route_params = $route_params;
	}

	/**
	* @param array @args
	* @return void
	*/
	public function __call($name, $args)
	{
		$method = $name.'Action';

		if (method_exists($this, $method)){

				call_user_func_array([$this,$method], $args);
				
		} else {
			// echo "Method ".$method." not found in Controller ".get_class($this);
			throw new \Exception("Method $method not found in Controller".get_class($this));
			
		}
	}

	public static function showMenu()
	{
		$showMenu = Model::modelMenu();
		return $showMenu;
	}

}