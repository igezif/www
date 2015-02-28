<?php
require_once "global_class.php";

class Votes extends GlobalClass {

	public function __construct() {
		parent::__construct("votes");
	}
	
	public function getVoteID() {
		$vote_info = $this->getRandomOnField("id");
		return $vote_info["id"];
	}
	
	public function getVoteTitle($id) {
		return $this->getFieldOnID($id, "title");
	}
	
	public function getTitle($id) {
		return $this->getFieldOnID($id, "title");
	}
}
?>