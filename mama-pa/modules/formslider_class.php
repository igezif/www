<?php

class Formslider extends Form {
	
	public function __construct($id = false) {
		parent::__construct();
		$this->add("img");
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
			$img = ProductDB::getCellOnID($obj->product_id, "img");
			$view = new View(Config::DIR_TMPL);
			$this->img = $view->render("img", array("src" => $img), true);
			$this->textarea("description", "Описание:", $obj->description);
			$this->submit("update_slider", "Сохранить");
		}
		
		
	}
	
	public function getTmplFile() {
		return "form_slider";
	}
	
}