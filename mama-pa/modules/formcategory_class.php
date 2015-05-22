<?php

class Formcategory extends Form {
	
	public function __construct($id = false) {
		parent::__construct();
		$this->add("sections");
		$this->name = "form_category";
		$this->enctype = "multipart/form-data";
		$this->action = URL::current();
		$this->sections = SectionDB::getAll();
		if(!$id){
			$this->text("title", "Название:");
			$this->textarea("meta_desc", "Описание:");
			$this->textarea("meta_key", "Ключевые слова:");
			$this->checkbox("show", "Показывать:", "1");
			$this->submit("insert_category", "Сохранить");
		}
		else{
			$this->add("section_id");
			$this->hidden("id", $id);
			$obj = new CategoryDB();
			$obj->load($id);
			$this->text("title", "Название:", $obj->title);
			$this->textarea("meta_desc", "Описание:", $obj->meta_desc);
			$this->textarea("meta_key", "Ключевые слова:", $obj->meta_key);
			$this->checkbox("show", "Показывать:", "1", "", (int)$obj->show);
			$this->submit("update_category", "Сохранить");
			$this->section_id = $obj->section_id;
		}
		
		
	}
	
	public function getTmplFile() {
		return "formcategory";
	}
	
}