<?php
class Refresh {
	
	public function go() {
		$p = 0;
		$brand = array();
		$xml = file_get_contents('http://abumba.ru/index.php?route=feed/opt_yml');
		//$xml = file_get_contents('http://test');
		$dom = new SimpleXMLElement($xml);
		$categories = $dom->shop->categories->category;
		$products = $dom->shop->offers->offer;
		foreach ($categories as $category) {
			$category_db = new CategoryDB();
			$category_db->number = $category["id"];
			$category_db->parent_number = $category["parentId"] ? $category["parentId"] : null;
			$category_db->title = (string) $category;
			$category_db->meta_desc = (string) $category;
			$category_db->meta_key = (string) $category;
			$category_id = $category_db->save();
			
			foreach ($products as $product) {
				
				if ((string) $product->categoryId[0] == (string) $category["id"]){
					$images = $product->picture;
					$product_db = new ProductDB();
					$product_db->category_id = (int) $category_id;
					$product_db->img = (string) $product->picture[0];
					$product_db->price = (string) $product->price[0];
					$product_db->title = (string) $product->name[0];
					$product_db->meta_desc = (string) $product->name[0];
					$product_db->meta_key = (string) $product->name[0];
					
					if ($product["available"] === "false") $product_db->available = 0;
					else $product_db->available = 1;
					
					$brand= (string) $product->vendor[0];
					
					$id = BrandDB::getBrandIDonName($brand);
					
					if(!$id){
						$brand_db = new BrandDB();
						$brand_db->title = $brand;
						$brand_db->img = null;
						$product_db->brand_id = $brand_db->save();
					}
					else $product_db->brand_id = $id;
					
					$product_id = $product_db->save();
					$p++;
					for ($j = 1; $j < count($images); $j++) {
						$img_db = new ImgDB();
						$img_db->product_id = (int) $product_id;
						$img_db->url = (string) $images[$j];
						$img_db->save();
					}	
				}
			}
			
		}
		echo "В базу внесено ".$p." наименований товаров.";
		
	}

	public function error() {
		return json_encode(array("result" => false, "error" => "no correct refresh-key"));
	}

}