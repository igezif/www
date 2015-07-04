<?php

class SefDB extends ObjectDB {
	
	protected static $table = "sef";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("link", "ValidateURI");
		$this->add("alias", "ValidateTitle");
	}
	
	public function loadOnLink($link) {
		return $this->loadOnField("link", $link);
	}
	
	public function loadOnAlias($alias) {
		return $this->loadOnField("alias", $alias);
	}
	
	public static function getAliasOnLink($link) {
		$select = new Select(self::$db);
		$select->from(self::$table, array("alias"))
			->where("`link` = ?", array($link));
		return self::$db->selectCell($select);
	}
	
	public static function getLinkOnAlias($alias) {
		$select = new Select(self::$db);
		$select->from(self::$table, array("link"))
			->where("`alias` = ?", array($alias));
		return self::$db->selectCell($select);
	}

	public static function issetAlias($alias){
		if(self::getLinkOnAlias($alias)) return true;
		else return false;
	}
	
	public static function issetAliasOnLink($link){
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->where("`category_id` = ?", array($link));
		$data = self::$db->select($select);
	}

}