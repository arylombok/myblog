<?php

namespace App\Models;

use PDO;

/**
* 
*/
class CekLogin extends \Core\Model
{
	
	public static function login($user,$pass)
	{
		try{

			$db = static::getDB();
			$stmt = $db->query("SELECT * FROM pengguna
								WHERE uname='".$user."' AND password=md5('".$pass."') ");
			$rst = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			return $rst;	

		}catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public static function menu()
	{
		try{

			$db = static::getDB();
			$stmt = $db->query("SELECT * FROM menu ORDER BY menu_id");
			$rst = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $rst;

		}catch (PDOException $e){
			echo $e->getMessage();
		}
	}

	
}