<?php
require_once "modules_class.php";

class Gallerycontent extends Modules {
	
	protected function getContent() {
		$this->template->set("title", $this->meta->getTitle("gallery"));
		$this->template->set("meta_desc", $this->meta->getMeta_desc("gallery"));
		$this->template->set("meta_key", $this->meta->getMeta_key("gallery"));
		$this->template->set("gallery", $this->gallery->getAllImages());
		return "gallery";
	}
	
}

?>