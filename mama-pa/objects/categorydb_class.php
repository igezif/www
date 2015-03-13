<?php

class CategoryDB extends ObjectDB {
	
	protected static $table = "category";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("title", "ValidateTitle");
		$this->add("number", "ValidateID");
		$this->add("parent_number", "ValidateID");
		$this->add("meta_desc", "ValidateMD");
		$this->add("meta_key", "ValidateMK");
		
	}
	
	/* 
	protected function preInsert() {
		return true;
	}
	
	protected function postInit() {
		if (!is_null($this->img)) $this->img = Config::DIR_IMG_ARTICLES.$this->img;
		$this->link = URL::get("category", "", array("id" => $this->id));
		$section = new SectionDB();
		$section->load($this->section_id);
		$this->section = $section;
		return true;
	}
		
	protected function preValidate() {
		if (!is_null($this->img)) $this->img = basename($this->img);
		return true;
	} 
	*/
	
}