<?php
class DB{
	private static $db;

	public static function getDB()
	{
		if(!isset(self::$db)){
			try {
			    self::$db=new PDO('mysql:host=<host>;dbname=<db_name>;charset=utf8', '<user>', '<password>',
			        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			} catch (Exception $e){
			}
		}
	    return self::$db;
	}
	 
}