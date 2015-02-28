<?php
require_once "config_class.php";
require_once "url_class.php";
require_once "format_class.php";
require_once "template_class.php";
require_once "votes_class.php";
require_once "vote_variants_class.php";
require_once "news_class.php";
require_once "gallery_class.php";
require_once "meta_class.php";
require_once "reservation_class.php";
require_once "vacancy_class.php";

abstract class Modules {

	protected $config;
	protected $data;
	protected $url;
	protected $format;
	protected $votes;
	protected $vote_variants;
	protected $news;
	protected $gallery;
	protected $meta;
	protected $vote_id;
	protected $reservation;
	protected $vacancy;
	protected $template;
	
	public function __construct() {
		session_start();
		$this->config = new Config();
		$this->url = new URL();
		$this->format = new Format();
		$this->data = $this->format->xss($_REQUEST);
		$this->template = new Template($this->config->dir_tmpl);
		$this->votes = new Votes();
		$this->vote_variants = new Vote_variants();
		$this->news = new News();
		$this->gallery = new Gallery();
		$this->meta = new Meta();
		$this->vote_id = $this->votes->getVoteID();
		$this->reservation = new Reservation();
		$this->vacancy = new Vacancy();
		
		
		
		$this->template->set("index", $this->url->index());
		$this->template->set("link_news", $this->url->news());
		$this->template->set("link_gallery", $this->url->gallery());
		$this->template->set("link_reservation", $this->url->reservation());
		$this->template->set("link_vacancy", $this->url->vacancy());
		$this->template->set("link_questions", $this->url->questions());
		$this->template->set("link_about", $this->url->about());
		$this->template->set("link_contacts", $this->url->contacts());
		$this->template->set("vote_title", $this->votes->getTitle($this->vote_id)."?");
		$this->template->set("vote_variants", $this->vote_variants->getVoteVariants($this->vote_id));
		
		$this->template->set("content", $this->getContent());
		$this->template->display("main");
	}
	
	abstract protected function getContent();
		
	protected function notFound() {
		$this->redirect($this->url->notFound());
	}
		
	protected function redirect($link) {
		header("Location: $link");
		exit;
	}
	
}

?>
