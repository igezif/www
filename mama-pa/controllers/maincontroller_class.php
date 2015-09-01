<?php

class MainController extends Controller {

	public function actionIndex() {
		$this->title = "Интернет магазин детских товаров Мама-Па";
		$this->meta_desc = "В интернет магазине www.mama-pa.ru представлены товары самых известных и качественных брендов, доказавших на деле удобство, красоту и практичность своих товаров";
		$this->meta_key = "товары для детей, детские товары, магазин детских товаров, интернет магазин детских товаров";
		$head = $this->getHead(array("/css/main.css"));
		$head->js = array("/js/main.js", "/js/slider.js");
		$sections = new Section();
		$sections->items = SectionDB::getAllShow();
		$slider = new Slider();
		$slider->items = SliderDB::getItems();
		$promo = new Promo();
		$this->render($head, $this->renderData(array("slider" => $slider, "promo" => $promo, "sections" => $sections), "index"));
	}

	public function actionSearch() {
		$this->title = "Результат поиска: ".$this->request->query;
		$head = $this->getHead(array("/css/main.css"));
		$head->js = array("/js/main.js");
		$hornav = $this->getHornav();
		$hornav->addData("Результат поиска");
		$this->title = "Результат поиска: ".$this->request->query;
		$this->meta_desc = "Результат поиска ".$this->request->query.".";
		$this->meta_key = "поиск, поиск ".$this->request->query;
		$articles = ProductDB::search($this->request->query);
		$sr = new SearchResult();
		if (mb_strlen($this->request->query) < Config::MIN_SEARCH_LEN) $sr->error_len = true;
		$sr->hornav = $hornav;
		$sr->field = "full_text";
		$sr->query = $this->request->query;
		$sr->data = $articles;
		$this->render($head, $sr);
	}
	
	public function actionProduct() {
		$obj = new ProductDB();
		if(!$obj->getProduct($this->request->id)) $this->notFound();
		$this->title = $obj->title;
		//$this->meta_desc = $obj->meta_desc;
		//$this->meta_key= $obj->meta_key;
		$head = $this->getHead(array("/css/main.css"));
		$head->js = array("/js/main.js", "/js/gallery.js");
		$product = new Product();
		$hornav = $this->getHornav();
		$hornav->addData($obj->section, URL::get("section", "", array("id" => $obj->section_id)));
		$hornav->addData($obj->category, URL::get("category", "", array("id" => $obj->category_id)));
		$hornav->addData($obj->title);
		$product->hornav = $hornav;
		$product->title = $obj->title;
		$product->img = $obj->img;
		$product->available = $obj->available;
		$product->id = $obj->id;
		$product->brand = $obj->brand;
		$product->brand_img = Config::DIR_IMG_BRAND.$obj->brand_img;
		$product->price = $obj->price;
		$product->full_text = $obj->full_text;
		$product->video = $obj->video;
		$product->foto = ImgDB::getImgOnID($this->request->id);
		$product->others = ProductDB::getOthers($this->request->id);
		$this->render($head, $product);
	}

	public function actionBasket() {
		$this->title = "Ваша корзина";
		$this->meta_desc = "Ваша корзина, здесь находятся выбранные Вами товары";
		$this->meta_key = "корзина, ваша корзина";
		$content = new Basket();
		$content->header = "Корзина";
		$content->items = BasketData::getItems();
		if($content->items) $content->link_order = URL::get("order", "");
		$hornav = $this->getHornav();
		$hornav->addData("Корзина");
		$content->hornav = $hornav;
		if($content->items) $content->text = "Вы выбрали следующие товары";
		else $content->text = "Ваша корзина пуста";
		$content->summ = BasketData::getSumm();
		$head = $this->getHead(array("/css/main.css"));
		$head->js = array("/js/main.js", "/js/basket.js");
		$this->render($head, $content);
	}

	public function actionOrder(){
		$this->title = "Оформить заказ";
		$this->meta_desc = "В данном разделе Вы можете завершить оформление заказа";
		$this->meta_key = "оформление заказа, оформить заказ";
		$content = new Order();
		$content->header = "Оформить заказ";
		$hornav = $this->getHornav();
		$hornav->addData("Оформить заказ");
		$content->hornav = $hornav;
		$content->summ = BasketData::getSumm();
		$content->delivery = DeliveryDB::getAllShow();
		$content->pay = PayDB::getAllShow();
		$head = $this->getHead(array("/css/main.css"));
		$head->js = array("/js/main.js", "/js/order.js");
		$this->render($head, $content);
	}

	public function actionContacts(){
		$this->title = "Наши контакты";
		$this->meta_desc = "В данном разделе представлены все наши контакты, банковские реквизиты, местоположение на карте и способы проезда";
		$this->meta_key = "наши контакты, наши реквизиты";
		$head = $this->getHead(array("/css/main.css"));
		$head->js = array("/js/main.js");
		$content = new Contacts();
		$content->header = "Наши контакты";
		$hornav = $this->getHornav();
		$hornav->addData("Наши контакты");
		$content->hornav = $hornav;
		$this->render($head, $content);
	}
	
