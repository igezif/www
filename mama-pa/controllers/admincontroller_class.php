<?php

class AdminController extends Controller {
	
	private $names = array("brand" => "Бренды", "slider" => "Слайдер на главной странице", "section" => "Секции", "category" => "Категории", "product" => "Товары");
	
	public function actionMenu() {
		if (!self::isAuthAdmin()) return null;
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$admin_menu = new Adminmenu();
		$admin_menu->admin = $this->auth_admin;
		$this->render($head, $this->renderData(array("admin_menu" => $admin_menu), "adminpanel"));
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
		$this->render($head, $this->renderData(array("hornav" => $hornav, "admin_menu" => $admin_menu), "adminpanel"));
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
		$this->render($head, $this->renderData(array("hornav" => $hornav, "admin_menu" => $admin_menu), "adminpanel"));
	}
	
	public function actionSection() {
		if (!self::isAuthAdmin()) return null;
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$admin_menu = new Sectionadmin();
		$admin_menu->items = SectionDB::getAdminShow();
		$admin_menu->link_insert = URL::get("insert", "admin", array("view" => "section"));
		$admin_menu->message = $this->fp->getSessionMessage("section");
		$hornav = new Hornav();
		$hornav->addData("Админпанель", URL::get("menu", "admin"));
		$hornav->addData("Секции");
		$this->render($head, $this->renderData(array("hornav" => $hornav, "admin_menu" => $admin_menu), "adminpanel"));
	}
	
	public function actionCategory() {
		if (!self::isAuthAdmin()) return null;
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$admin_menu = new Categoryadmin();
		$admin_menu->items = CategoryDB::getAdminShow();
		$admin_menu->link_insert = URL::get("insert", "admin", array("view" => "category"));
		$admin_menu->message = $this->fp->getSessionMessage("category");
		$hornav = new Hornav();
		$hornav->addData("Админпанель", URL::get("menu", "admin"));
		$hornav->addData("Категории товаров");
		$this->render($head, $this->renderData(array("hornav" => $hornav, "admin_menu" => $admin_menu), "adminpanel"));
	}
	
	public function actionProduct() {
		if (!self::isAuthAdmin()) return null;
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$admin_menu = new Productadmin();
		$admin_menu->items = ProductDB::getAdminShow();
		$admin_menu->link_insert = URL::get("insert", "admin", array("view" => "product"));
		$admin_menu->message = $this->fp->getSessionMessage("product");
		$hornav = new Hornav();
		$hornav->addData("Админпанель", URL::get("menu", "admin"));
		$hornav->addData("Товары");
		$this->render($head, $this->renderData(array("hornav" => $hornav, "admin_menu" => $admin_menu), "adminpanel"));
	}
	
	public function actionInsert() {
		if (!self::isAuthAdmin()) return null;
		if ($this->request->insert_brand) {
			$img = $this->fp->uploadIMG($this->request->view, $_FILES["img"], Config::MAX_SIZE_IMG, Config::DIR_IMG_BRAND);
			if ($img) {
				$obj_db = new BrandDB();
				$obj = $this->fp->process($this->request->view, $obj_db, array("title", "meta_desc", "meta_key", array("img", $img)), array(), "SUCCESS_POSITION_INSERT");
				if ($obj instanceof BrandDB) $this->redirect(URL::get("brand", "admin"));
				else $this->redirect(URL::current());
			}
		}
		else if($this->request->insert_product){
			if(isset($_FILES["img"])){
				$img = $this->fp->uploadIMG($this->request->view, $_FILES["img"], Config::MAX_SIZE_IMG, Config::DIR_IMG_PRODUCT);
				if ($img) {
					$obj_db = new ProductDB();
					$obj = $this->fp->process($this->request->view, $obj_db, array("category_id", array("img", $img), "brand_id", "price", "title", "product_description", "meta_desc", "meta_key", ($this->request->available) ? "available" : array("available", 0)), array(), "SUCCESS_POSITION_INSERT");
					if ($obj instanceof ProductDB) $this->redirect(URL::get("product", "admin"));
					else $this->redirect(URL::current());
				}
			}
			else{
				$obj_db = new ProductDB();
				$obj = $this->fp->process($this->request->view, $obj_db, array("category_id", "brand_id", "price", "title", "product_description", "meta_desc", "meta_key", ($this->request->available) ? "available" : array("available", 0)), array(), "SUCCESS_POSITION_INSERT");
				if ($obj instanceof ProductDB)$this->redirect(URL::get("product", "admin"));
				else $this->redirect(URL::current());
			}
		}
		else if ($this->request->insert_slider) {
			$obj_db = new SliderDB();
			$obj = $this->fp->process($this->request->view, $obj_db, array("product_id", "title", "description"), array(), "SUCCESS_POSITION_INSERT");
			if ($obj instanceof SliderDB) $this->redirect(URL::get("slider", "admin"));
			else $this->redirect(URL::current());
		}
		else if ($this->request->insert_section) {
			$obj_db = new SectionDB();
			$obj = $this->fp->process($this->request->view, $obj_db, array("title", "meta_desc", "meta_key"), array(), "SUCCESS_POSITION_INSERT");
			if ($obj instanceof SectionDB) $this->redirect(URL::get("section", "admin"));
			else $this->redirect(URL::current());
		}
		else if ($this->request->insert_category) {
			$obj_db = new CategoryDB();
			$obj = $this->fp->process($this->request->view, $obj_db, array("section_id", "title", "meta_desc", "meta_key"), array(), "SUCCESS_POSITION_INSERT");
			if ($obj instanceof CategoryDB) $this->redirect(URL::get("category", "admin"));
			else $this->redirect(URL::current());
		}
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$head->add("js", null, true);
		$head->js = array("/js/admin.js");
		$class = "Form".$this->request->view;
		$admin_menu = new $class();
		$admin_menu->message = $this->fp->getSessionMessage($this->request->view);
		$hornav = new Hornav();
		$hornav->addData("Админпанель", URL::get("menu", "admin"));
		$name = $this->names[$this->request->view];
		$hornav->addData($name, URL::get($this->request->view, "admin"));
		$hornav->addData("Добавить");
		$this->render($head, $this->renderData(array("hornav" => $hornav, "admin_menu" => $admin_menu), "adminpanel"));
	}
	
