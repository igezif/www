<?php

class AdminDB extends ObjectDB {
	
	protected static $table = "admin";
	private $new_password = null;
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("login", "ValidateLogin");
		$this->add("email", "ValidateEmail");
		$this->add("password", "ValidatePassword");
	}
	
	public function setPassword($password) {
		$this->new_password = $password;
	}
	
	public function getPassword() {
		return $this->new_password;
	}
	
	public function loadOnEmail($email) {
		return $this->loadOnField("email", $email);
	}
	
	public function loadOnLogin($login) {
		return $this->loadOnField("login", $login);
	}
	
	protected function preValidate() {
		if (!is_null($this->new_password)) $this->password = $this->new_password;
		return true;
	}
	
	protected function postValidate() {
		if (!is_null($this->new_password)) $this->password = self::hash($this->new_password, Config::SECRET);
		return true;
	}
	
	public function login() {
		if ($this->activation != "") return false;
		if (!session_id()) session_start();
		$_SESSION["authadmin_login"] = $this->login;
		$_SESSION["authadmin_password"] = $this->password;
	}
	
	public function logout() {
		if (!session_id()) session_start();
		unset($_SESSION["authadmin_login"]);
		unset($_SESSION["authadmin_password"]);
	}
	
	public function checkPassword($password) {
		return $this->password === self::hash($password, Config::SECRET);
	}
	
	public static function authAdmin($login = false, $password = false) {
		if ($login) $auth = true;
		else {
			if (!session_id()) session_start();
			if (!empty($_SESSION["authadmin_login"]) && !empty($_SESSION["authadmin_password"])) {
				$login = $_SESSION["authadmin_login"];
				$password = $_SESSION["authadmin_password"];
			}
			else return;
			$auth = false;
		}
		$admin = new AdminDB();
		if ($auth) $password = self::hash($password, Config::SECRET);
		$select = new Select();
		$select->from(self::$table, array("COUNT(id)"))
			->where("`login` = ".self::$db->getSQ(), array($login))
			->where("`password` = ".self::$db->getSQ(), array($password));
		$count = self::$db->selectCell($select);
		if ($count) {
			$admin->loadOnLogin($login);
			//if ($admin->activation != "") throw new Exception("ERROR_ACTIVATE_USER");
			if ($auth) $admin->login();
			return $admin;
		}
		if ($auth) throw new Exception("ERROR_AUTH_USER");
	}
	
	public function getSecretKey() {
		return self::hash($this->email.$this->password, Config::SECRET);
	}
	
}

?>