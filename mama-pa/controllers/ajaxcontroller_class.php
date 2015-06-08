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
				$data = array();
				$data["id"] = BasketData::del($this->request->id);
				$data["summ"] = BasketData::getSumm();
				$this->jsonResponse($data);
			}
			else echo "error";
		}
		else if($this->request->action === "clear"){
			BasketData::clear();
		}
	}


	public function actionOrder() {
		$name = $this->request->name;
		$email = $this->request->email;
		$phone = $this->request->phone;
		$address = $this->request->region.", ".$this->request->index.", ".$this->request->street.", ".$this->request->home.", квартира ".$this->request->float;
		$pay = $this->request->pay;
		$delivery = $this->request->delivery;
		$notice = $this->request->notice;
		$products = BasketData::getItems();
		$summ = BasketData::getSumm();
		$this->mail->send(Config::ADM_EMAIL, array("site" => Config::SITENAME, "name" => $name, "email" => $email, "phone" => $phone, "address" => $address, "pay" => $pay, "delivery" => $delivery, "products" => $products, "summ" => $summ, "notice" => $notice), "admin_order");
		$this->mail->send(Config::ADM_EMAIL2, array("site" => Config::SITENAME, "name" => $name, "email" => $email, "phone" => $phone, "address" => $address, "pay" => $pay, "delivery" => $delivery, "products" => $products, "summ" => $summ, "notice" => $notice), "admin_order");
		$this->mail->send(Config::ADM_EMAIL3, array("site" => Config::SITENAME, "name" => $name, "email" => $email, "phone" => $phone, "address" => $address, "pay" => $pay, "delivery" => $delivery, "products" => $products, "summ" => $summ, "notice" => $notice), "admin_order");
		$this->mail->send($this->request->email, array("site" => Config::SITENAME, "name" => $name, "products" => $products, "summ" => $summ), "client_order");
		
		echo "success";
	}

}