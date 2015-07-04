<?php
ini_set('max_execution_time', 500000);
class Download {
	
	private $xml;
	private $dom;
	private $products;
	private $xml_products;
	private $categories;
	private $xml_categories;
	
	public function __construct() {
		$this->xml = file_get_contents('http://abumba.ru/index.php?route=feed/opt_yml');
		//$xml = file_get_contents('http://test');
		$this->dom = new SimpleXMLElement($this->xml);
		$this->products = ProductDB::getAll();
		$this->xml_products = $this->dom->shop->offers->offer;
		$this->categories = CategoryDB::getAll();
		$this->xml_categories = $this->dom->shop->categories->category;
	}
	
	public function setCategory(){
		$i = 1;
		foreach($this->products as $product){
			$product_db = new ProductDB();
			$product_db->load($product->id);
			if($product_db->category_id === "0"){	
				$category_id = $this->getCategoryIdOnName($product->title);
				$product_db->category_id = $category_id;
				$product_db->save();
				$i++;
			}
			//if($i==3)break;
		}
	}
	
	public function getCategoryIdOnName($p_title){
		foreach($this->xml_products as $xml_product){
			$name = (string) $xml_product->name[0];
			if ($name === $p_title) {
				$number = (string) $xml_product->categoryId[0];
				$id = CategoryDB::getIdonNumder($number);
				return $id;
			}
		}
	}
	
	public function go() {
		$products = ProductDB::getAll();
		$i = 1;
		foreach ($products as $product){
			$id = $product->id;
			$img = $this->getName();
			exec("wget -O img/product/".$img." ".$product->img); //http://abumba.ru/image/cache/data/FSA-products/box/box_red-600x600.png");
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, 'http://www.mama-pa.ru/api.php');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			$str = "action=setp&category_id=".$product->category_id."&img=".$img."&brand_id=".$product->brand_id."&price=".$product->price."&title=".$product->title."&meta_desc=".$product->meta_desc."&meta_key=".$product->meta_key."&available=".$product->available;
			curl_setopt($curl, CURLOPT_POSTFIELDS, $str);
			$out = curl_exec($curl);
			echo $out."<br />";
			curl_close($curl);
			$i++;
		}
		echo "<br /><br /><br /> Всего: ".$i++;
	}
	
	public function setProduct($category_id, $img, $brand_id, $price, $title, $meta_desc, $meta_key, $available){
		$obj = new ProductDB();
		$obj->category_id = $category_id;
		$obj->img = $img;
		$obj->brand_id = $brand_id;
		$obj->price = $price;
		$obj->title = $title;
		$obj->meta_desc = $meta_desc;
		$obj->meta_key = $meta_key;
		$obj->available = $available;
		$obj->save();
	}
	
	
	
	private function getName(){
		$n = uniqid();
		return $n.".jpg";
	}
	
	public function loadp(){
		$xml = file_get_contents('http://abumba.ru/index.php?route=feed/opt_yml');
		$dom = new SimpleXMLElement($xml);
		$products = $dom->shop->offers->offer;
		$count_p = count($products);
		//print_r($products[113]);die;
		//$c = 210;
		for($i = 210; $i < $count_p; $i++) {
			$product = $products[$i];
			$images = $product->picture;
			$product_db = new ProductDB();
			$brand = (string) $product->vendor[0];
			$id = BrandDB::getBrandIDonName($brand);
			if(!$id){
				$brand_db = new BrandDB();
				$brand_db->title = $brand;
				$brand_db->img = null;
				$product_db->brand_id = $brand_db->save();
			}
			else $product_db->brand_id = $id;
			$img = $this->getName();
			$p = (string) $product->picture[0];
			exec("wget -O img/product/".$img." ".$p);
			$product_db->img = $img;
			$product_db->price = (string) $product->price[0];
			$product_db->title = (string) $product->name[0];
			$product_db->meta_desc = (string) $product->name[0];
			$product_db->meta_key = (string) $product->name[0];
			if ($product["available"] === "false") $product_db->available = 0;
			else $product_db->available = 1;
			$product_id = $product_db->save();
			
			for ($j = 1; $j < count($images); $j++) {
				$url = $this->getName();
				$u = (string) $images[$j];
				exec("wget -O img/fsa-product/".$url." ".$u);
				$img_db = new ImgDB();
				$p_id = (int) $product_id;
				$img_db->product_id = $p_id;
				$img_db->url = $url;
				$img_db->save();
			}
		}
		echo $i;
	}

	public function error() {
		return json_encode(array("result" => false, "error" => "no correct refresh-key"));
	}

}