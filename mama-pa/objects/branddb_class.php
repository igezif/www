<?php

class BrandDB extends ObjectDB {
	
	protected static $table = "brand";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("name");
		$this->add("img");
	}
	
	protected function postInit() {
		//if (!is_null($this->img)) $this->img = Config::DIR_IMG_BRANDS.$this->img;
		$this->link = URL::get("brand", "", array("id" => $this->id));
		return true;
	}
	
	public static function getBrandIDonName($name){
		$select = new Select();
		$select->from(self::$table, array("id"))
			->where("name = ?", array($name));
		return self::$db->selectCell($select);
	}
	
	protected function postInsert() {
		return $this->id;
	}
	
	
	
}