<?php
require_once "modules_class.php";

class Notfoundcontent extends Modules {
	
	protected function getContent() {
		$this->template->set("title", $this->meta->getTitle("notfound"));
		$this->template->set("meta_desc", $this->meta->getMeta_desc("notfound"));
		$this->template->set("meta_key", $this->meta->getMeta_key("notfound"));
		header("HTTP/1.0 404 Not Found");
		return "notfound";
	}
	
}

?>