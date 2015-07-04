<?php

class MainController extends Controller {

	public function actionIndex() {
		if (!self::isAuthAdmin()) return null;
		$this->title = "Журнал посещаемости";
		$head = $this->getHead(array("/css/main.css"));
		$head->add("js", null, true);
		$head->js = array("/js/main.js");
		$content = new Adminmenu();
		$content->admin = $this->auth_admin;
		$this->render($head, $content);
	}

	public function actionRegister() {
		$message_name = "register";
		if ($this->request->register) {
			$user_old_1 = new AdminDB();
			$user_old_1->loadOnEmail($this->request->email);
			$user_old_2 = new AdminDB();
			$user_old_2->loadOnLogin($this->request->login);
			$checks[] = array($this->request->password, $this->request->password_conf, "ERROR_PASSWORD_CONF");
			$checks[] = array($user_old_1->isSaved(), false, "ERROR_EMAIL_ALREADY_EXISTS");
			$checks[] = array($user_old_2->isSaved(), false, "ERROR_LOGIN_ALREADY_EXISTS");
			$user = new AdminDB();
			$fields = array("name", "login", "email", array("setPassword()", $this->request->password));
			$res = $this->fp->process($message_name, $user, $fields, $checks);
			$user = $res["obj"];
			if ($user instanceof AdminDB) {
				$this->mail->send($user->email, array("user" => $user, "link" => URL::get("activate", "", array("login" => $user->login, "key" => $user->activation), false, Config::ADDRESS, false)), $message_name);
				$this->redirect(URL::get("sregister"));
			}
		}
		$this->title = "Регистрация";
		$head = $this->getHead(array("/css/main.css"));
		$hornav = $this->getHornav();
		$hornav->addData("Регистрация");
		$form = new Formregister();
		$form->hornav = $hornav;
		$form->name = "register";
		$form->action = URL::current();
		$form->method = "POST";
		$form->message = $this->fp->getSessionMessage($message_name);
		$form->text("name", "ФИО", $this->request->name);
		$form->text("login", "Логин", $this->request->login);
		$form->text("email", "E-mail", $this->request->email);
		$form->password("password", "Пароль");
		$form->password("password_conf", "Подтвердите пароль");
		$form->submit("register", "Регистрация");
		$this->render($head, $form);
	}

	public function actionSRegister() {
		$this->title = "Регистрация";
		$head = $this->getHead(array("/css/main.css"));
		$hornav = $this->getHornav();
		$hornav->addData("Регистрация");
		$pm = new PageMessage();
		$pm->hornav = $hornav;
		$pm->header = "Регистрация";
		$pm->text = "Учётная запись создана. На указанный Вами адрес электронной почты отправлено письмо с инструкцией по активации.";
		$this->render($head, $pm);
	}

	public function actionActivate() {
		$user_db = new AdminDB();
		$user_db->loadOnLogin($this->request->login);
		$hornav = $this->getHornav();
		if ($user_db->isSaved() && ($user_db->activation == "")) {
			$this->title = "Ваш аккаунт уже активирован";
			$this->meta_desc = "Вы можете войти в свой аккаунт, используя Ваши логин и пароль.";
			$this->meta_key = "активация, успешная активация, успешная активация регистрация";
			$hornav->addData("Активация");
		}
		elseif ($user_db->activation != $this->request->key) {
			$this->title = "Ошибка при активации";
			$this->meta_desc = "Неверный код активации! Если ошибка будет повторяться, то обратитесь к администрации.";
			$this->meta_key = "активация, ошибка активация, ошибка активация регистрация";
			$hornav->addData("Ошибка активации");
		}
		else {
			$user_db->activation = "";
			try {
				$user_db->save();
			} catch (Exception $e) {print_r($e->getMessage());}
			$this->title = "Ваш аккаунт успешно активирован";
			$this->meta_desc = "Теперь Вы можете войти в свою учётную запись, используя Ваши логин и пароль.";
			$this->meta_key = "активация, успешная активация, успешная активация регистрация";
			$hornav->addData("Активация");
		}
		$head = $this->getHead(array("/css/main.css"));
		$pm = new PageMessage();
		$pm->hornav = $hornav;
		$pm->header = $this->title;
		$pm->text = $this->meta_desc;
		$this->render($head, $pm);
	}

	public function actionLogout() {
		AdminDB::logout();
		$this->redirect($_SERVER["HTTP_REFERER"]);
	}

}