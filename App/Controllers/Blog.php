<?php
namespace App\Controllers;

use \Core\View;
use \Core\Controller;
/**
* Blog Controller
* 
*/
class Blog extends \Core\Controller
{
	/**
	* Show the index page
	* @return void
	*/
	
	public function indexAction()
	{
		
		
		View::render('frontend/blog.php',[
			'titlePage' => 'Blog',
			'showMenu'	 	=> Controller::showMenu()
			]);

	}

	/**
	* Show the add new page
	*/
	public function addNewAction()
	{
		echo 'Hello from addNew action Blog Controller';
	}

	/**
	* Show the edit page
	* @return void
	*/
	public function editAction()
	{
		echo "Hello from edit in blog controller";
		echo "<p> Route Parameter : <pre>".
		htmlspecialchars(print_r($this->route_params,true))."</pre></p>";
	}

	public function detailAction($args)
	{
		
			View::render('frontend/detailblog.php',[
			'artikel' 	=> 'hello',
			'showMenu'	 	=> Controller::showMenu()
			]);

	}

}