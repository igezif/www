<?php

class Adminpanel extends Module {

	public function __construct() {
		parent::__construct();
		/* $this->add("articles", null, true);
		$this->add("more_articles", null, true);
		$this->add("pagination"); */
	}

	public function getTmplFile() {
		return "adminpanel";
	}

}