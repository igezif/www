<?php

class Formlistgallery extends Form {
	
	public function __construct($view, $param) {
		parent::__construct();
		$this->add("hornav");
		$this->add("n");
		$this->name = "form_viewgallery";
		$this->enctype = "multipart/form-data";
		$this->action = URL::current();
		$viewgallery_obj = new ViewgalleryDB();
		$viewgallery_obj->load($param["view_id"]);

		$this->hornav = new Hornav();
		$this->hornav->addData("Админпанель", URL::get("menu", "admin"));
		$this->hornav->addData("Галерея", URL::get("viewgallery", "admin"));
		$this->hornav->addData($viewgallery_obj->title, URL::get("listgallery", "admin", array("view_id" => $param["view_id"])));
		if(!$param["gallery_id"]){			
			$this->hornav->addData("Добавить");
			$this->text("title", "Название:", FormProcessor::getSessionData("title"));
			$this->file("img", "Картинка:");
			$this->textarea("meta_desc", "Описание:", FormProcessor::getSessionData("meta_desc"));
			$this->textarea("meta_key", "Ключевые слова:", FormProcessor::getSessionData("meta_key"));
			$this->submit("insert_listgallery", "Сохранить");
		}
		else{
			$this->hidden("id", $param["gallery_id"]);
			$gallery_obj = new GalleryDB();
			$gallery_obj->load($param["gallery_id"]);
			$this->hornav->addData("Изменить");
			$this->text("title", "Название:", $gallery_obj->title);
			$this->file("img", "Картинка:");
			$this->textarea("meta_desc", "Описание:", $gallery_obj->meta_desc);
			$this->textarea("meta_key", "Ключевые слова:", $gallery_obj->meta_key);
			$this->submit("update_listgallery", "Сохранить");
		}		
	}
	
	public function getTmplFile() {
		return "formlistgallery";
	}
	
}