<?php
require_once "modules_class.php";

class Content extends Modules {
	
	protected function getContent() {
		$this->template->set("title", $this->meta->getTitle("index"));
		$this->template->set("meta_desc", $this->meta->getMeta_desc("index"));
		$this->template->set("meta_key", $this->meta->getMeta_key("index"));
		return "index";
	}
	
}

?>