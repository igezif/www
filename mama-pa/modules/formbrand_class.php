<?php

class Formbrand extends Form {
	
	public function __construct($id = false) {
		parent::__construct();
		$this->name = "form_brand";
		$this->enctype = "multipart/form-data";
		$this->action = URL::current();
		if(!$id){
			$this->text("title", "Название:");
			$this->file("img", "Картинка:");
			$this->textarea("meta_desc", "Описание:");
			$this->textarea("meta_key", "Ключевые слова:");
			$this->submit("insert_brand", "Сохранить");
		}
		else{
			$this->hidden("id", $id);
			$obj = new BrandDB();
			$obj->load($id);
			$this->text("title", "Название:", $obj->title);
			$this->file("img", "Картинка:");
			$this->textarea("meta_desc", "Описание:", $obj->meta_desc);
			$this->textarea("meta_key", "Ключевые слова:", $obj->meta_key);
			$this->submit("update_brand", "Сохранить");
		}
		
		
	}
	
	public function getTmplFile() {
		return "form_brand";
	}
	
}