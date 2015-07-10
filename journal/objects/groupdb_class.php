<?php

class GroupDB extends ObjectDB {
	
	protected static $table = "group";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("number", "ValidateText");
		$this->add("teacher_id", "ValidateID");
		$this->add("date_reg", "ValidateDate", self::TYPE_TIMESTAMP, $this->getDate());
	}
	
	protected function postInit() {
		$this->date_reg = ObjectDB::getDate($this->date_reg);
		return true;
	}

	public static function issetGroup($number){
		$select = new Select(self::$db);
		$select->from(self::$table, array("id"))
			->where("`number` = ?", array($number));
		return self::$db->selectCell($select);
	}

	public static function getGroupsOnTeacherID($id){
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->where("`teacher_id` = ?", array($id));
		$data = self::$db->select($select);
		$groups = ObjectDB::buildMultiple(__CLASS__, $data);
		foreach ($groups as $g) $g->postHandling();
		return $groups;
	}

	protected function postInsert() {
		return $this->id;
	}

	protected function postUpdate() {
		return $this->id;
	}

	private function postHandling() {
		$this->link = URL::get("group", "", array("id" => $this->id));
	}
}