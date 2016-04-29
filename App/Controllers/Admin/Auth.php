<?php

namespace App\Controllers\Admin;
use \Core\View;

use \App\Models\CekLogin;
/**
* User admin controller
* 
*/

class Auth extends \Core\Controller
{
	/**
	* Before Filter
	* @return void
	*/

	public function indexAction()
	{
		View::render('backend/login.php',[
			'titlePage' => 'Login User'
			]);
	}

	public function cekLoginAction()
	{
		if(isset($_POST['username']) && isset($_POST['password'])){
			
			$authLogin=CekLogin::login($_POST['username'],$_POST['password']);
			if(!empty($authLogin)){
				// session_start();
				$_SESSION['islogin'] =$_POST['username'];
				echo "TRUE";
			}else{
				echo "FALSE";
			}
			
		}else {
			header('location:/admin');
		}
	}

}