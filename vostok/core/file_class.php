<?php
	
class File {
	
	public static function uploadIMG($file, $image_name, $dir, $root = false) {
		$upload_file = $dir.$image_name;
		if (!$root) $upload_file = $_SERVER["DOCUMENT_ROOT"].$upload_file;
		if (!move_uploaded_file($file["tmp_name"], $upload_file)) throw new Exception("UNKNOWN_ERROR");
		return true;
	}

	public static function checkIMG($file, $max_size, $source_name = false){
		if($file["error"]) throw new Exception("ERROR_IMG_EMPTY");
		$blacklist = array(".php", ".phtml", ".php3", ".php4", ".html", ".htm");
		foreach ($blacklist as $item)
			if (preg_match("/$item\$/i", $file["name"])) throw new Exception("ERROR_IMG_TYPE");
		$type = $file["type"];
		$size = $file["size"];
		if (($type != "image/jpg") && ($type != "image/jpeg") && ($type != "image/gif") && ($type != "image/png")) throw new Exception("ERROR_IMG_TYPE");
		if ($size > $max_size) throw new Exception("ERROR_IMG_SIZE");
		if ($source_name) $image_name = $file["name"];
		else $image_name = self::getName().".".substr($type, strlen("image/"));
		return $image_name;
	}
	
	public static function getName() {
		return uniqid();
	}
	
	public static function delete($file, $root = false) {
		if (!$root) $file = $_SERVER["DOCUMENT_ROOT"].$file;
		if (file_exists($file)) unlink($file);
	}
	
	public static function isExists($file, $root = false) {
		if (!$root) $file = $_SERVER["DOCUMENT_ROOT"].$file;
		return file_exists($file);
	}
}