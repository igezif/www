<?php

class ImgDB extends ObjectDB {
	
	protected static $table = "img";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("product_id", "ValidateID");
		$this->add("url", "ValidateIMG");
	}
	
	/* protected function postInit() {
		if (!is_null($this->img)) $this->img = Config::DIR_IMG_ARTICLES.$this->img;
		$this->link = URL::get("article", "", array("id" => $this->id));
		return true;
	}
	
	protected function postLoad() {
		$this->postHandling();
		return true;
	}
	
	public static function getAllShow($count = false, $offset = false, $post_handling = false) {
		$select = self::getBaseSelect();
		$select->order("date", false);
		if ($count) $select->limit($count, $offset);
		$data = self::$db->select($select);
		$articles = ObjectDB::buildMultiple(__CLASS__, $data);
		if ($post_handling) foreach ($articles as $article) $article->postHandling();
		return $articles;
	}
	
	public static function getAllOnPageAndSectionID($section_id, $count, $offset = false) {
		$select = self::getBaseSelect();
		$select->order("date", false)
			->where("`section_id` = ".self::$db->getSQ(), array($section_id))
			->limit($count, $offset);
		$data = self::$db->select($select);
		$articles = ObjectDB::buildMultiple(__CLASS__, $data);
		foreach ($articles as $article) $article->postHandling();
		return $articles;
	}
	
	public static function getAllOnSectionID($section_id, $order = false, $offset = false) {
		return self::getAllOnSectionOrCategory("section_id", $section_id, $order, $offset);
	}
	
	public static function getAllOnCatID($cat_id, $order = false, $offset = false) {
		return self::getAllOnSectionOrCategory("cat_id", $cat_id, $order, $offset);
	}
	
	private static function getAllOnSectionOrCategory($field, $value, $order, $offset) {
		$select = self::getBaseSelect();
		$select->where("`$field` = ".self::$db->getSQ(), array($value))
			->order("date", $order);
		$data = self::$db->select($select);
		$articles = ObjectDB::buildMultiple(__CLASS__, $data);
		return $articles;
	}
	
	public function loadPrevArticle($article_db) {
		$select = self::getBaseNeighbourSelect($article_db);
		$select->where("`id` < ".self::$db->getSQ(), array($article_db->id))
			->order("date", false);
		$row = self::$db->selectRow($select);
		return $this->init($row);
	}
	
	public function loadNextArticle($article_db) {
		$select = self::getBaseNeighbourSelect($article_db);
		$select->where("`id` > ".self::$db->getSQ(), array($article_db->id));
		$row = self::$db->selectRow($select);
		return $this->init($row);
	}
	
	public function search($words) {
		$select = self::getBaseSelect();
		$articles = self::searchObjects($select, __CLASS__, array("title", "full"), $words, Config::MIN_SEARCH_LEN);
		foreach ($articles as $article) $article->setSectionAndCategory();
		return $articles;
	}
	
	private static function getBaseNeighbourSelect($article_db) {
		$select = self::getBaseSelect();
		$select->where("`cat_id` = ".self::$db->getSQ(), array($article_db->cat_id))
			->order("date")
			->limit(1);
		return $select;
	}
	
	protected function preValidate() {
		if (!is_null($this->img)) $this->img = basename($this->img);
		return true;
	}
	
	private static function getBaseSelect() {
		$select = new Select(self::$db);
		$select->from(self::$table, "*");
		return $select;
	}
	
	private function setSectionAndCategory() {
		$section = new SectionDB();
		$section->load($this->section_id);
		$category = new CategoryDB();
		$category->load($this->cat_id);
		if ($section->isSaved()) $this->section = $section;
		if ($category->isSaved()) $this->category = $category;
		
	}
	
	private function postHandling() {
		$this->setSectionAndCategory();
		$this->count_comments = CommentDB::getCountOnArticleID($this->id);
		$this->day_show = ObjectDB::getDay($this->date);
		$this->month_show = ObjectDB::getMonth($this->date);
	} */
	
}