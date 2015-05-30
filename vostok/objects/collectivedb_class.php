<?php

class CollectiveDB extends ObjectDB {
	
	protected static $table = "collective";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("name`", "ValidateTitle");
		$this->add("post`", "ValidateTitle");
		$this->add("img", "ValidateIMG");
	}

	public static function getAllShow() {
		$items = self::getAll();
		foreach ($items as $item) $item->postHandling();
		return $items;
	}

	private function postHandling() {
		$this->img = Config::DIR_IMG_COLLECTIVE.$this->img;
	}

	/* ADMINKA */

	public static function getAdminShow(){
		$items = self::getAll();
		foreach ($items as $item) $item->postAdminHandling();
		return $items;
	}

	private function postAdminHandling(){
		$this->link_update = URL::get("update", "admin", array("view" => "collective", "view_id" => $this->id));
		$this->link_delete = URL::get("delete", "admin", array("view" => "collective", "view_id" => $this->id));
		$this->img = Config::DIR_IMG_COLLECTIVE.$this->img;
		return true;
	}

	protected function postInsert() {
		return $this->id;
	}

}