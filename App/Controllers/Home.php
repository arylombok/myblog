<?php

namespace App\Controllers;
use \Core\View;
use \Core\Controller;
/**
*  Controllers Class Home 
*/
class Home extends \Core\Controller
{

	public function indexAction()
	{
		// echo "Here is the method index from Home Controller";
		View::render('frontend/home.php',[
			'titlePage'	=> 'Home',
			'showMenu'	 	=> Controller::showMenu()
			]);
	}
}