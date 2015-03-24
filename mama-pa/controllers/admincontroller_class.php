<?php

class AdminController extends Controller {
	
	public function actionMenu() {
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		if ($this->auth_admin) {
			$admin_menu = $this->getAdminMenu();
			$this->render($head, $this->renderData(array("admin_menu" => $admin_menu), "admin_panel"));
		}
		else $this->renderAuthAdmin();
	}
	
	public function actionBrand() {
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		if ($this->auth_admin) {
			$head = $this->getHead(array("/css/main.css"), false);
			$admin_menu = new Brandadmin();
			$admin_menu->items = BrandDB::getAdminBrandShow();
			$this->render($head, $this->renderData(array("admin_menu" => $admin_menu), "admin_panel"));
		}
		else $this->renderAuthAdmin();
	}
	
	public function actionCategory() {
		
	}
	
	public function actionProduct() {
		
	}
	
	public function actionSlider() {
		
	}
	
	public function actionLogout() {
		AdminDB::logout();
		$this->redirect($_SERVER["HTTP_REFERER"]);
	}
	
}