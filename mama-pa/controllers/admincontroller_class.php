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
		$admin_menu->message = $this->fp->getSessionMessage("brand");
		$this->render($head, $this->renderData(array("admin_menu" => $admin_menu), "admin_panel"));
	}
	
	public function actionInsert() {
		if (!self::isAuthAdmin()) return null;
		if ($this->request->insert_brand) {
			$img = $this->fp->uploadIMG($this->request->view, $_FILES["img"], Config::MAX_SIZE_IMG, Config::DIR_IMG_BRAND);
			if ($img) {
				$brand_db = new BrandDB();
				$obj = $this->fp->process($this->request->view, $brand_db, array("name", array("img", $img)), array(), "SUCCESS_POSITION_INSERT");
				if ($obj instanceof BrandDB) $this->redirect(URL::get("brand", "admin"));
				else $this->redirect(URL::current());
			}
		}
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$class = "Form".$this->request->view;
		$admin_menu = new $class();
		$admin_menu->message = $this->fp->getSessionMessage($this->request->view);
		$this->render($head, $this->renderData(array("admin_menu" => $admin_menu), "admin_panel"));
	}
	
	public function actionUpdate() {
		if (!self::isAuthAdmin()) return null;
		if ($this->request->update_brand) {
			$img = $this->fp->uploadIMG($this->request->view, $_FILES["img"], Config::MAX_SIZE_IMG, Config::DIR_IMG_BRAND);
			if ($img) {
				$brand_db = new BrandDB();
				$brand_db->load($this->request->id);
				$tmp = $brand_db->imageName;
				$obj = $this->fp->process($this->request->view, $brand_db, array("name", array("img", $img)), array(), "SUCCESS_POSITION_UPDATE");
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
		$this->render($head, $this->renderData(array("admin_menu" => $admin_menu), "admin_panel"));
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