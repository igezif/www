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
		$this->render($head, $this->renderData(array("admin_menu" => $admin_menu), "adminpanel"));
	}

	public function actionContacts() {
		if (!self::isAuthAdmin()) return null;
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$head->add("js", null, true);
		$head->js = array("/js/main.js", "/js/admin.js");
		$admin_menu = new Contactsadmin();
		$obj = new ContactsDB();
		$obj->load(1);
		$admin_menu->name = $obj->name;
		$admin_menu->ind = $obj->ind;
		$admin_menu->address = $obj->address;
		$admin_menu->phone = $obj->phone;
		$admin_menu->email = $obj->email;
		$admin_menu->inn = $obj->inn;
		$admin_menu->kpp = $obj->kpp;
		$admin_menu->bik = $obj->bik;
		$admin_menu->rs = $obj->rs;
		$admin_menu->bank = $obj->bank;
		$admin_menu->ks = $obj->ks;
		$admin_menu->okpo = $obj->okpo;
		$admin_menu->okato = $obj->okato;
		$admin_menu->ogrn = $obj->ogrn;
		$hornav = new Hornav();
		$hornav->addData("Админпанель", URL::get("menu", "admin"));
		$hornav->addData("Контактная информация и схема проезда");
		$this->render($head, $this->renderData(array("hornav" => $hornav, "admin_menu" => $admin_menu), "adminpanel"));
	}
	
	public function actionViewgallery() {
		if (!self::isAuthAdmin()) return null;
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$admin_menu = new Viewgalleryadmin();
		$admin_menu->items = ViewgalleryDB::getAdminShow();
		$admin_menu->link_insert = URL::get("insert", "admin", array("view" => "viewgallery"));
		$admin_menu->message = $this->fp->getSessionMessage("viewgallery");
		$hornav = new Hornav();
		$hornav->addData("Админпанель", URL::get("menu", "admin"));
		$hornav->addData("Галерея");
		$this->render($head, $this->renderData(array("hornav" => $hornav, "admin_menu" => $admin_menu), "adminpanel"));
	}

	public function actionListgallery(){
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$admin_menu = new Listgallery($this->request->view_id);
		$admin_menu->items = GalleryDB::getAdminShow($this->request->view_id);
		$admin_menu->link_insert = URL::get("insert", "admin", array("view" => "gallery"));
		$hornav = new Hornav();
		$viewgallery = new ViewgalleryDB();
		$viewgallery->load($this->request->view_id);
		$admin_menu->header = $viewgallery->title;
		$admin_menu->message = $this->fp->getSessionMessage($this->request->view);
		$hornav->addData("Админпанель", URL::get("menu", "admin"));
		$hornav->addData("Галерея", URL::get("viewgallery", "admin"));
		$hornav->addData($viewgallery->title);
		$this->render($head, $this->renderData(array("hornav" => $hornav, "admin_menu" => $admin_menu), "adminpanel"));
	}

	public function actionListimg(){
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$admin_menu = new Listimggallery();
		$admin_menu->link_insert = URL::get("insert", "admin", array("view" => "imggallery"));
		$admin_menu->items = ImggalleryDB::getAdminShow($this->request->id);
		$hornav = new Hornav();
		$gallery = new GalleryDB();
		$gallery->load($this->request->id);
		$viewgallery = new ViewgalleryDB();
		$viewgallery->load($gallery->view_id);
		$admin_menu->header = $gallery->title;
		$admin_menu->message = $this->fp->getSessionMessage($this->request->view);
		$hornav->addData("Админпанель", URL::get("menu", "admin"));
		$hornav->addData("Галерея", URL::get("viewgallery", "admin"));
		$hornav->addData($viewgallery->title, URL::get("listgallery", "admin", array("view_id" => $viewgallery->id)));
		$hornav->addData($gallery->title);
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
					$obj = $this->fp->process($this->request->view, $obj_db, array("category_id", array("img", $img), "brand_id", "price", "title", "meta_desc", "meta_key", ($this->request->available) ? "available" : array("available", 0)), array(), "SUCCESS_POSITION_INSERT");
					if ($obj instanceof ProductDB) $this->redirect(URL::get("product", "admin"));
					else $this->redirect(URL::current());
				}
			}
			else{
				$obj_db = new ProductDB();
				$obj = $this->fp->process($this->request->view, $obj_db, array("category_id", "brand_id", "price", "title", "meta_desc", "meta_key", ($this->request->available) ? "available" : array("available", 0)), array(), "SUCCESS_POSITION_INSERT");
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
					$obj = $this->fp->process($this->request->view, $obj_db, array("category_id", array("img", $img), "brand_id", "price", "title", "meta_desc", "meta_key", "available"), array(), "SUCCESS_POSITION_UPDATE");
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
				$obj = $this->fp->process($this->request->view, $obj_db, array("category_id", "brand_id", "price", "title", "meta_desc", "meta_key", "available"), array(), "SUCCESS_POSITION_UPDATE");
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
		}	
	}

	public function actionLogout() {
		AdminDB::logout();
		$this->redirect($_SERVER["HTTP_REFERER"]);
	}

}