<?php

class AdminController extends Controller {
	
	public function actionMenu() {
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		
		/* if ($this->auth_user) {
			$user_panel = new UserPanel();
			$user_panel->user = $this->auth_user;
			$user_panel->uri = $this->url_active;
			$user_panel->addItem("Редактировать профиль", URL::get("editprofile", "user"));
			$user_panel->addItem("Выход", URL::get("logout"));
		}
		//$sections = SectionsDB::getAllShow();
		$sections = new Sections();
		$slider = new Slider();
		$sections->items = array("1" => 1, "2" => 2, "3" => 3); 
		$this->render($this->renderData(array("slider" => $slider, "sections" => $sections), "adminpanel"));*/
		
		$head = $this->getHead(array("/css/main.css"), true);
		
		if ($this->auth_admin) $admin_menu = $this->getAdminMenu();
		else $admin_menu = $this->getAuthAdmin();
		
		
		
		//$this->render($head, $adminpanel);
		$this->render($head, $this->renderData(array("header" => "Администраторская панель", "admin_menu" => $admin_menu), "admin_panel"));
	}
	
}