	public function actionUpdate() {
		if (!self::isAuthAdmin()) return null;
		if ($this->request->update_brand) {
			$img = $this->fp->uploadIMG($this->request->view, $_FILES["img"], Config::MAX_SIZE_IMG, Config::DIR_IMG_BRAND);
			if ($img) {
				$obj_db = new BrandDB();
				$obj_db->load($this->request->id);
				$tmp = $obj_db->imageName;
				$obj = $this->fp->process($this->request->view, $obj_db, array("title", "meta_desc", "meta_key", array("img", $img)), array(), "SUCCESS_POSITION_UPDATE");
				if ($obj instanceof BrandDB){
					if ($tmp) File::delete(Config::DIR_IMG_BRAND.$tmp);
					$this->redirect(URL::get("brand", "admin"));		
				}
				else $this->redirect(URL::current());
			}
		}
		else if($this->request->update_product){
			if(isset($_FILES["img"])){
				$img = $this->fp->uploadIMG($this->request->view, $_FILES["img"], Config::MAX_SIZE_IMG, Config::DIR_IMG_PRODUCT);
				if ($img) {
					$obj_db = new ProductDB();
					$obj_db->load($this->request->id);
					$tmp = $obj_db->imageName;
					$obj = $this->fp->process($this->request->view, $obj_db, array("category_id", array("img", $img), "brand_id", "price", "title", "product_description", "meta_desc", "meta_key", "available"), array(), "SUCCESS_POSITION_UPDATE");
					if ($obj instanceof ProductDB){
						if ($tmp) File::delete(Config::DIR_IMG_PRODUCT.$tmp);
						$this->redirect(URL::get("product", "admin"));		
					}
					else $this->redirect(URL::current());
				}
			}
			else{
				$obj_db = new ProductDB();
				$obj_db->load($this->request->id);
				$obj = $this->fp->process($this->request->view, $obj_db, array("category_id", "brand_id", "price", "title", "product_description", "meta_desc", "meta_key", "available"), array(), "SUCCESS_POSITION_UPDATE");
				if ($obj instanceof ProductDB)$this->redirect(URL::get("product", "admin"));
				else $this->redirect(URL::current());
			}
		}
		else if($this->request->update_slider){
			$obj_db = new SliderDB();
			$obj_db->load($this->request->id);
			$obj = $this->fp->process($this->request->view, $obj_db, array("product_id", "title", "description"), array(), "SUCCESS_POSITION_UPDATE");
			if ($obj instanceof SliderDB) $this->redirect(URL::get("slider", "admin"));
			else $this->redirect(URL::current());
		}
		else if($this->request->update_section){
			$obj_db = new SectionDB();
			$obj_db->load($this->request->id);
			$obj = $this->fp->process($this->request->view, $obj_db, array("title", "meta_desc", "meta_key"), array(), "SUCCESS_POSITION_UPDATE");
			if ($obj instanceof SectionDB) $this->redirect(URL::get("section", "admin"));
			else $this->redirect(URL::current());
		}
		else if($this->request->update_category){
			$obj_db = new CategoryDB();
			$obj_db->load($this->request->id);
			$obj = $this->fp->process($this->request->view, $obj_db, array("section_id", "title", "meta_desc", "meta_key"), array(), "SUCCESS_POSITION_UPDATE");
			if ($obj instanceof CategoryDB) $this->redirect(URL::get("category", "admin"));
			else $this->redirect(URL::current());
		}
		else if($this->request->upload_small_img) {
			$img = $this->fp->uploadIMG($this->request->view, $_FILES["small_img"], Config::MAX_SIZE_IMG, Config::DIR_IMG_FSAPRODUCT);
			if ($img) {
				$obj_db = new ImgDB();
				$obj = $this->fp->process($this->request->view, $obj_db, array(array("product_id", $this->request->id), array("url", $img)), array(), "SUCCESS_POSITION_INSERT");
				$this->redirect(URL::current());
			}
		}
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$head->add("js", null, true);
		$head->js = array("/js/admin.js");
		$class = "Form".$this->request->view;
		$admin_menu = new $class($this->request->id);
		$admin_menu->message = $this->fp->getSessionMessage($this->request->view);
		$hornav = new Hornav();
		$hornav->addData("Админпанель", URL::get("menu", "admin"));
		$name = $this->names[$this->request->view];
		$hornav->addData($name, URL::get($this->request->view, "admin"));
		$hornav->addData("Изменить");
		$this->render($head, $this->renderData(array("hornav" => $hornav, "admin_menu" => $admin_menu), "adminpanel"));
	}
	
