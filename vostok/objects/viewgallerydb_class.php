<?php

class ViewgalleryDB extends ObjectDB {
	
	protected static $table = "viewgallery";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("title", "ValidateTitle");
		$this->add("img", "ValidateIMG");
	}

	public static function getAllShow() {
		$items = self::getAll();
		foreach ($items as $item) $item->postHandling();
		return $items;
	}

	private function postHandling() {
		$this->img = Config::DIR_IMG_VIEWGALLERY.$this->img;
		$this->link = URL::get("gallery", "", array("view" => $this->id));
	}

	public static function getTitleOnViewID($view_id){
		
	}

	/* ADMINKA */

	public static function getAdminShow(){
		$items = self::getAll();
		foreach ($items as $item) $item->postAdminHandling();
		return $items;
	}

	private function postAdminHandling(){
		$this->link_update = URL::get("update", "admin", array("view" => "gallery", "id" => $this->id));
		$this->link_delete = URL::get("delete", "admin", array("view" => "gallery", "id" => $this->id));
		$this->link_list = URL::get("listgallery", "admin", array("view_id" => $this->id));
		$this->img = Config::DIR_IMG_VIEWGALLERY.$this->img;
		return true;
	}

	protected function postInsert() {
		return $this->id;
	}

}