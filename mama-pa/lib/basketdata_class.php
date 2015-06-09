<?php

class BasketData {
	
	public static function add($product) {
		if (!session_id()) session_start();
		if(!isset($_SESSION["basket"])) {
			$_SESSION["basket"] = array();
		}
		if (array_key_exists($product["id"], $_SESSION["basket"])) {
			$count = $_SESSION["basket"][$product["id"]]["count"] + 1;
			$summ = (int)$product["price"] * $count;
			$_SESSION["basket"][$product["id"]]["count"] = $count;
			$_SESSION["basket"][$product["id"]]["summ"] = $summ;
		}
		else{
			$product["count"] = 1;
			$product["summ"] = $product["price"];
			$_SESSION["basket"][$product["id"]] = $product;
		}
		
	}

	public static function del($id) {
		unset($_SESSION["basket"][$id]);
		return $id;
	}

	public static function getItems(){
		if(isset($_SESSION["basket"])){
			$data = ObjectDB::buildMultiple("ProductDB", $_SESSION["basket"]);
			return $data;
		}
		return false;
	}

	public static function getSumm(){
		if(isset($_SESSION["basket"])){
			$summ = 0;
			foreach ($_SESSION["basket"] as $product) {
				$summ += (int) $product["summ"];
			}
			return $summ;
		}
		else return "0";
	}

	public static function clear(){
		unset($_SESSION["basket"]);
	}
}