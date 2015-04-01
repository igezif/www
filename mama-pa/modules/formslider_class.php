<?php

class Formslider extends Form {
	
	public function __construct($id = false) {
		parent::__construct();
		$this->add("products");
		$this->name = "form_slider";
		$this->enctype = "multipart/form-data";
		$this->action = URL::current();
		if(!$id){
			$this->text("title", "Название:");
			$this->textarea("description", "Описание:");
			$this->submit("insert_slider", "Сохранить");
			$this->products = ProductDB::getAll();
		}
		else{
			$this->add("img");
			$this->add("product_id");
			$this->hidden("id", $id);
			$obj = new SliderDB();
			$obj->load($id);
			$this->text("title", "Название:", $obj->title);
			$img = ProductDB::getCellOnID($obj->product_id, "img");
			$view = new View(Config::DIR_TMPL);
			$this->textarea("description", "Описание:", $obj->description);
			$this->submit("update_slider", "Сохранить");
			$this->img = $view->render("img", array("src" => $img), true);
			$this->product_id = $obj->product_id;
			$this->products = ProductDB::getAll();
		}
		
		
	}
	
	public function getTmplFile() {
		return "form_slider";
	}
	
}