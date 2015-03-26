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
		$message_name = "brand";
		if ($this->request->insert_brand) {
			$message_name = "brand";
			$img = $this->fp->uploadIMG($message_name, $_FILES["img"], Config::MAX_SIZE_IMG, Config::DIR_IMG_BRAND);
			if ($img) {
				$brand_db = new BrandDB();
				$obj = $this->fp->process($message_name, $brand_db, array("name", array("img", $img)), array(), "SUCCESS_IMG_INSERT");
				if ($obj instanceof BrandDB) $this->redirect(URL::current());
			}
		}
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$class = "Form".$this->request->view;
		$admin_menu = new $class();
		$admin_menu->name = "form_brand";
		$admin_menu->enctype = "multipart/form-data";
		$admin_menu->action = URL::current();
		$admin_menu->text("name", "Название:");
		$admin_menu->file("img", "Картинка:");
		$admin_menu->submit("insert_brand", "Сохранить");
		
		$admin_menu->message = $this->fp->getSessionMessage($message_name);
		$admin_menu->addJSV("avatar", $this->jsv->avatar());
		$this->render($head, $this->renderData(array("admin_menu" => $admin_menu), "admin_panel"));
	}
	
	public function actionUpdate() {
		if (!self::isAuthAdmin()) return null;
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
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