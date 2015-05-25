<?php

class Formviewgallery extends Form {
	
	public function __construct($id = false) {
		parent::__construct();
		$this->add("n");
		$this->name = "form_viewgallery";
		$this->enctype = "multipart/form-data";
		$this->action = URL::current();
		if(!$id){
			$this->n = "Галерея";
			$this->text("title", "Название:", FormProcessor::getSessionData("title"));
			$this->file("img", "Картинка:");
			$this->textarea("meta_desc", "Описание:", FormProcessor::getSessionData("meta_desc"));
			$this->textarea("meta_key", "Ключевые слова:", FormProcessor::getSessionData("meta_key"));
			$this->submit("insert_viewgallery", "Сохранить");
		}
		else{
			$this->hidden("id", $id);
			$obj = new ViewgalleryDB();
			$obj->load($id);
			$this->n = $obj->title;
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