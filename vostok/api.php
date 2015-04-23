<?php
	require_once "start.php";
	$request = new Request();
	ini_set('max_execution_time', 500000);
	
	switch ($request->action) {
		case "refresh":
			if ($request->key === Config::REFRESH_KEY){
				$obj = new Refresh();
				echo $obj->go();
			}
			else echo $obj->error();
		break;
		case "download":
			$obj = new Download();
			echo $obj->go();
		break;
		case "setp":
			$obj = new Download();
			$obj->setProduct($request->category_id, $request->img, $request->brand_id, $request->price, $request->title, $request->meta_desc, $request->meta_key, $request->available);
		break;
		
		case "loadp":
			$obj = new Download();
			$obj->loadp();
		break;
	}
	
	
	
	
	
	
	/* $result = false;
	if ($request->func == "edit") $result = $api->edit($request->obj, $request->value, $request->name, $request->type);
	elseif ($request->func == "delete") $result = $api->delete($request->obj, $request->id);
	elseif ($request->func == "add_comment") $result = $api->addComment($request->parent_id, $request->article_id, $request->text);
	if ($result !== false) echo json_encode(array("r" => $result, "e" => false));
	else echo json_encode(array("r" => false, "e" => true)); */