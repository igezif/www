<?php

abstract class Controller extends AbstractController {
	
	protected $title;
	protected $meta_desc = false;
	protected $meta_key = false;
	protected $mail = null;
	protected $url_active;
	protected $link_search;
	protected $section_id = 0;
	
	public function __construct() {
		parent::__construct(new View(Config::DIR_TMPL), new Message(Config::FILE_MESSAGES));
		$this->mail = new Mail();
		$this->url_active = URL::deleteGET(URL::current(), "page");
	}
	
	public function action404() {
		header("HTTP/1.1 404 Not Found");
		header("Status: 404 Not Found");
		$this->title = "Страница не найдена - 404";
		$this->meta_desc = "Запрошенная страница не существует.";
		$this->meta_key = "страница не найдена, страница не существует, 404";
		$head = $this->getHead(array("/css/main.css"));
		$pm = new PageMessage();
		$pm->header = "Страница не найдена";
		$pm->text = "К сожалению, запрошенная страница не существует. Проверьте правильность ввода адреса.";
		$this->render($head, $pm);
	}
	
	protected function isAuthAdmin() {
		if (!$this->auth_admin) {
			$this->title = "Журнал посещаемости";
			$head = $this->getHead(array("/css/main.css"), false);
			$auth = new Adminauth();
			$auth->message = $this->fp->getSessionMessage("auth");
			$auth->link_register = URL::get("register", "");
			$auth->action = URL::current();
			$this->render($head, $auth);
		}
		else return true;
	}
	
	protected function accessDenied() {
		$this->title = "Доступ закрыт!";
		$this->meta_desc = "Доступ к данной странице закрыт.";
		$this->meta_key = "доступ закрыт, доступ закрыт страница, доступ закрыт страница 403";
		$head = $this->getHead(array("/css/main.css"));
		$pm = new PageMessage();
		$pm->header = "Доступ закрыт!";
		$pm->text = "У Вас нет прав доступа к данной странице.";
		$this->render($head, $pm);
	}
	
	final protected function render($head, $content) {
		$params = array();
		$params["head"] = $head;
		$params["uri"] = $this->url_active;
		$params["content"] = $content;
		$this->view->render(Config::LAYOUT, $params);
	}

	final protected function jsonResponse($array) {
		echo json_encode($array);
	}
	
	protected function getHead($css = false, $index = true) {
		$head = new Head();
		$head->title = $this->title;
		$head->meta("Content-Type", "text/html; charset=utf-8", true);
		if($this->meta_desc) $head->meta("description", $this->meta_desc, false);
		if($this->meta_key) $head->meta("keywords", $this->meta_key, false);
		$head->meta("viewport", "width=device-width", false);
		$head->meta("robots", ($index) ? "index, follow" : "noindex, nofollow", false);
		$head->favicon = "img/main/favicon.ico";
		$head->css = $css;
		return $head;
	}
	
	protected function getFooter() {
		$footer = new Footer();
		return $footer;
	}
	
	protected function authAdmin() {
		$login = "";
		$password = "";
		$redirect = false;
		if ($this->request->auth) {
			$login = $this->request->login;
			$password = $this->request->password;
			$redirect = true;
		}
		$admin = $this->fp->auth("auth", "AdminDB", "authAdmin", $login, $password);
		if ($admin instanceof AdminDB) {
			//var_dump($redirect);die;
			//if ($redirect) $this->redirect(URL::current());
			return $admin;
		}
		return null;
	}
	
	protected function getHornav() {
		$hornav = new Hornav();
		$hornav->addData("Главная", URL::get(""));
		return $hornav;
	}
	
	final protected function getPagination($count_elements, $count_on_page, $url = false) {
		$count_pages = ceil($count_elements / $count_on_page);
		$active = $this->getPage();
		if (($active > $count_pages) && ($active > 1)) $this->notFound();
		$pagination = new Pagination();
		if (!$url) $url = URL::deletePage(URL::current());
		$pagination->url = $url;
		$pagination->url_page = URL::addTemplatePage($url);
		$pagination->count_elements = $count_elements;
		$pagination->count_on_page = $count_on_page;
		$pagination->count_show_pages = Config::COUNT_SHOW_PAGES;
		$pagination->active = $active;
		return $pagination;
	}

	final protected function getOffset($count_on_page) {
		return $count_on_page * ($this->getPage() - 1);
	}

	final protected function getPage() {
		$page = ($this->request->page)? $this->request->page: 1;
		if ($page < 1) $this->notFound();
		return $page;
	}

}