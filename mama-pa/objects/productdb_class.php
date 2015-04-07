<?php

class ProductDB extends ObjectDB {
	
	protected static $table = "product";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("category_id", "ValidateID");
		$this->add("img", "ValidateIMG");
		$this->add("brand_id", "ValidateID");
		$this->add("price", "ValidatePrice");
		$this->add("title", "ValidateTitle");
		$this->add("meta_desc", "ValidateMD");
		$this->add("meta_key", "ValidateMK");
		$this->add("available", "ValidateBoolean");
	}
	
	protected function postInit() {
		$this->link = URL::get("product", "", array("id" => $this->id));
		return true;
	}
	
	protected function postInsert() {
		return $this->id;
	}
	
	public static function getThreeRandProductOnSection($section_id) {
		$result = array();
		$data = self::$db->getResult(
			"select p.* 
			from ".Config::DB_PREFIX."product p 
			inner join ".Config::DB_PREFIX."category c on p.category_id=c.id
			inner join ".Config::DB_PREFIX."section s on c.section_id=s.id
			where s.id = ?", array($section_id)
		);
		shuffle($data);
		$array = array_slice($data, 0, 3);
		$result = ObjectDB::buildMultiple(__CLASS__, $array);
		foreach ($result as $r) $r->postHandling();
		return $result;
	}
	
	private function postHandling(){
		$this->img = Config::DIR_IMG_PRODUCT.$this->img;
		return true;
	}
	
	/* ADMINKA */
	
	public static function getAdminShow(){
		$data = self::$db->getResult(
			"select p.id, p.title, p.img, c.title as category, b.title as brand, p.price, p.meta_desc, p.meta_key, p.available
			from ".Config::DB_PREFIX."product p 
			left join ".Config::DB_PREFIX."category c on p.category_id=c.id
			left join ".Config::DB_PREFIX."brand b on p.brand_id=b.id"
		);
		print_r($data);die;
		$items = ObjectDB::buildMultiple(__CLASS__, $data);
		foreach ($items as $item) $item->postAdminHandling();
		return $items;
	}
	
	private function postAdminHandling(){
		if (!is_null($this->img)){
			$view = new View(Config::DIR_TMPL);
			$this->imageName = $this->img;
			$this->img = $view->render("img", array("src" => Config::DIR_IMG_PRODUCT.$this->img), true);
		}
		else $this->img = "нет";
		$this->link_update = URL::get("update", "admin", array("view" => "product", "id" => $this->id));
		$this->link_delete = URL::get("delete", "admin", array("view" => "product", "id" => $this->id));
		return true;
	}

}