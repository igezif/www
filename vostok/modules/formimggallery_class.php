<?php

class Formimggallery extends Form {
	
	public function __construct($view, $param) {
		parent::__construct();
		$this->add("hornav");
		$this->add("n");
		$this->name = "form_viewgallery";
		$this->enctype = "multipart/form-data";
		$this->action = URL::current();
		$viewgallery_obj = new ViewgalleryDB();
		$viewgallery_obj->load($param["view_id"]);

		$gallery_obj = new GalleryDB();
		$gallery_obj->load($param["gallery_id"]);
		
		$this->hornav = new Hornav();
		$this->hornav->addData("Админпанель", URL::get("menu", "admin"));
		$this->hornav->addData("Галерея", URL::get("viewgallery", "admin"));
		$this->hornav->addData($viewgallery_obj->title, URL::get("listgallery", "admin", array("view_id" => $param["view_id"])));
		$this->hornav->addData($gallery_obj->title, URL::get("listimg", "admin", array("view_id" => $param["view_id"], "gallery_id" => $param["gallery_id"])));
		
		if(!$param["img_id"]){			
			$this->hornav->addData("Добавить");
			
			$this->file("img", "Картинка:");
			
			$this->submit("insert_imggallery", "Сохранить");
		}
		else{
			$this->hidden("id", $param["img_id"]);
			$gallery_obj = new GalleryDB();
			$gallery_obj->load($param["img_id"]);
			$this->hornav->addData("Изменить");
			
			$this->file("img", "Картинка:");
			
			$this->submit("update_imggallery", "Сохранить");
		}		
	}
	
	public function getTmplFile() {
		return "formimggallery";
	}
	
}