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
			$this->text("title", "Название:", FormProcessor::getSessionData("title"));
			$this->text("price", "Цена:", FormProcessor::getSessionData("price"));			
			$this->textarea("meta_desc", "Короткое описание<br />(не более 255 символов):", FormProcessor::getSessionData("meta_desc"));
			$this->textarea("product_description", "Длинное описание<br />(хоть сколько символов):", FormProcessor::getSessionData("product_description"));
			$this->textarea("meta_key", "Ключевые слова:", FormProcessor::getSessionData("meta_key"));
			$this->text("alias", "ЧПУ ссылка", FormProcessor::getSessionData("alias"));
			$this->checkbox("available", "Наличие:", "1");
			$this->file("img", "Картинка:");
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
			$this->textarea("meta_desc", "Короткое описание<br />(не более 255 символов):", $obj->meta_desc);
			$this->textarea("product_description", "Длинное описание<br />(хоть сколько символов):", $obj->product_description);
			$this->textarea("meta_key", "Ключевые слова:", $obj->meta_key);
			$link = URL::get("product", "", array("id" => $id), true, "", false);
			$alias = SefDB::getAliasOnLink($link);
			$this->text("alias", "ЧПУ ссылка", $alias);
			$this->checkbox("available", "Наличие:", "1", "", (int)$obj->available);
			$this->file("img", "Картинка:");
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