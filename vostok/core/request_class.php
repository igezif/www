<?php

class Request {
	
	private static $sef_data = array();
	private $data;
	
	public function __construct() {
		$this->data = $this->xss(array_merge($_REQUEST, self::$sef_data));
	}
	
	public static function addSEFData($sef_data) {
		self::$sef_data = $sef_data;
	}
	
	public function __get($name) {
		if (isset($this->data[$name])) return $this->data[$name];
	}
	
	public function getCountParam() {
		return count($this->data);
	}
	
	private function xss($data) {
		if (is_array($data)) {
			$escaped = array();
			foreach ($data as $key => $value) {
				$escaped[$key] = $this->xss($value);
			}
			return $escaped;
		}
		return trim(htmlspecialchars($data));
	}
	
}
?>