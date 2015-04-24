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
			echo BasketData::del($this->request->id);
		}
	}

}