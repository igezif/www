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

	public static function getAdminShow($view_id){
		$items = self::getAllOnField(self::$table, __CLASS__, "view_id", $view_id);
		foreach ($items as $item) $item->postAdminHandling();
		return $items;
	}

	private function postAdminHandling(){
		$this->link_update = URL::get("update", "admin", array("view" => "listgallery", "view_id" => $this->view_id, "gallery_id" => $this->id));
		$this->link_delete = URL::get("delete", "admin", array("view" => "listgallery", "view_id" => $this->view_id, "gallery_id" => $this->id));
		$this->link_list = URL::get("listimg", "admin", array("view_id" => $this->view_id, "gallery_id" => $this->id));
		$this->img = Config::DIR_IMG_GALLERY.$this->img;
		return true;
	}
	
}