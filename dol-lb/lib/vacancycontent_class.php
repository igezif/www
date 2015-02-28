<?php
require_once "modules_class.php";

class Vacancycontent extends Modules {
	
	protected function getContent() {
		$this->template->set("title", $this->meta->getTitle("vacancy"));
		$this->template->set("meta_desc", $this->meta->getMeta_desc("vacancy"));
		$this->template->set("meta_key", $this->meta->getMeta_key("vacancy"));
		$this->template->set("vacancy", $this->vacancy->getAllVacancy());
		return "vacancy";
	}
	
}

?>