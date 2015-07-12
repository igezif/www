<?php

class BrandDB extends ObjectDB {
	
	protected static $table = "brand";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("title", "ValidateTitle");
		$this->add("meta_desc", "ValidateMD");
		$this->add("meta_key", "ValidateMK");
		$this->add("img", "ValidateIMG");
	}
	
	protected function postInsert() {
		return $this->id;
	}

	protected function postUpdate() {
		return $this->id;
	}

	protected function postInit() {
		$this->link = URL::get("brand", "", array("id" => $this->id));
		$this->img = Config::DIR_IMG_BRAND.$this->img;
		return true;
	}

	public static function getAllShow(){
		$brands = self::getAll();
		//foreach ($brands as $brand) $brand->postHandling();
		return $brands;
	}

	public static function getBrandIDonName($name){
		$select = new Select();
		$select->from(self::$table, array("id"))
			->where("title = ?", array($name));
		return self::$db->selectCell($select);
	}

	private function postHandling(){

	}

	//ADMINKA
	private function postAdminHandling(){
		if (!is_null($this->img)){
			$view = new View(Config::DIR_TMPL);
			$this->imageName = $this->img;
			$this->img = $view->render("img", array("src" => Config::DIR_IMG_BRAND.$this->img), true);
		}
		else $this->img = "нет";
		$this->link_update = URL::get("update", "admin", array("view" => "brand", "id" => $this->id));
		$this->link_delete = URL::get("delete", "admin", array("view" => "brand", "id" => $this->id));
		$this->alias = URL::get(self::$table, "", array("id" => $this->id));
		return true;
	}
	
	public static function getAdminShow(){
		$brands = self::getAll();
		foreach ($brands as $brand) $brand->postAdminHandling();
		return $brands;
	}
	
}