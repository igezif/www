<?php
require_once "modules_class.php";

class New_articlecontent extends Modules {
	
	protected function getContent() {
		$article_info = $this->news->get($this->data["id"]);
		if (!$article_info) return $this->notFound();
		$this->template->set("title", $article_info["title"]);
		$this->template->set("meta_desc", $article_info["meta_desc"]);
		$this->template->set("meta_key", $article_info["meta_key"]);
		$this->template->set("img_src", $article_info["img_src"]);
		
		$this->template->set("full_text", $article_info["full_text"]);
		$this->template->set("new_date", $article_info["date"]);
		return "new_article";
	}
	
}

?>