<?php
require_once "modules_class.php";

class Aboutcontent extends Modules {
	
	protected function getContent() {
		$this->template->set("title", $this->meta->getTitle("about"));
		$this->template->set("meta_desc", $this->meta->getMeta_desc("about"));
		$this->template->set("meta_key", $this->meta->getMeta_key("about"));
		return "about";
	}
	
}

?>