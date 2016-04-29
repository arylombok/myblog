<?php
namespace App\Controllers;

use \Core\View;
use \App\Models\Blog_M;
/**
* Blog Controller
* 
*/
class Contact extends \Core\Controller
{
	/**
	* Show the index page
	* @return void
	*/
	
	public function indexAction()
	{
		View::render('frontend/contact.php',['titlePage'=>'Contact']);
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
		
		$isi_blog 	= Blog_M::getById($args);
		foreach ($isi_blog as $val) {
			$tp[]=$val['judul'];
		}
			View::render('detailblog.php',[
			'artikel' 	=> $isi_blog,
			'id'		=> $args,
			'titlePage' => $tp[0]
			]);

	}
}