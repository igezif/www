<?php

class Formslider extends Form {
	
	public function __construct($id = false) {
		parent::__construct();
		$this->add("products");
		$this->name = "form_slider";
		$this->enctype = "multipart/form-data";
		$this->action = URL::current();
		$this->products = ProductDB::getAdminShow();
		if(!$id){
			$this->text("title", "Название:");
			$this->textarea("description", "Описание:");
			$this->submit("insert_slider", "Сохранить");
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
			$this->img = $view->render("img", array("src" => Config::DIR_IMG_PRODUCT.$img), true);
			$this->textarea("description", "Описание:", $obj->description);
			$this->submit("update_slider", "Сохранить");
			$this->product_id = $obj->product_id;
		}
		
		
	}
	
	public function getTmplFile() {
		return "formslider";
	}
	
}