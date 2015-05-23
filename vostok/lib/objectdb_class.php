<?php

abstract class ObjectDB extends AbstractObjectDB {
	
	private static $months = array("янв", "фев", "март", "апр", "май", "июнь", "июль", "авг", "сен", "окт", "ноя", "дек");
	
	public function __construct($table) {
		parent::__construct($table, Config::FORMAT_DATE);
	}
	
	protected static function getMonth($date = false) {
		if ($date) $date = strtotime($date);
		else $date = time();
		return self::$months[date("n", $date) - 1];
	}
	
	protected static function getRandDigits($max, $count){
		$x=array();
		$tmp=array();
		for ($i = 0; $i < $count; $i++) {
		   do {
			  $a = mt_rand(1, $max);
		   } while(isset($tmp[$a]));
		   $tmp[$a]=1;
		   $x[]=$a;
		}
		return $x;
	}

	protected static function getAllOnID($table, $id){
		$select = new Select(self::$db);
		$select->from($table, "*")
			->where("`id` = ?", array($id));
		$data = self::$db->select($select);
		return $data;
	}
	
	public function preEdit($field, $value) {
		return true;
	}
	
	public function postEdit($field, $value) {
		return true;
	}
	
	public function accessEdit($auth_user, $field) {
		return false;
	}
	
	public function accessDelete($auth_user) {
		return false;
	}
	
}

?>