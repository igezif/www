<?php

class GalleryDB extends ObjectDB {
	
	protected static $table = "gallery";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("view_id", "ValidateID");
		$this->add("title", "ValidateTitle");
		$this->add("img", "ValidateIMG");
		$this->add("meta_desc", "ValidateMD");
		$this->add("meta_key", "ValidateMK");
	}

	private function postHandling() {
		$this->img = Config::DIR_IMG_GALLERY.$this->img;
		$this->link = URL::get("gallery", "", array("view" => $this->view_id, "id" => $this->id));
	}

	public static function getItemsOnView($view){
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->where("`view_id` = ?", array($view));
		$data = self::$db->select($select);
		$items = ObjectDB::buildMultiple(__CLASS__, $data);
		foreach ($items as $item) $item->postHandling();
		return $items;
	}

	/* ADMINKA */
	
}