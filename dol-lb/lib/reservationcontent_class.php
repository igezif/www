<?php
require_once "modules_class.php";

class Reservationcontent extends Modules {
	
	protected function getContent() {
		$this->template->set("title", $this->meta->getTitle("reservation"));
		$this->template->set("meta_desc", $this->meta->getMeta_desc("reservation"));
		$this->template->set("meta_key", $this->meta->getMeta_key("reservation"));
		$this->template->set("years", $this->reservation->getYears());
		return "reservation";
	}
	
}

?>