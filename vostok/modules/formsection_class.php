<?php

class Formsection extends Form {
	
	public function __construct($id = false) {
		parent::__construct();
		$this->name = "form_brand";
		$this->enctype = "multipart/form-data";
		$this->action = URL::current();
		if(!$id){
			$this->text("title", "Название:");
			$this->textarea("meta_desc", "Описание:");
			$this->textarea("meta_key", "Ключевые слова:");
			$this->submit("insert_section", "Сохранить");
		}
		else{
			$this->hidden("id", $id);
			$obj = new SectionDB();
			$obj->load($id);
			$this->text("title", "Название:", $obj->title);
			$this->textarea("meta_desc", "Описание:", $obj->meta_desc);
			$this->textarea("meta_key", "Ключевые слова:", $obj->meta_key);
			$this->submit("update_section", "Сохранить");
		}
		
		
	}
	
	public function getTmplFile() {
		return "formsection";
	}
	
}