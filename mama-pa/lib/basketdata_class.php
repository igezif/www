<?php

class BasketData {
	
	public static function add($id) {
		$product = ProductDB::getProductForBasket($id);
		if(!$product) return;
		if (!session_id()) session_start();
		if(!isset($_SESSION["basket"])) {
			$_SESSION["basket"] = array();
		}
		if (array_key_exists($product["id"], $_SESSION["basket"])) {
			$_SESSION["basket"][$product["id"]]["count"]++;
			$_SESSION["basket"][$product["id"]]["summ"] = self::getSummProduct($product["id"]);
		}
		else{
			$product["count"] = 1;
			$product["summ"] = $product["price"];
			$_SESSION["basket"][$product["id"]] = $product;
		}
		$product["img"] = Config::DIR_IMG_PRODUCT.$product["img"];
		return $product;
	}

	private static function getSummProduct($id){
		$count = (int)$_SESSION["basket"][$id]["count"];
		$price = (int)$_SESSION["basket"][$id]["price"];
		return $price * $count;
	}

	public static function del($id) {
		unset($_SESSION["basket"][$id]);
		return $id;
	}

	public static function getItems(){
		if(isset($_SESSION["basket"])){
			$items = ObjectDB::buildMultiple("ProductDB", $_SESSION["basket"]);
			foreach ($items as $item) $item->img = Config::DIR_IMG_PRODUCT.$item->img;
			return $items;
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

	public static function countPlus($id){
		$data = array();
		$_SESSION["basket"][$id]["count"]++;
		$_SESSION["basket"][$id]["summ"] += $_SESSION["basket"][$id]["price"];
		$data["id"] = $id;
		$data["count"] = $_SESSION["basket"][$id]["count"];
		$data["product_summ"] = $_SESSION["basket"][$id]["summ"];
		$data["summ"] = self::getSumm();
		return $data;
	}

	public static function countMinus($id){
		$data = array();
		$_SESSION["basket"][$id]["count"]--;
		$_SESSION["basket"][$id]["summ"] -= $_SESSION["basket"][$id]["price"];
		$data["id"] = $id;
		$data["count"] = $_SESSION["basket"][$id]["count"];
		$data["product_summ"] = $_SESSION["basket"][$id]["summ"];
		$data["summ"] = self::getSumm();
		return $data;
	}
}