<?php

class FormProcessor {
	
	private $request;
	private $message;
	
	public function __construct($request, $message) {
		$this->request = $request;
		$this->message = $message;
	}
	
	public function process($message_name, $obj, $fields, $checks = array(), $success_message = false) {
		try {
			if (is_null($this->checks($message_name, $checks))) return null;
			foreach ($fields as $field) {
				if (is_array($field)) {
					$f = $field[0];
					$v = $field[1];
					if (strpos($f, "()") !== false) {
						$f = str_replace("()", "", $f);
						$obj->$f($v);
					}
					else{
						$obj->$f = $v;
						$this->setSessionData($f, $v);
					}
				}
				else{
					$obj->$field = $this->request->$field;
					$this->setSessionData($field, $this->request->$field);
				}	
			}
			if ($obj->save()) {
				if ($success_message) $this->setSessionMessage($message_name, $success_message);
				foreach ($fields as $field){
					//$this->unsetSessionData($field);
					unset($_SESSION["data"]);
				}
				return $obj;
			}
		} catch (Exception $e) {
			$this->setSessionMessage($message_name, $this->getError($e));
			return null;
		}
	}
	
	public function checks($message_name, $checks) {
		try {
			for ($i =0; $i < count($checks); $i++) {
				$equal = isset($checks[$i][3])? $checks[$i][3]: true;
				if ($equal && ($checks[$i][0] != $checks[$i][1])) throw new Exception($checks[$i][2]);
				elseif (!$equal && ($checks[$i][0] == $checks[$i][1])) throw new Exception($checks[$i][2]);
			}
			return true;
		} catch (Exception $e) {
			$this->setSessionMessage($message_name, $this->getError($e));
			return null;
		}
	}
	
	public function auth($message_name, $obj, $method, $login, $password) {
		try {
			$user = $obj::$method($login, $password);
			return $user;
		} catch (Exception $e) {
			$this->setSessionMessage($message_name, $this->getError($e));
			return false;
		}
	}
	
	public function setSessionMessage($to, $message) {
		if (!session_id()) session_start();
		$_SESSION["message"] = array($to => $message);
	}

	public function getSessionMessage($to) {
		if (!session_id()) session_start();
		if (!empty($_SESSION["message"]) && !empty($_SESSION["message"][$to])) {
			$message = $_SESSION["message"][$to];
			unset($_SESSION["message"][$to]);
			return $this->message->get($message);
		}
		return false;
	}

	public function setSessionData($field, $value){
		if (!session_id()) session_start();
		$_SESSION["data"][$field] = $value;
	}

	public function unsetSessionData($field){
		if (!session_id()) session_start();
		if (!empty($_SESSION["data"]) && !empty($_SESSION["data"][$field])) {
			unset($_SESSION["data"][$field]);
			return false;
		}
		return false;
	}

	public static function getSessionData($field){
		if (!session_id()) session_start();
		if (!empty($_SESSION["data"]) && !empty($_SESSION["data"][$field])) {
			$data = $_SESSION["data"][$field];
			unset($_SESSION["data"][$field]);
			return $data;
		}
		return false;
	}
	
	public function uploadIMG($message_name, $file, $max_size, $dir, $source_name = false) {
		try {
			$name = File::uploadIMG($file, $max_size, $dir, false, $source_name);
			return $name;
		} catch (Exception $e) {
			$this->setSessionMessage($message_name, $this->getError($e));
			return false;
		}
	}
	
	public function uploadAdminIMG($message_name, $file, $max_size, $dir, $id) {
		try {
			
			$name = File::uploadAdminIMG($file, $max_size, $dir, false, $id);
			return $name;
		} catch (Exception $e) {
			$this->setSessionMessage($message_name, $this->getError($e));
			return false;
		}
	}
	
	private function getError($e) {
		if ($e instanceof ValidatorException) {
			$error = current($e->getErrors());
			return $error[0];
		}
		elseif (($message = $e->getMessage())) return $message;
		return "UNKNOWN_ERROR";
	}
	
}