<?php

class Formsection extends Form {
	
	public function __construct($id = false) {
		parent::__construct();
		$this->name = "form_section";
		$this->enctype = "multipart/form-data";
		$this->action = URL::current();
		if(!$id){
			$this->text("title", "Название:", FormProcessor::getSessionData("title"));
			$this->textarea("meta_desc", "Описание:", FormProcessor::getSessionData("meta_desc"));
			$this->textarea("meta_key", "Ключевые слова:", FormProcessor::getSessionData("meta_key"));
			$this->text("alias", "ЧПУ ссылка", FormProcessor::getSessionData("alias"));
			$this->submit("insert_section", "Сохранить");
		}
		else{
			$this->hidden("id", $id);
			$obj = new SectionDB();
			$obj->load($id);
			$this->text("title", "Название:", $obj->title);
			$this->textarea("meta_desc", "Описание:", $obj->meta_desc);
			$this->textarea("meta_key", "Ключевые слова:", $obj->meta_key);
			$link = URL::get("section", "", array("id" => $id), true, "", false);
			$alias = SefDB::getAliasOnLink($link);
			$this->text("alias", "ЧПУ ссылка", $alias);
			$this->submit("update_section", "Сохранить");
		}
		
		
	}
	
	public function getTmplFile() {
		return "formsection";
	}
	
}