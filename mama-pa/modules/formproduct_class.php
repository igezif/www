<?php

class Formproduct extends Form {
	
	public function __construct($id = false) {
		parent::__construct();
		$this->add("categories");
		$this->add("brands");
		
		$this->name = "form_product";
		$this->enctype = "multipart/form-data";
		$this->action = URL::current();
		$this->categories = CategoryDB::getAll();
		$this->brands = BrandDB::getAll();
		if(!$id){
			$this->text("title", "Название:");
			$this->text("price", "Цена:");			
			$this->textarea("meta_desc", "Описание:");
			$this->textarea("meta_key", "Ключевые слова:");
			$this->checkbox("available", "Наличие:", "1");
			$this->submit("insert_product", "Сохранить");
		}
		else{
			$this->add("category_id");
			$this->add("brand_id");
			$this->add("fotos");
			$this->hidden("id", $id);
			$obj = new ProductDB();
			$obj->load($id);
			$this->text("price", "Цена:", $obj->price);
			$this->textarea("title", "Название:", $obj->title);
			$this->textarea("meta_desc", "Описание:", $obj->meta_desc);
			$this->textarea("meta_key", "Ключевые слова:", $obj->meta_key);
			$this->checkbox("available", "Наличие:", "1", "", (int)$obj->available);
			$this->submit("update_product", "Сохранить");
			$view = new View(Config::DIR_TMPL);
			$this->img = $view->render("img", array("src" => $obj->img), true);
			$this->category_id = $obj->category_id;
			$this->brand_id = $obj->brand_id;
			$this->fotos = ImgDB::getImgOnID($id);
		}
		
		
	}
	
	public function getTmplFile() {
		return "formproduct";
	}
	
}