	public function actionSection() {
		$obj = new SectionDB();
		if(!$obj->load($this->request->id)) $this->notFound();
		$this->title = $obj->title;
		$this->meta_desc = $obj->meta_desc;
		$this->meta_key= $obj->meta_key;
		$head = $this->getHead(array("/css/main.css"));
		$head->js = array("/js/main.js");
		$content = new Sectionproduct();
		$hornav = $this->getHornav();
		$hornav->addData($obj->title);
		$content->hornav = $hornav;
		$content->title = $obj->title;
		$content->full_text = $obj->full_text;
		$count = ProductDB::getCountProductOnSection($this->request->id);
		$offset = $this->getOffset(Config::COUNT_PRODUCTS_ON_PAGE);
		$url = URL::get("section", "", array("id" => $this->request->id));
		$products = ProductDB::getProductOnSection($this->request->id, Config::COUNT_PRODUCTS_ON_PAGE, $offset);
		$categories = CategoryDB::getCategoryOnSection($this->request->id);
		$pagination = $this->getPagination($count, Config::COUNT_PRODUCTS_ON_PAGE, $url);
		$content->products = $products;
		$content->pagination = $pagination;
		$content->categories = $categories;
		$this->render($head, $content);
	}

	public function actionBrand() {
		$obj = new BrandDB();
		if(!$obj->load($this->request->id)) $this->notFound();
		$this->title = $obj->title;
		$this->meta_desc = $obj->meta_desc;
		$this->meta_key= $obj->meta_key;
		$head = $this->getHead(array("/css/main.css"));
		$head->js = array("/js/main.js");
		$content = new Brandproduct();
		$hornav = $this->getHornav();
		$hornav->addData($obj->title);
		$content->hornav = $hornav;
		$content->title = $obj->title;
		$count = ProductDB::getCountProductOnBrand($this->request->id);
		$offset = $this->getOffset(Config::COUNT_PRODUCTS_ON_PAGE);
		$url = URL::get("brand", "", array("id" => $this->request->id));
		$products = ProductDB::getProductOnBrand($this->request->id, Config::COUNT_PRODUCTS_ON_PAGE, $offset);
		$pagination = $this->getPagination($count, Config::COUNT_PRODUCTS_ON_PAGE, $url);
		$content->products = $products;
		$content->pagination = $pagination;
		$this->render($head, $content);
	}

	public function actionCategory() {
		$obj = new CategoryDB();
		if(!$obj->load($this->request->id)) $this->notFound();
		$this->title = $obj->title;
		$this->meta_desc = $obj->meta_desc;
		$this->meta_key= $obj->meta_key;
		$section_db = new SectionDB();
		$section_db->load($obj->section_id);
		$head = $this->getHead(array("/css/main.css"));
		$head->js = array("/js/main.js");
		$content = new Categoryproduct();
		$url = URL::get("category", "", array("id" => $this->request->id));
		$section_url = URL::get("section", "", array("id" => $section_db->id));
		$hornav = $this->getHornav();
		$hornav->addData($section_db->title, $section_url);
		$hornav->addData($obj->title);
		$content->hornav = $hornav;
		$content->title = $obj->title;
		$count = ProductDB::getCountProductOnCategory($this->request->id);
		$offset = $this->getOffset(Config::COUNT_PRODUCTS_ON_PAGE);
		$products = ProductDB::getProductOnCategory($this->request->id, Config::COUNT_PRODUCTS_ON_PAGE, $offset);
		$pagination = $this->getPagination($count, Config::COUNT_PRODUCTS_ON_PAGE, $url);
		$content->products = $products;
		$content->pagination = $pagination;
		$this->render($head, $content);
	}

	public function actionDelivery() {
		$this->title = "Оплата и доставка";
		$this->meta_desc = "В этом разделе представлены  правила и условия доставки товаров клиентам интернет магазина www.mama-pa.ru";
		$this->meta_key = "оплата и доставка, рездел оплаты и доставки";
		$content = new Delivery();
		$content->header = "Оплата и доставка";
		$hornav = $this->getHornav();
		$hornav->addData("Оплата и доставка");
		$content->hornav = $hornav;
		$head = $this->getHead(array("/css/main.css"));
		$head->js = array("/js/main.js");
		$this->render($head, $content);
	}

	public function actionOpt(){
		$this->title = "Детские товары оптом";
		$this->meta_desc = "В этом разделе представлены  правила и условия приобретения детских товаров оптом в интернет магазине www.mama-pa.ru";
		$this->meta_key = "оптом, купить оптом, детское оптом, детские товары оптом";
		$content = new Opt();
		$hornav = $this->getHornav();
		$hornav->addData("Опт");
		$content->header = "Детские товары оптом";
		$content->brands = BrandDB::getAllShow();
		$content->hornav = $hornav;
		$head = $this->getHead(array("/css/main.css"));
		$head->js = array("/js/main.js");
		$this->render($head, $content);
	}

}