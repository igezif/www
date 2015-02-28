<?php
require_once "global_class.php";

class News extends GlobalClass {

	public function __construct() {
		parent::__construct("news");
	}
	
	public function checkPage($page, $count) {
		$count_pages = ceil($count / $this->config->count_on_page);
		if ($page <= 0) return false;
		if ($page > $count_pages) return false;
		if (!$this->check->intNumber($page)) return false;
		if ($page === 0) return false;
		return true;
	}
	
	public function getBlogNews($page){
		$count = $this->getCount();
		$allnews = $this->getAll("id", false);
		$start = ($page - 1) * $this->config->count_on_page;
		$end = (count($allnews) > $start + $this->config->count_on_page)? $start + $this->config->count_on_page: count($allnews);
		$j = 0;
		for ($i = $start; $i < $end; $i++) {
			$news[$j]["id"] = $allnews[$i]["id"];
			$news[$j]["title"] = $allnews[$i]["title"];
			$news[$j]["img_src"] = $allnews[$i]["img_src"];
			$news[$j]["intro_text"] = $allnews[$i]["intro_text"];
			$news[$j]["full_text"] = $allnews[$i]["full_text"];
			$news[$j]["date"] = $allnews[$i]["date"];
			$j++;
		}
		return $this->transform($news);
	}
	
	public function getPagination($count_on_page, $active_page) {
		$count = $this->getCount();
		$count_pages = ceil($count / $count_on_page);
		$pages[0]["number"] = 1;
		$pages[0]["link"] = $this->url->page($pages[0]["number"]);
		$j = 1;
		for ($i = 2; $i <= $count_pages; $i++) {
			$pages[$j]["number"] = $i;
			$pages[$j]["link"] = $this->url->page($pages[$j]["number"]);
			$j++;
		}
		for ($y = 0; $y < count($pages); $y++) {
			if ($y == $active_page) $pages[$y]["id"] = "active_page";
			else $pages[$y]["id"] = "passive_page";
		}
		return $pages;
	}
	
	protected function transformElement($news) {
		$news["link"] = $this->url->new_article($news["id"]);
		return $news;
	}
	
	
	
}
?>