<?php
	require_once "start.php";
	$request = new Request();
	
	switch ($request->action) {
		case "refresh":
			if ($request->key === Config::REFRESH_KEY){
				$refresh = new Refresh();
				echo $refresh->go();
			}
			else echo $refresh->error();
			break;
	}
	
	
	
	
	
	
	/* $result = false;
	if ($request->func == "edit") $result = $api->edit($request->obj, $request->value, $request->name, $request->type);
	elseif ($request->func == "delete") $result = $api->delete($request->obj, $request->id);
	elseif ($request->func == "add_comment") $result = $api->addComment($request->parent_id, $request->article_id, $request->text);
	if ($result !== false) echo json_encode(array("r" => $result, "e" => false));
	else echo json_encode(array("r" => false, "e" => true)); */