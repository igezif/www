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
		$this->add("product_description", "ValidateText");
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

	protected function postUpdate() {
		return $this->id;
	}

	public static function getProductForBasket($id){
		$data = self::$db->getRow(
			"select * from ".Config::DB_PREFIX."product 
			where id = ?", array($id)
		);
		if($data) $data["img"] = Config::DIR_IMG_PRODUCT.$data["img"];
		return $data;
	}

	public static function getCountProductOnSection($section_id){
		$data = self::$db->getCell(
			"select count(*) 
			from ".Config::DB_PREFIX."product p 
			inner join ".Config::DB_PREFIX."category c on p.category_id=c.id
			inner join ".Config::DB_PREFIX."section s on c.section_id=s.id
			where s.id = ? and p.available = 1", array($section_id)
		);
		return $data;
	}

	public static function getCountProductOnCategory($category_id){
		return self::getCountOnField(self::$table, "category_id", $category_id);
	}

	public static function getProductOnSection($section_id, $count, $offset) {
		$select = new Select(self::$db);
		$select->from(self::$table, array("p.*"), "p")
			->join("INNER", "category", "c", "p.category_id=c.id")
			->join("INNER", "section", "s", "c.section_id=s.id")
			->where("`s`.`id` = ?", array($section_id))
			->where("`p`.`available` = 1")
			->order("p.title")
			->limit($count, $offset);
		$data = self::$db->select($select);
		$products = ObjectDB::buildMultiple(__CLASS__, $data);
		foreach ($products as $product) $product->postHandling();
		return $products;
	}

	public static function getProductOnCategory($category_id, $count, $offset) {
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->where("`category_id` = ?", array($category_id))
			->where("`available` = 1")
			->order("title")
			->limit($count, $offset);
		$data = self::$db->select($select);
		$products = ObjectDB::buildMultiple(__CLASS__, $data);
		foreach ($products as $product) $product->postHandling();
		return $products;
	}
	
	public function getProduct($id){
		$data = self::$db->getRow(
			"select p.*,  c.title as category, s.title as section, s.id as section_id, c.id as category_id, b.title as brand, b.img as brand_img  
			from ".Config::DB_PREFIX."product p 
			inner join ".Config::DB_PREFIX."category c on p.category_id=c.id
			inner join ".Config::DB_PREFIX."section s on c.section_id=s.id
			inner join ".Config::DB_PREFIX."brand b on p.brand_id=b.id
			where p.id = ? and p.available = 1", array($id)
		);
		if(!$data) return false;
		$data["product_description"] = htmlspecialchars_decode($data["product_description"]);
		return $this->init($data);
	}
	
	public static function getThreeRandProductOnSection($section_id) {
		$result = array();
		$data = self::$db->getResult(
			"select p.* 
			from ".Config::DB_PREFIX."product p 
			inner join ".Config::DB_PREFIX."category c on p.category_id=c.id
			inner join ".Config::DB_PREFIX."section s on c.section_id=s.id
			where s.id = ? and p.available = 1 and c.show = 1", array($section_id)
		);
		shuffle($data);
		$array = array_slice($data, 0, 3);
		$result = ObjectDB::buildMultiple(__CLASS__, $array);
		foreach ($result as $r) $r->postHandling();
		return $result;
	}

	private static function getSectionIDonProductID($id){
		$data = self::$db->getCell(
			"select s.id FROM xyz_section s 
			INNER JOIN ".Config::DB_PREFIX."category c on c.section_id = s.id
			inner join ".Config::DB_PREFIX."product p on p.category_id = c.id
			where p.id = ?", array($id)
		);
		return $data;
	}

	public static function getOthers($id){
		$section_id = self::getSectionIDonProductID($id);
		$result = array();
		$data = self::$db->getResult(
			"select p.* 
			from ".Config::DB_PREFIX."product p 
			inner join ".Config::DB_PREFIX."category c on p.category_id=c.id
			inner join ".Config::DB_PREFIX."section s on c.section_id=s.id
			where s.id = ? and p.available = 1", array($section_id)
		);
		shuffle($data);
		$array = array_slice($data, 0, 4);
		$result = ObjectDB::buildMultiple(__CLASS__, $array);
		foreach ($result as $r) $r->postHandling();
		return $result;
	}
	
	public static function search($words) {
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->where("`available` = 1");
		$articles = self::searchObjects($select, __CLASS__, array("title", "product_description"), $words, Config::MIN_SEARCH_LEN);
		return $articles;
	}

	private function postHandling(){
		$this->img = Config::DIR_IMG_PRODUCT.$this->img;
	}

	private static function getBaseSelect() {
		$select = new Select(self::$db);
		$select->from(self::$table, "*");
		return $select;
	}
	
	/* ADMINKA */
	
	public static function getAdminShow(){
		$data = self::$db->getResult(
			"select p.id, p.title, p.img, c.title as category, b.title as brand, p.price, p.product_description, p.meta_desc, p.meta_key, p.available
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
			$this->img = $view->render("img", array("src" => Config::DIR_IMG_PRODUCT.$this->img), true);
		}
		else $this->img = "нет";
		$this->link_update = URL::get("update", "admin", array("view" => "product", "id" => $this->id));
		$this->link_delete = URL::get("delete", "admin", array("view" => "product", "id" => $this->id));
		$this->alias = URL::get(self::$table, "", array("id" => $this->id));
		return true;
	}

}