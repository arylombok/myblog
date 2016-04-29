<?php

namespace App\Controllers\Admin;
use \Core\View;
use \App\Models\Menu;
/**
* User admin controller
* 
*/

class Admin extends \Core\Controller
{
	
	public function indexAction()
	{	
		View::render('backend/dasboard.php',[ 
			"titlePage" => "Administrator"
			]);
	}


	/*
	* ======== Menu ===========
	* add / edit and delete menu 
	*/
	public function menuAction()
	{
		$dataMenu = Menu::menu();
		View::render('backend/konfigurasi-menu.php',[
			"titlePage" => "Konfigurasi Menu",
			"dataMenu"	=> $dataMenu
			]);
	}

	public function menuaddAction()
	{
		if(isset($_POST['teksmenu']) && isset($_POST['linkmenu'])){

			Menu::menuadd($_POST['teksmenu'],$_POST['linkmenu']);
			header('location:/admin/menu');

		}else{
			header('location:/admin/menu');
		}
	}
	
	public function menudelete($id)
	{
		Menu::menudelete($id);
		header('location:/admin/menu');
	}

	public function logoutAction()
	{
		
		session_destroy();
		header('location:/admin');
	}

	

}