<?php

class API {

	private $mail;
	private $auth_user;
	
	public function __construct() {
		$this->mail = new Mail();
		try {
			$this->auth_user = UserDB::authUser();
		} catch (Exception $e) {
			$this->auth_user = null;
		}
	}
	
	public function edit($obj, $value, $name, $type) {
		$class = $obj."DB";
		$obj = new $class();
		preg_match_all("/(.+?)_(\d+)/i", $name, $matches);
		if (count($matches[1]) != 0 && count($matches[2]) != 0) {
			$field = $matches[1][0];
			$id = $matches[2][0];
			$obj->load($id);
			if ($obj->accessEdit($this->auth_user, $field)) {
				if ($type == "date" && !$value) $value = $obj->getDate();
				elseif ($value == "null") $value = null;
				if ($obj->$field != $value) $obj->$field = $value;
				else return $value;
				try {
					if (!$obj->save()) throw new Exception();
					return $obj->$field;
				} catch (Exception $e) {
					return false;
				}
			}
			return false;
		}
	}
	
	public function delete($obj, $id) {
		$class = $obj."DB";
		$obj = new $class();
		$obj->load($id);
		if ($obj->accessDelete($this->auth_user)) {
			try {
				if (!$obj->delete()) throw new Exception();
				return true;
			} catch (Exception $e) {
				return false;
			}
		}
		return false;
	}
	
	public function addComment($parent_id, $article_id, $text) {
		$comment = new CommentDB();
		if (!$this->auth_user) return false;
		$comment->article_id = $article_id;
		$comment->user_id = $this->auth_user->id;
		$comment->parent_id = $parent_id;
		$comment->text = $text;
		try {
			$comment->save();
			$comment_parent = new CommentDB();
			$comment_parent->load($parent_id);
			if (($comment_parent->isSaved()) && ($comment_parent->user_id != $this->auth_user->id)) {
				$user = new UserDB();
				$user->load($comment_parent->user_id);
				$this->mail->send($user->email, array("user" => $user, "link" => $comment_parent->link), "comment_subscribe");
			}
			return json_encode(array("id" => $comment->id, "parent_id" => $comment->parent_id, "user_id" => $this->auth_user->id, "name" => $this->auth_user->name, "avatar" => $this->auth_user->avatar, "text" => $comment->text, "date" => $comment->date));
		} catch (Exception $e) {
			return false;
		}
	}
	
}

?>