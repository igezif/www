<?php

class ImggalleryDB extends ObjectDB {
	
	protected static $table = "imggallery";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("gallery_id", "ValidateId");
		$this->add("img", "ValidateIMG");
	}

	private function postHandling() {
		$this->img = Config::DIR_IMG_IMGGALLERY.$this->img;
	}

	public static function getImagesOnGalleryId($id){
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->where("`gallery_id` = ?", array($id));
		$data = self::$db->select($select);
		$items = ObjectDB::buildMultiple(__CLASS__, $data);
		foreach ($items as $item) $item->postHandling();
		return $items;
	}

	/* ADMINKA */

	public static function getAdminShow($view_id, $gallery_id){
		$items = self::getAllOnField(self::$table, __CLASS__, "gallery_id", $gallery_id);
		foreach ($items as $item) $item->postAdminHandling($view_id, $gallery_id);
		return $items;
	}

	private function postAdminHandling($view_id, $gallery_id){
		$this->link_update = URL::get("update", "admin", array("view" => "imggallery", "view_id" => $view_id, "gallery_id" => $gallery_id, "img_id" => $this->id));
		$this->link_delete = URL::get("delete", "admin", array("view" => "imggallery", "view_id" => $view_id, "gallery_id" => $gallery_id, "img_id" => $this->id));
		$this->img = Config::DIR_IMG_IMGGALLERY.$this->img;
		return true;
	}
	
}