<?php
require_once "modules_class.php";

class Newscontent extends Modules {

	protected function getContent() {
		$count_pages = $this->news->getCount();
		if (isset($this->data["page"])) {
			if (!$this->news->checkPage($this->data["page"], $count_pages)) return $this->notFound();
			else $page = $this->data["page"];
		}
		else $page = 1;
		$this->template->set("title", $this->meta->getTitle("news"));
		$this->template->set("meta_desc", $this->meta->getMeta_desc("news"));
		$this->template->set("meta_key", $this->meta->getMeta_key("news"));
		$this->template->set("news", $this->news->getBlogNews($page));
		$this->template->set("pages", $this->news->getPagination($this->config->count_on_page, $page - 1));
		return "news";
	}
	
}

?>