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
		$this->img = Config::DIR_IMG_PRODUCT.$this->img;
		return true;
	}
	
	protected function postInsert() {
		return $this->id;
	}

	public static function getAllShow($field, $value, $count = false, $offset = false, $post_handling = false) {
		//$select = self::getBaseSelect();

		$select = new Select(self::$db);
		$select->from(self::$table, "*");
			->where("$field = ?", )
			->order("date", false);
		if ($count) $select->limit($count, $offset);
		$data = self::$db->select($select);
		$articles = ObjectDB::buildMultiple(__CLASS__, $data);
		if ($post_handling) foreach ($articles as $article) $article->postHandling();
		return $articles;
	}
	
	public function loadProduct($id){
		$data = self::$db->getRow(
			"select p.*,  c.title as category, s.title as section, s.id as section_id, c.id as category_id, b.title as brand 
			from ".Config::DB_PREFIX."product p 
			inner join ".Config::DB_PREFIX."category c on p.category_id=c.id
			inner join ".Config::DB_PREFIX."section s on c.section_id=s.id
			inner join ".Config::DB_PREFIX."brand b on p.brand_id=b.id
			where p.id = ? and p.available = 1", array($id)
		);
		if ($data) return $this->init($data);
		else return false;
	}
	
	public static function getThreeRandProductOnSection($section_id) {
		$result = array();
		$data = self::$db->getResult(
			"select p.* 
			from ".Config::DB_PREFIX."product p 
			inner join ".Config::DB_PREFIX."category c on p.category_id=c.id
			inner join ".Config::DB_PREFIX."section s on c.section_id=s.id
			where s.id = ? and p.available = 1", array($section_id)
		);
		shuffle($data);
		$array = array_slice($data, 0, 3);
		$result = ObjectDB::buildMultiple(__CLASS__, $array);
		foreach ($result as $r) $r->postHandling();
		return $result;
	}
	
	private function postHandling(){
		//$this->img = Config::DIR_IMG_PRODUCT.$this->img;
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
		$items = ObjectDB::buildMultiple(__CLASS__, $data);
		foreach ($items as $item) $item->postAdminHandling();
		return $items;
	}
	
	private function postAdminHandling(){
		if (!is_null($this->img)){
			$view = new View(Config::DIR_TMPL);
			$this->imageName = $this->img;
			$this->img = $view->render("img", array("src" => $this->img), true);
		}
		else $this->img = "нет";
		$this->link_update = URL::get("update", "admin", array("view" => "product", "id" => $this->id));
		$this->link_delete = URL::get("delete", "admin", array("view" => "product", "id" => $this->id));
		return true;
	}

}