<?php

class AdminController extends Controller {
	
	public function actionMenu() {
		if (!self::isAuthAdmin()) return null;
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$admin_menu = new Adminmenu();
		$admin_menu->admin = $this->auth_admin;
		$this->render($head, $this->renderData(array("admin_menu" => $admin_menu), "admin_panel"));
	}
	
	public function actionBrand() {
		if (!self::isAuthAdmin()) return null;
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$admin_menu = new Brandadmin();
		$admin_menu->items = BrandDB::getAdminBrandShow();
		$admin_menu->link_insert = URL::get("insert", "admin", array("view" => "brand"));
		$this->render($head, $this->renderData(array("admin_menu" => $admin_menu), "admin_panel"));
	}
	
	public function actionInsert() {
		if (!self::isAuthAdmin()) return null;
		
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