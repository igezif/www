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
		$admin_menu->items = BrandDB::getAdminShow();
		$admin_menu->link_insert = URL::get("insert", "admin", array("view" => "brand"));
		$admin_menu->message = $this->fp->getSessionMessage("brand");
		$hornav = new Hornav();
		$hornav->addData("Админпанель", URL::get("menu", "admin"));
		$hornav->addData("Бренды");
		$this->render($head, $this->renderData(array("hornav" => $hornav, "admin_menu" => $admin_menu), "admin_panel"));
	}
	
	public function actionSlider() {
		if (!self::isAuthAdmin()) return null;
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$admin_menu = new Slideradmin();
		$admin_menu->items = SliderDB::getAdminShow();
		$admin_menu->link_insert = URL::get("insert", "admin", array("view" => "slider"));
		$admin_menu->message = $this->fp->getSessionMessage("slider");
		$hornav = new Hornav();
		$hornav->addData("Админпанель", URL::get("menu", "admin"));
		$hornav->addData("Слайдер на главной странице");
		$this->render($head, $this->renderData(array("hornav" => $hornav, "admin_menu" => $admin_menu), "admin_panel"));
	}
	
	public function actionCategory() {
		if (!self::isAuthAdmin()) return null;
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$admin_menu = new Categoryadmin();
	}
	
	public function actionInsert() {
		if (!self::isAuthAdmin()) return null;
		if ($this->request->insert_brand) {
			$img = $this->fp->uploadIMG($this->request->view, $_FILES["img"], Config::MAX_SIZE_IMG, Config::DIR_IMG_BRAND);
			if ($img) {
				$brand_db = new BrandDB();
				$obj = $this->fp->process($this->request->view, $brand_db, array("title", "meta_desc", "meta_key", array("img", $img)), array(), "SUCCESS_POSITION_INSERT");
				if ($obj instanceof BrandDB) $this->redirect(URL::get("brand", "admin"));
				else $this->redirect(URL::current());
			}
		}
		else if ($this->request->insert_slider) {
			
		}
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$class = "Form".$this->request->view;
		$admin_menu = new $class();
		$admin_menu->message = $this->fp->getSessionMessage($this->request->view);
		$hornav = new Hornav();
		$hornav->addData("Админпанель", URL::get("menu", "admin"));
		$hornav->addData($this->request->view, URL::get($this->request->view, "admin"));
		$hornav->addData("Добавить");
		$this->render($head, $this->renderData(array("hornav" => $hornav, "admin_menu" => $admin_menu), "admin_panel"));
	}
	
	public function actionUpdate() {
		if (!self::isAuthAdmin()) return null;
		if ($this->request->update_brand) {
			$img = $this->fp->uploadIMG($this->request->view, $_FILES["img"], Config::MAX_SIZE_IMG, Config::DIR_IMG_BRAND);
			if ($img) {
				$brand_db = new BrandDB();
				$brand_db->load($this->request->id);
				$tmp = $brand_db->imageName;
				$obj = $this->fp->process($this->request->view, $brand_db, array("title", "meta_desc", "meta_key", array("img", $img)), array(), "SUCCESS_POSITION_UPDATE");
				if ($obj instanceof BrandDB){
					if ($tmp) File::delete(Config::DIR_IMG_BRAND.$tmp);
					$this->redirect(URL::get("brand", "admin"));		
				}
				else $this->redirect(URL::current());
			}
		}
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$class = "Form".$this->request->view;
		$admin_menu = new $class($this->request->id);
		$admin_menu->message = $this->fp->getSessionMessage($this->request->view);
		$hornav = new Hornav();
		$hornav->addData("Админпанель", URL::get("menu", "admin"));
		$hornav->addData($this->request->view, URL::get($this->request->view, "admin"));
		$hornav->addData("Изменить");
		$this->render($head, $this->renderData(array("hornav" => $hornav, "admin_menu" => $admin_menu), "admin_panel"));
	}
	
	public function actionDelete(){
		if (!self::isAuthAdmin()) return null;
		if($this->request->view == "brand"){
			try {
				$brand_db = new BrandDB();
				$brand_db->load($this->request->id);
				$tmp = $brand_db->imageName;
				if ($tmp) File::delete(Config::DIR_IMG_BRAND.$tmp);
				if($brand_db->delete()) $this->fp->setSessionMessage("brand", "SUCCESS_POSITION_DELETE");
				else $this->fp->setSessionMessage("brand", "NOTFOUND_POSITION");
			} catch (Exception $e) {
				$this->setSessionMessage("brand", $this->getError($e));
			}
		}
		$this->redirect(URL::get("brand", "admin"));
	}
	
	
	
	public function actionProduct() {
		
	}
	
	
	
	public function actionLogout() {
		AdminDB::logout();
		$this->redirect($_SERVER["HTTP_REFERER"]);
	}
	
}
