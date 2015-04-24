<?php

class BasketData {
	
	public static function add($product) {
		if (!session_id()) session_start();
		$_SESSION["basket"][$product["id"]] = $product;
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
				$summ += (int) $product["price"];
			}
			return $summ;
		}
		else return "0";
	}
}