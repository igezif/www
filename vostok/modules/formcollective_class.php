<?php

class Formcollective extends Form {
	
	public function __construct($view, $param = false) {
		parent::__construct();
		$this->add("hornav");
		$this->add("n");
		$this->name = "form_viewgallery";
		$this->enctype = "multipart/form-data";
		$this->action = URL::current();
		$this->hornav = new Hornav();
		$this->hornav->addData("Админпанель", URL::get("menu", "admin"));
		if(!$param["view_id"]){
			$this->hornav->addData("Галерея", URL::get($view, "admin"));
			$this->hornav->addData("Добавить");
			$this->text("title", "Название:", FormProcessor::getSessionData("title"));
			$this->file("img", "Картинка:");
			$this->textarea("meta_desc", "Описание:", FormProcessor::getSessionData("meta_desc"));
			$this->textarea("meta_key", "Ключевые слова:", FormProcessor::getSessionData("meta_key"));
			$this->submit("insert_viewgallery", "Сохранить");
		}
		else{
			$this->hidden("id", $param["view_id"]);
			$obj = new ViewgalleryDB();
			$obj->load($param["view_id"]);
			$this->hornav->addData($obj->title, URL::get($view, "admin"));
			$this->hornav->addData("Изменить");
			$this->text("title", "Название:", $obj->title);
			$this->file("img", "Картинка:");
			$this->textarea("meta_desc", "Описание:", $obj->meta_desc);
			$this->textarea("meta_key", "Ключевые слова:", $obj->meta_key);
			$this->submit("update_viewgallery", "Сохранить");
		}
		
		
	}
	
	public function getTmplFile() {
		return "formviewgallery";
	}
	
}