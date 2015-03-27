<?php

class Formbrand extends Form {
	
	public function __construct($id = false) {
		parent::__construct();
		$this->name = "form_brand";
		$this->enctype = "multipart/form-data";
		$this->action = URL::current();
		$this->file("img", "Картинка:");
		if(!$id){
			$this->text("name", "Название:");
			$this->submit("insert_brand", "Сохранить");
		}
		else{
			$this->hidden("id", $id);
			$value = BrandDB::getCellonID($id, "name");
			$this->text("name", "Название:", $value);
			$this->submit("update_brand", "Сохранить");
		}
		
		
	}
	
	public function getTmplFile() {
		return "form_brand";
	}
	
}