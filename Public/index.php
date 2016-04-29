<?php
/**
* @author rahmanariwahyudi@gmail.com
* PHP Version 5.5 Date created 12/03/2016
*/

/**
* Front Controller, the first script run !
*/
// hello

/**
* Using Twig as Templateing Engine
*
*/
 // define('BASE_URL', 'http://mymvc');
session_start();

require_once dirname(__DIR__).'/Libs/_defined.php';
DATE_TIME;

require_once dirname(__DIR__).'/Vendor/Twig-1.24.0/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
require '../Vendor/autoload.php';

/**
* Autoloader
*
*/
spl_autoload_register(function($class){
	$root = dirname(__DIR__); //get the parent dir
	$file = $root.'/'.str_replace('\\', '/',  $class).'.php';
	// $file = str_replace('avz/PTable',[],$file);
	// echo $file."<br/>";
	if (is_readable($file)){
		require $root.'/'.str_replace('\\', '/', $class).'.php';
	}
});


/**
* Error and Exception handling
*
*/
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
* Routing
*/


$router = new Core\Router();
// echo get_class($router);

// Add the route
$router->add('',['controller' => 'Home', 'action' => 'index']);
$router->add('Home',['controller' => 'Home', 'action' => 'index']);
$router->add('index',['controller' => 'Home', 'action' => 'index']);
$router->add('blog', ['controller' => 'Blog', 'action' => 'index']);
$router->add('contact', ['controller' => 'Contact', 'action' => 'index']);
$router->add('anggaran', ['controller' => 'anggaran', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('{controller}/{action}/{id:\d+}');

if (!empty($_SESSION['islogin'])) {
	$router->add('admin', ['controller' => 'Admin\admin', 'action' => 'index'],['namespace' => 'Admin']);
	$router->add('admin/{controller}/{action}',['namespace' => 'Admin']);
	$router->add('admin/{controller}/{id:\d+}/{action}',['namespace' => 'Admin']);
	$router->add('admin/{controller}/{action}',['namespace' => 'Admin']);
}else{
	$router->add('admin', ['controller' => 'Admin\auth', 'action' => 'index'],['namespace' => 'Admin']);
	$router->add('ceklogin', ['controller' => 'Admin\auth', 'action' => 'ceklogin'],['namespace' => 'Admin']);
}


$router->dispatch($_SERVER['QUERY_STRING']);
