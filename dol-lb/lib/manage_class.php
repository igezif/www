<?php
require_once "config_class.php";
require_once "format_class.php";
require_once "reservation_class.php";
require_once "mail_class.php";
require_once "url_class.php";
require_once "votes_class.php";
require_once "vote_variants_class.php";
require_once "email_class.php";


class Manage {
	
	protected $config;
	protected $reservation;
	protected $format;
	protected $url;
	protected $votes;
	protected $vote_variants;
	private $mail;
	private $data;
	
	public function __construct() {
		session_start();
		$this->config = new Config();
		$this->format = new Format();
		$this->reservation = new Reservation();
		$this->votes = new Votes();
		$this->vote_variants = new Vote_variants();
		$this->mail = new Mail();
		$this->url = new URL();
		$this->data = $this->format->xss($_REQUEST);	
	}
	
	private function getYear() {
		if (date("M") < 6) $year = date("Y");
		elseif (date("M") > 6) $year = date("Y") + 1;
		return $year;
	}
	
	public function redirect($link) {
		header("Location: $link");
		exit;
	}
	
	public function reserv() {
		if (!$this->reservation->isExistsEmail($this->data["email"])) {
			$temp_data = array();
			$temp_data["name"] = $this->data["name"];
			$temp_data["surname"] = $this->data["surname"];
			$temp_data["patronymic"] = $this->data["patronymic"];
			$temp_data["year_born"] = $this->data["year_born"];
			$temp_data["sezon"] = $this->data["sezon"];
			$temp_data["email"] = $this->data["email"];
			$temp_data["phone"] = $this->data["phone"];
			$temp_data["date"] = date("d.m.Y H:i:s");
			$this->reservation->add($temp_data);
			$send_data = array();
			$send_data["name"] = $temp_data["name"];
			$send_data["surname"] = $temp_data["surname"];
			$send_data["patronymic"] = $temp_data["patronymic"];
			$send_data["year_born"] = $temp_data["year_born"];
			$send_data["sezon"] = $temp_data["sezon"];
			$send_data["email"] = $temp_data["email"];
			$send_data["phone"] = $temp_data["phone"];
			$send_data["date"] = $temp_data["date"];
			$send_data["year"] = $this->getYear();
			$send_data["unic_number"] = mt_rand(1000, 9999);
			$this->mail->send($send_data["email"], $send_data, "RESERV");
			$this->mail->send($this->config->admemail, $send_data, "ADM_RESERV");
			$this->mail->send($this->config->admemail2, $send_data, "ADM_RESERV");
			return "success_reservation";
		}
		else return "error_reservation";
	}
	
	public function checkCaptcha($captcha) {
		if ($_SESSION["key"] == $captcha)  return "success_captcha";
		elseif ($captcha == "" || $_SESSION["key"] != $captcha) return "error_captcha";
	}
	
	public function send() {
		$send_data = array();
		$send_data["name"] = $this->data["name"];
		$send_data["email"] = $this->data["email"];
		$send_data["subject"] = $this->data["subject"];
		$send_data["text"] = $this->data["text"];
		$this->mail->send($this->config->admemail, $send_data, "QUEST", $send_data["email"]);
		$this->mail->send($this->config->admemail2, $send_data, "QUEST", $send_data["email"]);
		return "success_send";
	}

	
	public function vote() {
		$id = $this->data["vote_item"];
		$variant = $this->vote_variants->get($id);
		$vote_id = $variant["vote_id"];
		$this->vote_variants->setVotes($id, $variant["votes"] + 1);
		return $this->url->voteresult($vote_id);
	}
	
}
?>