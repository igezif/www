<?php

class SliderDB extends ObjectDB {
	
	protected static $table = "slider";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("product_id", "ValidateID");
		$this->add("title", "ValidateText");
		$this->add("description", "ValidateText");
	}
	
	private function postAdminHandling(){
		$view = new View(Config::DIR_TMPL);
		if (!is_null($this->img)) $this->img = $view->render("img", array("src" => Config::DIR_IMG_PRODUCT.$this->img), true);
		else $this->img = "нет";
		$this->link_update = URL::get("update", "admin", array("view" => "slider", "id" => $this->id));
		$this->link_delete = URL::get("delete", "admin", array("view" => "slider", "id" => $this->id));
		return true;
	}
	
	public static function getAdminShow(){
		$items = self::getItems();
		foreach ($items as $item) $item->postAdminHandling();
		return $items;
	}
	
	protected function postInit() {
		$this->link = URL::get("product", "", array("id" => $this->product_id));
		return true;
	}

	public static function getItems() {
		$select = new Select(self::$db);
		$select->from(self::$table, array("s.*", "p.img"), "s")
			->join("INNER", "product", "p", "s.product_id = p.id");
		$data = self::$db->select($select);
		$slider = ObjectDB::buildMultiple(__CLASS__, $data);
		return $slider;
	}
	
	protected function postInsert() {
		return $this->id;
	}
	
}