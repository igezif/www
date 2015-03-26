<?php

class BrandDB extends ObjectDB {
	
	protected static $table = "brand";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("name", "ValidateName");
		$this->add("img", "ValidateIMG");
	}
	
	protected function postInit() {
		$view = new View(Config::DIR_TMPL);
		if (!is_null($this->img)) $this->img = $view->render("img", array("src" => Config::DIR_IMG_BRAND.$this->img), true);
		else $this->img = "нет";
		$this->link = URL::get("update", "admin", array("view" => "brand", "id" => $this->id));
		return true;
	}
	
	public static function getBrandIDonName($name){
		$select = new Select();
		$select->from(self::$table, array("id"))
			->where("name = ?", array($name));
		return self::$db->selectCell($select);
	}
	
	public static function getAdminBrandShow(){
		return self::getAll();
	}
	
	protected function postInsert() {
		return $this->id;
	}

}