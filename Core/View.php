<?php
 
 namespace Core;

 /**
 * Base View  
 * 
 */
 class View
 {
 	/**
 	* Render a view file here
 	* @param string $view file
 	* @return void
 	*/

 	public static function render($view, $args = [])
 	{
 		extract($args, EXTR_SKIP);
 		$file ="../App/Views/".$view; //relative to Core directory

 		if (is_readable($file)){
 			require $file;
 		} else {
 			// echo $file." not found";
 			throw new \Exception("$file not found");
 			
 		}
 	}

 	/**
 	* Render a view using template engine twig
 	* @param string $template : The Template file 
 	* @param array $args Associative array of data to display in the view(optional)
 	* @return void
 	*/
 	public static function renderTwig($template, $args = [])
 	{
 		static $twig = null;

 		if($twig === null){
 			$loader = new\Twig_Loader_Filesystem('../App/Views');
 			$twig 	= new \Twig_Environment($loader);
 			echo $twig->render($template,$args);
 		}
 	}
 }