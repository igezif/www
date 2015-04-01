<?php

class Formslider extends Form {
	
	public function __construct($id = false) {
		parent::__construct();
		$this->name = "form_slider";
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
			$obj = new SliderDB();
			$obj->load($id);
			$this->text("title", "Название:", $obj->title);
			//echo $obj->title; die;
			//print_r($obj);
			$this->textarea("description", "Описание:", $obj->description);
			$this->submit("update_slider", "Сохранить");
		}
		
		
	}
	
	public function getTmplFile() {
		return "form_brand";
	}
	
}