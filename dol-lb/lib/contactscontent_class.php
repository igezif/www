<?php
require_once "modules_class.php";

class Contactscontent extends Modules {
	
	protected function getContent() {
		$this->template->set("title", $this->meta->getTitle("contacts"));
		$this->template->set("meta_desc", $this->meta->getMeta_desc("contacts"));
		$this->template->set("meta_key", $this->meta->getMeta_key("contacts"));
		return "contacts";
	}
	
}

?>