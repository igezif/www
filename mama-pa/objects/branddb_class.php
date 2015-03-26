<?php

class BrandDB extends ObjectDB {
	
	protected static $table = "brand";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("name", "ValidateName");
		$this->add("img", "ValidateIMG");
	}
	
	protected function postInit() {
		if (!is_null($this->img)) $this->img = Config::DIR_IMG_BRANDS.$this->img;
		$this->link = URL::get("update", "admin", array("view" => "brand", "id" => $this->id));
		return true;
	}
	
	public static function getBrandIDonName($name){
		$select = new Select();
		$select->from(self::$table, array("id"))
			->where("name = ?", array($name));
		return self::$db->selectCell($select);
	}
	
	public static function uploadBrand($name, $file){
		$message_name = "brand";
		//$message_name_name = "name";
		//$message_password_name = "password";
		$this->name = $name;
		$id = $this->save();
		$img = $this->fp->uploadIMG($message_avatar_name, $_FILES["img"], Config::MAX_SIZE_IMG, Config::DIR_IMG_BRAND, $id);
	}
	
	public static function getAdminBrandShow(){
		return self::getAll();
	}
	
	protected function postInsert() {
		return $this->id;
	}

}