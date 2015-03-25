<?php

abstract class Controller extends AbstractController {
	
	protected $title;
	protected $meta_desc;
	protected $meta_key;
	protected $mail = null;
	protected $url_active;
	protected $link_search;
	protected $section_id = 0;
	
	public function __construct() {
		parent::__construct(new View(Config::DIR_TMPL), new Message(Config::FILE_MESSAGES));
		$this->mail = new Mail();
		$this->url_active = URL::deleteGET(URL::current(), "page");
		$this->link_search = URL::get("search");
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
			$this->title = "Админ панель";
			$this->meta_desc = "Админ панель";
			$this->meta_key = "админ панель";
			$head = $this->getHead(array("/css/main.css"), false);
			$auth = new Authadmin();
			$auth->message = $this->fp->getSessionMessage("auth");
			$auth->action = URL::current("", true);
			$this->render($head, $this->renderData(array("admin_menu" => $auth), "admin_panel"));
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
		$params["header"] = $this->getHeader();
		$params["content"] = $content;
		$params["footer"] = $this->getFooter();
		$this->view->render(Config::LAYOUT, $params);
	}
	
	protected function getHead($css = false, $index = false) {
		$head = new Head();
		$head->title = $this->title;
		$head->meta("Content-Type", "text/html; charset=utf-8", true);
		$head->meta("description", $this->meta_desc, false);
		$head->meta("keywords", $this->meta_key, false);
		$head->meta("viewport", "width=device-width", false);
		$head->meta("robots", ($index) ? "index, follow" : "noindex, nofollow", false);
		$head->favicon = "/favicon.ico";
		$head->css = $css;
		return $head;
	}
	
	protected function getHeader() {
		$header = new Header();
		$header->uri = $this->url_active;
		$header->link_search = $this->link_search;
		return $header;
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
			if ($redirect) $this->redirect(URL::current());
			return $admin;
		}
		return null;
	}
	
	
	
	/*
	
	protected function authUser() {
		$login = "";
		$password = "";
		$redirect = false;
		if ($this->request->auth) {
			$login = $this->request->login;
			$password = $this->request->password;
			$redirect = true;
		}
		$user = $this->fp->auth("auth", "UserDB", "authUser", $login, $password);
		if ($user instanceof UserDB) {
			if ($redirect) $this->redirect(URL::current());
			return $user;
		}
		return null;
	}
	
	 protected function getLeft() {
		$items = MenuDB::getMainMenu();
		$mainmenu = new MainMenu();
		$mainmenu->uri = $this->url_active;
		$mainmenu->items = $items;
		if ($this->auth_user) {
			$user_panel = new UserPanel();
			$user_panel->user = $this->auth_user;
			$user_panel->uri = $this->url_active;
			$user_panel->addItem("Редактировать профиль", URL::get("editprofile", "user"));
			$user_panel->addItem("Выход", URL::get("logout"));
		}
		else $user_panel = "";
		$poll_db = new PollDB();
		$poll_db->loadRandom();
		if ($poll_db->isSaved()) {
			$poll = new Poll();
			$poll->action = URL::get("poll", "", array("id" => $poll_db->id));
			$poll->title = $poll_db->title;
			$poll->data = PollDataDB::getAllOnPollID($poll_db->id);
		}
		else $poll = "";
		return $user_panel.$mainmenu.$poll;
	}
	
	protected function getRight() {
		$course_db_1 = new CourseDB();
		$course_db_1->loadOnSectionID($this->section_id, FREE_COURSE);
		$course_db_2 = new CourseDB();
		$course_db_2->loadOnSectionID($this->section_id, ONLINE_COURSE);
		$courses = array($course_db_1, $course_db_2);
		
		$course = new Course();
		$course->courses = $courses;
		$course->auth_user = $this->auth_user;
		
		$quote_db = new QuoteDB();
		$quote_db->loadRandom();
		
		$quote = new Quote();
		$quote->quote = $quote_db;
		return $course.$quote;
		
	}
	
	protected function getHornav() {
		$hornav = new Hornav();
		$hornav->addData("Главная", URL::get(""));
		return $hornav;
	}
	final protected function getOffset($count_on_page) {
		return $count_on_page * ($this->getPage() - 1);
	}
	
	final protected function getPage() {
		$page = ($this->request->page)? $this->request->page: 1;
		if ($page < 1) $this->notFound();
		return $page;
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
	
	protected function authUser() {
		$login = "";
		$password = "";
		$redirect = false;
		if ($this->request->auth) {
			$login = $this->request->login;
			$password = $this->request->password;
			$redirect = true;
		}
		$user = $this->fp->auth("auth", "UserDB", "authUser", $login, $password);
		if ($user instanceof UserDB) {
			if ($redirect) $this->redirect(URL::current());
			return $user;
		}
		return null;
	}
	 */
	
}