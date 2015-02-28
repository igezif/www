<?php
require_once "modules_class.php";

class Voteresultcontent extends Modules {

	protected function getContent() {
		$count_votes = $this->votes->getCount();
		if (isset($this->data["id"]) && $this->data["id"] != "") {
			if ($this->data["id"] > $count_votes) return $this->notFound();
			else $id = $this->data["id"];
		}
		else return $this->notFound();
		$vote_title = str_replace(array("<br/>"), array(""), $this->votes->getVoteTitle($id));
		$this->template->set("title", $this->meta->getTitle("voteresult")." ".$vote_title);
		$this->template->set("meta_desc", $this->meta->getMeta_desc("voteresult")." ".$vote_title.".");
		$this->template->set("meta_key", $this->meta->getMeta_key("voteresult")." ".$vote_title);
		$this->template->set("vote", $vote_title);
		$this->template->set("voteresult_variants", $this->vote_variants->getVoteVariants($id));
		return "voteresult";
	}
	
}

?>