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
		$pay = new PayDB();
		$pay->load($this->request->pay);
		$pay_id = $pay->id;
		$delivery = new DeliveryDB();
		$delivery->load($this->request->delivery);
		$delivery_id = $delivery->id;
		$notice = $this->request->notice;
		$products = BasketData::getItems();
		$summ = BasketData::getSumm();
		
		$order_db = new OrderDB();
		$order_db->name = $name;
		$order_db->phone = $phone;
		$order_db->email = $email;
		$order_db->address = $address;
		$order_db->pay_id = $pay->id;
		$order_db->delivery_id = $delivery->id;
		$order_db->summ = $summ;
		$order_db->notice = $notice;
		if(!$order_id = $order_db->save()) exit("error");

		foreach($products as $product) {
			$purchase_db = new PurchaseDB();
			$purchase_db->order_id = $order_id;
			$purchase_db->product_id = $product->id;
			$purchase_db->count = $product->count;
			$purchase_db->save();
		}

		$this->mail->send(Config::ADM_EMAIL, array("site" => Config::SITENAME, "name" => $name, "email" => $email, "phone" => $phone, "address" => $address, "pay" => $pay->title, "delivery" => $delivery->title, "products" => $products, "summ" => $summ, "notice" => $notice), "admin_order");
		$this->mail->send(Config::ADM_EMAIL2, array("site" => Config::SITENAME, "name" => $name, "email" => $email, "phone" => $phone, "address" => $address, "pay" => $pay->title, "delivery" => $delivery->title, "products" => $products, "summ" => $summ, "notice" => $notice), "admin_order");
		$this->mail->send(Config::ADM_EMAIL3, array("site" => Config::SITENAME, "name" => $name, "email" => $email, "phone" => $phone, "address" => $address, "pay" => $pay->title, "delivery" => $delivery->title, "products" => $products, "summ" => $summ, "notice" => $notice), "admin_order");
		$this->mail->send($this->request->email, array("site" => Config::SITENAME, "name" => $name, "products" => $products, "summ" => $summ), "client_order");
		
		echo "success";
	}

}