	public function actionDelete(){
		if (!self::isAuthAdmin()) return null;
		switch ($this->request->view) {
			case "brand":
				try {
					$obj_db = new BrandDB();
					$obj_db->load($this->request->id);
					$tmp = $obj_db->imageName;
					if ($tmp) File::delete(Config::DIR_IMG_BRAND.$tmp);
					if($obj_db->delete()) $this->fp->setSessionMessage($this->request->view, "SUCCESS_POSITION_DELETE");
					else $this->fp->setSessionMessage($this->request->view, "NOTFOUND_POSITION");
					$this->redirect(URL::get($this->request->view, "admin"));
				} catch (Exception $e) {
					$this->setSessionMessage($this->request->view, $this->getError($e));
				}
			break;
			case "product":
				try {
					$obj_db = new ProductDB();
					$obj_db->load($this->request->id);
					$tmp = $obj_db->imageName;
					if ($tmp) File::delete(Config::DIR_IMG_PRODUCT.$tmp);
					if($obj_db->delete()) $this->fp->setSessionMessage($this->request->view, "SUCCESS_POSITION_DELETE");
					else $this->fp->setSessionMessage($this->request->view, "NOTFOUND_POSITION");
					$this->redirect(URL::get($this->request->view, "admin"));
				} catch (Exception $e) {
					$this->setSessionMessage($this->request->view, $this->getError($e));
				}
			break;
			case "slider":
				try {
					$obj_db = new SliderDB();
					$obj_db->load($this->request->id);
					if($obj_db->delete()) $this->fp->setSessionMessage($this->request->view, "SUCCESS_POSITION_DELETE");
					else $this->fp->setSessionMessage($this->request->view, "NOTFOUND_POSITION");
					$this->redirect(URL::get($this->request->view, "admin"));
				} catch (Exception $e) {
					$this->setSessionMessage($this->request->view, $this->getError($e));
				}
			break;
			case "section":
				try {
					$obj_db = new SectionDB();
					$obj_db->load($this->request->id);
					if($obj_db->delete()) $this->fp->setSessionMessage($this->request->view, "SUCCESS_POSITION_DELETE");
					else $this->fp->setSessionMessage($this->request->view, "NOTFOUND_POSITION");
					$this->redirect(URL::get($this->request->view, "admin"));
				} catch (Exception $e) {
					$this->setSessionMessage($this->request->view, $this->getError($e));
				}
			break;
			case "category":
				try {
					$obj_db = new CategoryDB();
					$obj_db->load($this->request->id);
					if($obj_db->delete()) $this->fp->setSessionMessage($this->request->view, "SUCCESS_POSITION_DELETE");
					else $this->fp->setSessionMessage($this->request->view, "NOTFOUND_POSITION");
					$this->redirect(URL::get($this->request->view, "admin"));
				} catch (Exception $e) {
					$this->setSessionMessage($this->request->view, $this->getError($e));
				}
			break;
			case "dop_foto":
				try {
					$obj_db = new ImgDB();
					$obj_db->load($this->request->id);
					File::delete($obj_db->url);
					if($obj_db->delete()) $this->fp->setSessionMessage("product", "SUCCESS_POSITION_DELETE");
					else $this->fp->setSessionMessage($this->request->view, "NOTFOUND_POSITION");
					$this->redirect(URL::referer());
				} catch (Exception $e) {
					$this->setSessionMessage($this->request->view, $this->getError($e));
				}
			break;
		}	
	}

	public function actionLogout() {
		AdminDB::logout();
		$this->redirect($_SERVER["HTTP_REFERER"]);
	}

}