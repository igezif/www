<?php
require_once "modules_class.php";

class Questionscontent extends Modules {
	
	protected function getContent() {
		$this->template->set("title", $this->meta->getTitle("questions"));
		$this->template->set("meta_desc", $this->meta->getMeta_desc("questions"));
		$this->template->set("meta_key", $this->meta->getMeta_key("questions"));
		return "questions";
	}
	
}

?>