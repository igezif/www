<?php

class StudentDB extends ObjectDB {
	
	protected static $table = "student";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("name", "ValidateName");
		$this->add("group_id", "ValidateID");
	}

	public static function getStudentsOnGroupID($group_id){
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->where("`group_id` = ?", array($group_id));
		$data = self::$db->select($select);
		$students = ObjectDB::buildMultiple(__CLASS__, $data);

		
		//foreach ($groups as $g) $g->postHandling();
		return $students;
	}

	//private function postHandling() {
	//	$this->date_reg = ObjectDB::getDate($this->date_reg);
	//	$this->link = URL::get("group", "", array("id" => $this->id));
	//}
}