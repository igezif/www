<?php
	require_once "start.php";
	$request = new Request();
	
	switch ($request->action) {
		case "refresh":
			if ($request->key === Config::REFRESH_KEY){
				$refresh = new Refresh();
				$result = $refresh->go();
				echo json_encode(array("result" => $result, "error" => false));
			}
			else echo json_encode(array("result" => false, "error" => "no correct refresh-key"));
			break;
	}
	
	
	
	
	
	
	/* $result = false;
	if ($request->func == "edit") $result = $api->edit($request->obj, $request->value, $request->name, $request->type);
	elseif ($request->func == "delete") $result = $api->delete($request->obj, $request->id);
	elseif ($request->func == "add_comment") $result = $api->addComment($request->parent_id, $request->article_id, $request->text);
	if ($result !== false) echo json_encode(array("r" => $result, "e" => false));
	else echo json_encode(array("r" => false, "e" => true)); */