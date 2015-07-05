<?php

class AdminDB extends ObjectDB {
	
	protected static $table = "admin";
	private $new_password = null;
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("login", "ValidateLogin");
		$this->add("email", "ValidateEmail");
		$this->add("password", "ValidatePassword");
		$this->add("name", "ValidateName");
		$this->add("date_reg", "ValidateDate", self::TYPE_TIMESTAMP, $this->getDate());
		$this->add("activation", "ValidateActivation", null, $this->getKey());
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
		$_SESSION["auth_login"] = $this->login;
		$_SESSION["auth_password"] = $this->password;
		$_SESSION["auth_id"] = $this->id;
	}
	
	public static function logout() {
		if (!session_id()) session_start();
		unset($_SESSION["auth_login"]);
		unset($_SESSION["auth_password"]);
		unset($_SESSION["auth_id"]);
	}
	
	public function checkPassword($password) {
		return $this->password === self::hash($password, Config::SECRET);
	}
	
	public static function authAdmin($login = false, $password = false) {
		if ($login) $auth = true;
		else {
			if (!session_id()) session_start();
			if (!empty($_SESSION["auth_login"]) && !empty($_SESSION["auth_password"])) {
				$login = $_SESSION["auth_login"];
				$password = $_SESSION["auth_password"];
			}
			else return;
			$auth = false;
		}
		$user = new AdminDB();
		if ($auth) $password = self::hash($password, Config::SECRET);
		$select = new Select();
		$select->from(self::$table, array("COUNT(id)"))
			->where("`login` = ".self::$db->getSQ(), array($login))
			->where("`password` = ".self::$db->getSQ(), array($password));
		$count = self::$db->selectCell($select);
		if ($count) {
			$user->loadOnLogin($login);
			if ($user->activation != "") throw new Exception("ERROR_ACTIVATE_USER");
			if ($auth) $user->login();
			return $user;
		}
		if ($auth) throw new Exception("ERROR_AUTH_USER");
	}
	
	public function getSecretKey() {
		return self::hash($this->email.$this->password, Config::SECRET);
	}
	
}

?>