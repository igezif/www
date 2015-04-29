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

	public function actionSendmail(){
		$this->mail->send(Config::ADM_EMAIL, array("site" => Config::SITENAME, "name" => $this->request->name, "email" => $this->request->email, "phone" => $this->request->phone, "message" => $this->request->message), "register");
		$this->mail->send(Config::ADM_EMAIL_2, array("site" => Config::SITENAME, "name" => $this->request->name, "email" => $this->request->email, "phone" => $this->request->phone, "message" => $this->request->message), "register");
		echo "Ваше сообщение успешно отправлено, в течение часа с Вами свяжется наш сотрудник.";
	}

}