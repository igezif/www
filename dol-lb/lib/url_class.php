<?php
require_once "config_class.php";

class URL {
	
	protected $config;
	protected $amp;
	
	public function __construct($amp = true) {
		$this->config = new Config();
		$this->amp = $amp;
	}
	
	public function getView() {
		$view = $_SERVER["REQUEST_URI"];
		$view = substr($view, 1);
		if (($pos = strpos($view, "?")) !== false) {
			$view = substr($view, 0, $pos);
		}
		return $view;
	}
	
	public function setAMP($amp) {
		$this->amp = $amp;
	}
	
	public function getThisURL() {
		$uri = substr($_SERVER["REQUEST_URI"], 1);
		return $this->config->address.$uri;
	}
	
	protected function deleteGET($url, $param) {
		$res = $url;
		if (($p = strpos($res, "?")) !== false) {
			$paramstr = substr($res, $p + 1);
			$params = explode("&", $paramstr);
			$paramsarr = array();
			foreach ($params as $value) {
				$tmp = explode("=", $value);
				$paramsarr[$tmp[0]] = $tmp[1];
			}
			if (array_key_exists($param, $paramsarr)) {
				unset($paramsarr[$param]);
				$res = substr($res, 0, $p + 1);
				foreach ($paramsarr as $key => $value) {
					$str = $key;
					if ($value !== "") {
						$str .= "=$value";
					}
					$res .= "$str&";
				}
				$res = substr($res, 0, -1);
			}
		}
		return $res;
	}
	
	public function index() {
		return $this->returnURL("");
	}
	
	public function news() {
		return $this->returnURL("news");
	}
	
	public function notFound() {
		return $this->returnURL("notfound");
	}
	
	public function new_article($id) {
		return $this->returnURL("new_article?id=$id");
	}
	
	public function page($number) {
		return $this->returnURL("news?page=$number");
	}
	
	public function voteresult($vote_id) {
		return $this->returnURL("voteresult?id=$vote_id");
	}
	
	public function contacts() {
		return $this->returnURL("contacts");
	}
	
	public function about() {
		return $this->returnURL("about");
	}
	
	public function gallery() {
		return $this->returnURL("gallery");
	}
	
	public function questions() {
		return $this->returnURL("questions");
	}
	
	public function reservation() {
		return $this->returnURL("reservation");
	}
	
	public function vacancy() {
		return $this->returnURL("vacancy");
	}
	
	public function message() {
		return $this->returnURL("message");
	}
	
	protected function returnURL($url, $index = false) {
		if (!$index) $index = $this->config->address;
		if ($url == "") return $index;
		if (strpos($url, $index) !== 0) $url = $index.$url;
		if ($this->amp) $url = str_replace("&", "&amp;", $url);
		return $url;
	}
	
	public function fileExists($file) {
		$arr = explode(PATH_SEPARATOR, get_include_path());
		foreach ($arr as $val) {
			if (file_exists($val."/".$file)) return true;
		}
		return false;
	}
	
}

?>