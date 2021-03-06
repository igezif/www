<?php

class Form extends ModuleHornav {
	
	public function __construct() {
		parent::__construct();
		$this->add("name");
		$this->add("action");
		$this->add("method", "post");
		$this->add("header");
		$this->add("message");
		$this->add("check", true);
		$this->add("enctype");
		$this->add("inputs", null, true);
	}
	
	public function text($name, $label = "", $value = "", $default_v = "") {
		$this->input($name, "text", $label, $value, $default_v);
	}
	
	public function checkbox($name, $label = "", $value = "", $default_v = "", $on = false) {
		$this->input($name, "checkbox", $label, $value, $default_v, $on);
	}
	
	public function textarea($name, $label = "", $value = "", $default_v = "") {
		$this->input($name, "textarea", $label, $value, $default_v);
	}
	
	public function password($name, $label = "", $default_v = "") {
		$this->input($name, "password", $label, "", $default_v);
	}
	
	public function captcha($name, $label) {
		$this->input($name, "captcha", $label);
	}
	
	public function file($name, $label) {
		$this->input($name, "file", $label);
	}
	
	public function hidden($name, $value) {
		$this->input($name, "hidden", "", $value);
	}
	
	public function submit($name, $value) {
		$this->input($name, "submit", "", $value);
	}
	
	private function input($name, $type, $label, $value = false, $default_v = false, $on = false) {
		$cl = new stdClass();
		$cl->name = $name;
		$cl->type = $type;
		$cl->label = $label;
		$cl->value = $value;
		$cl->default_v = $default_v;
		$cl->on = $on;
		$this->inputs = $cl;
	}
	
	public function getTmplFile() {
		return true;
	}
	
}

?>