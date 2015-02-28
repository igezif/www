<?php
require_once "global_class.php";

class Vote_variants extends GlobalClass {

	public function __construct() {
		parent::__construct("vote_variants");
	}
		
	public function getVoteVariants($vote_id) {
		$votes = $this->getAllOnField("vote_id", $vote_id);
		$summ = 0;
		for ($i = 0; $i < count($votes); $i++) {
			$summ += $votes[$i]["votes"]; 
		}
		for ($i = 0; $i < count($votes); $i++) {
			if ($summ === 0) $votes[$i]["proc"] = 0; 
			else $votes[$i]["proc"] = round(($votes[$i]["votes"] / $summ) * 100);
		}
		$votes[0]["summ"] = $summ;
		return $votes;
	}
	
	public function setVotes($id, $votes) {
		if (!$this->check->votes($votes)) return false;
		return $this->setFieldOnID($id, "votes", $votes);
	}
}
?>