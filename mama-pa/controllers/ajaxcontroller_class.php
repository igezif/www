<?php

class AjaxController extends Controller {
	
	public function actionBasket() {
		if ($this->request->action === "add") {
			$product = ProductDB::getProductForBasket($this->request->id);
			if($product){
				BasketData::add($product);
				$data = array();
				$data["summ"] = BasketData::getSumm();
				$data["product"] = $product;
				$this->jsonResponse($data);
			}
		}
		else if($this->request->action === "del"){
			$product = ProductDB::getProductForBasket($this->request->id);
			if($product) {
				$data["id"] = BasketData::del($this->request->id);
				$data["summ"] = BasketData::getSumm();
				$this->jsonResponse($data);
			}
			else echo "error";
		}
	}

}