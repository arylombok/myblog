<?php

namespace Core;
use PDO;
use App\Config;

/**
* Base Model 
*
*/

abstract class Model
{
	/**
	* Get the PDO database connection
	* @return mixed 
	*/
	protected static function getDB()
	{
		static $db = null;
		if ($db === null){
			
				$dsn ='mysql:host='.Config::DB_HOST.';dbname='.Config::DB_NAME.';charset=utf8';
				$db  = new PDO ($dsn,Config::DB_USER,Config::DB_PASS);
				
				//Throw an Exception when an Error occurs
				$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				return $db;

		}
	}

	public static function modelMenu()
	{
		try{

			$db = static::getDB();
			$stmt = $db->query("SELECT * FROM menu WHERE published='Y' AND parent=0 ORDER BY ordering ASC ");
			$rst = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $rst;

		}catch (PDOException $e){
			echo $e->getMessage();
		}
	}
}