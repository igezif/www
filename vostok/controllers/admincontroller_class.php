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
		$admin_menu->link_insert = URL::get("insert", "admin", array("view" => "listgallery", "view_id" => $this->request->view_id));
		$hornav = new Hornav();
		$viewgallery = new ViewgalleryDB();
		$viewgallery->load($this->request->view_id);
		$admin_menu->header = $viewgallery->title;
		$admin_menu->message = $this->fp->getSessionMessage("listgallery");
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
		$admin_menu->link_insert = URL::get("insert", "admin", array("view" => "imggallery", "view_id" => $this->request->view_id, "gallery_id" => $this->request->gallery_id));
		$admin_menu->items = ImggalleryDB::getAdminShow($this->request->view_id, $this->request->gallery_id);
		$hornav = new Hornav();
		$gallery = new GalleryDB();
		$gallery->load($this->request->gallery_id);
		$viewgallery = new ViewgalleryDB();
		$viewgallery->load($gallery->view_id);
		$admin_menu->header = $gallery->title;
		$admin_menu->message = $this->fp->getSessionMessage("imggallery");
		$hornav->addData("Админпанель", URL::get("menu", "admin"));
		$hornav->addData("Галерея", URL::get("viewgallery", "admin"));
		$hornav->addData($viewgallery->title, URL::get("listgallery", "admin", array("view_id" => $viewgallery->id)));
		$hornav->addData($gallery->title);
		$this->render($head, $this->renderData(array("hornav" => $hornav, "admin_menu" => $admin_menu), "adminpanel"));
	}
	
	public function actionInsert() {
		if (!self::isAuthAdmin()) return null;
		if ($this->request->insert_viewgallery) {
			$this->request->setRequestOnSession();
			$image_name = $this->fp->checkIMG($this->request->view, $_FILES["img"], Config::MAX_SIZE_IMG);
			if($image_name) {
				$obj_db = new ViewgalleryDB();
				$obj = $this->fp->process($this->request->view, $obj_db, array(array("img", $image_name), "title", "meta_desc", "meta_key"), array(), "SUCCESS_POSITION_INSERT");
				if($obj) $this->fp->uploadIMG($this->request->view, $_FILES["img"], $image_name, Config::DIR_IMG_VIEWGALLERY);
				if ($obj instanceof ViewgalleryDB){
					$this->redirect(URL::get("viewgallery", "admin"));
				}
				else $this->redirect(URL::current());
			}
		}
		if ($this->request->insert_listgallery) {
			$this->request->setRequestOnSession();
			$image_name = $this->fp->checkIMG($this->request->view, $_FILES["img"], Config::MAX_SIZE_IMG);
			if($image_name) {
				$obj_db = new GalleryDB();
				$obj = $this->fp->process($this->request->view, $obj_db, array(array("view_id", $this->request->view_id), array("img", $image_name), "title", "meta_desc", "meta_key"), array(), "SUCCESS_POSITION_INSERT");
				if($obj) $this->fp->uploadIMG($this->request->view, $_FILES["img"], $image_name, Config::DIR_IMG_GALLERY);
				if ($obj instanceof GalleryDB){
					$this->redirect(URL::get("listgallery", "admin", array("view_id" => $this->request->view_id)));
				}
				else $this->redirect(URL::current());
			}
		}
		if ($this->request->insert_imggallery) {
			$this->request->setRequestOnSession();
			$image_name = $this->fp->checkIMG($this->request->view, $_FILES["img"], Config::MAX_SIZE_IMG);
			if($image_name) {
				$obj_db = new ImggalleryDB();
				$obj = $this->fp->process($this->request->view, $obj_db, array(array("gallery_id", $this->request->gallery_id), array("img", $image_name)), array(), "SUCCESS_POSITION_INSERT");
				if($obj) $this->fp->uploadIMG($this->request->view, $_FILES["img"], $image_name, Config::DIR_IMG_IMGGALLERY);
				if ($obj instanceof ImggalleryDB){
					$this->redirect(URL::get("listimg", "admin", array("view_id" => $this->request->view_id, "gallery_id" => $this->request->gallery_id), false));
				}
				else $this->redirect(URL::current());
			}
		}
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$head->add("js", null, true);
		$head->js = array("/js/admin.js");
		$class = "Form".$this->request->view;
		$param = $this->getParam();
		$content = new $class($this->request->view, $param);
		$content->message = $this->fp->getSessionMessage($this->request->view);
		$this->render($head, $content);
	}

	private function getParam(){
		$result = array();
		if(isset($_REQUEST["view_id"])) $result["view_id"] = $this->request->view_id;
		else $result["view_id"] = false;
		if(isset($_REQUEST["gallery_id"])) $result["gallery_id"] = $this->request->gallery_id;
		else $result["gallery_id"] = false;
		if(isset($_REQUEST["img_id"])) $result["img_id"] = $this->request->img_id;
		else $result["img_id"] = false;
		return $result;
	}
	
	public function actionUpdate() {
		if (!self::isAuthAdmin()) return null;
		if ($this->request->update_viewgallery) {
			$this->request->setRequestOnSession();
			$image_name = $this->fp->checkIMG($this->request->view, $_FILES["img"], Config::MAX_SIZE_IMG);
			$obj_db = new ViewgalleryDB();
			$obj_db->load($this->request->id);
			if($image_name) {
				$obj = $this->fp->process($this->request->view, $obj_db, array(array("img", $image_name), "title", "meta_desc", "meta_key"), array(), "SUCCESS_POSITION_UPDATE");
				if($obj) $this->fp->uploadIMG($this->request->view, $_FILES["img"], $image_name, Config::DIR_IMG_VIEWGALLERY);
				if ($obj instanceof ViewgalleryDB) $this->redirect(URL::get("viewgallery", "admin"));
				else $this->redirect(URL::current());
			}
			else{
				$obj = $this->fp->process($this->request->view, $obj_db, array("title", "meta_desc", "meta_key"), array(), "SUCCESS_POSITION_UPDATE");
				if ($obj instanceof ViewgalleryDB) $this->redirect(URL::get("viewgallery", "admin"));
				else $this->redirect(URL::current());
			}
		}
		if ($this->request->update_listgallery) {
			$this->request->setRequestOnSession();
			$image_name = $this->fp->checkIMG($this->request->view, $_FILES["img"], Config::MAX_SIZE_IMG);
			$obj_db = new GalleryDB();
			$obj_db->load($this->request->id);
			if($image_name) {
				$obj = $this->fp->process($this->request->view, $obj_db, array(array("img", $image_name), "title", "meta_desc", "meta_key"), array(), "SUCCESS_POSITION_UPDATE");
				if($obj) $this->fp->uploadIMG($this->request->view, $_FILES["img"], $image_name, Config::DIR_IMG_GALLERY);
				if ($obj instanceof GalleryDB){
					$this->redirect(URL::get("listgallery", "admin", array("view_id" => $this->request->view_id)));
				}
				else $this->redirect(URL::current());
			}
			else{
				$obj = $this->fp->process($this->request->view, $obj_db, array("title", "meta_desc", "meta_key"), array(), "SUCCESS_POSITION_UPDATE");
				if ($obj instanceof GalleryDB){
					$this->redirect(URL::get("listgallery", "admin", array("view_id" => $this->request->view_id)));
				}
				else $this->redirect(URL::current());
			}
		}
		if ($this->request->update_imggallery) {
			$this->request->setRequestOnSession();
			$image_name = $this->fp->checkIMG($this->request->view, $_FILES["img"], Config::MAX_SIZE_IMG);
			if($image_name) {
				$obj_db = new ImggalleryDB();
				$obj_db->load($this->request->img_id);
				$obj = $this->fp->process($this->request->view, $obj_db, array(array("gallery_id", $this->request->gallery_id), array("img", $image_name)), array(), "SUCCESS_POSITION_UPDATE");
				if($obj) $this->fp->uploadIMG($this->request->view, $_FILES["img"], $image_name, Config::DIR_IMG_IMGGALLERY);
				if ($obj instanceof ImggalleryDB){
					$this->redirect(URL::get("listimg", "admin", array("view_id" => $this->request->view_id, "gallery_id" => $this->request->gallery_id), false));
				}
				else $this->redirect(URL::current());
			}
		}
		$this->title = "Админ панель";
		$this->meta_desc = "Админ панель";
		$this->meta_key = "админ панель";
		$head = $this->getHead(array("/css/main.css"), false);
		$head->add("js", null, true);
		$head->js = array("/js/admin.js");
		$class = "Form".$this->request->view;
		$param = $this->getParam();
		$content = new $class($this->request->view, $param);
		$content->message = $this->fp->getSessionMessage($this->request->view);
		$this->render($head, $content);
	}
	
	public function actionDelete(){
		if (!self::isAuthAdmin()) return null;
		switch ($this->request->view) {
			case "viewgallery":
				try {
					$obj_db = new ViewgalleryDB();
					$obj_db->load($this->request->view_id);
					$tmp = $obj_db->img;
					if ($tmp) File::delete(Config::DIR_IMG_VIEWGALLERY.$tmp);
					if($obj_db->delete()) $this->fp->setSessionMessage($this->request->view, "SUCCESS_POSITION_DELETE");
					else $this->fp->setSessionMessage($this->request->view, "NOTFOUND_POSITION");
					$this->redirect(URL::get($this->request->view, "admin"));
				} catch (Exception $e) {
					$this->setSessionMessage($this->request->view, $this->getError($e));
				}
			break;
			case "listgallery":
				try {
					$obj_db = new GalleryDB();
					$obj_db->load($this->request->gallery_id);
					$tmp = $obj_db->img;
					if ($tmp) File::delete(Config::DIR_IMG_GALLERY.$tmp);
					if($obj_db->delete()) $this->fp->setSessionMessage("listgallery", "SUCCESS_POSITION_DELETE");
					else $this->fp->setSessionMessage("listgallery", "NOTFOUND_POSITION");
					$this->redirect(URL::get("listgallery", "admin", array("view_id" => $this->request->view_id)));
				} catch (Exception $e) {
					$this->setSessionMessage($this->request->view, $this->getError($e));
				}
			break;
			case "imggallery":
				try {
					$obj_db = new ImggalleryDB();
					$obj_db->load($this->request->img_id);
					$tmp = $obj_db->img;
					if ($tmp) File::delete(Config::DIR_IMG_IMGGALLERY.$tmp);
					if($obj_db->delete()) $this->fp->setSessionMessage("imggallery", "SUCCESS_POSITION_DELETE");
					else $this->fp->setSessionMessage("imggallery", "NOTFOUND_POSITION");
					$this->redirect(URL::get("listimg", "admin", array("view_id" => $this->request->view_id, "gallery_id" => $this->request->gallery_id), false));
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