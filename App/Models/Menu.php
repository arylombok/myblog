<?php

namespace App\Models;

use PDO;

/**
* 
*/
class Menu extends \Core\Model
{
	
	public static function menu()
	{
		try{
			$parent =0;
			$db = static::getDB();
			$stmt = $db->prepare("SELECT * FROM menu ORDER BY ordering ASC");
			// $stmt->bindParam(':parent',$parent);
			$stmt->execute();
			$rst = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $rst;

		}catch (PDOException $e){
			echo $e->getMessage();
		}
	}

	public static function cmenu()
	{
		try{

			$db = static::getDB();
			$stmt = $db->query("SELECT COUNT(idmenu) FROM menu");
			$rst = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $rst;

		}catch (PDOException $e){
			echo $e->getMessage();
		}
	}
	public static function menuadd($teksmenu, $linkmenu)
	{
		try{

			$db = static::getDB();
			$stmt = $db->prepare("INSERT INTO menu (menu, url) 
								 VALUES (:menu, :menu_link)");
			$stmt->bindParam(':menu',$teksmenu);
			$stmt->bindParam(':menu_link',$linkmenu);
			$stmt->execute();
			

		}catch (PDOException $e){
			echo $e->getMessage();
		}
	}

	public static function menudelete($id)
	{
		try {

			$db = static::getDB();
			$stmt = $db->prepare("DELETE FROM menu WHERE idmenu=:idmenu");
			$stmt->bindParam(':idmenu',$id);
			$stmt->execute();

			$rst ="data berhasil di hapus";
			return $rst;

		}catch (PDOException $e){
			echo $e->getMessage();
		}
	}

	
}