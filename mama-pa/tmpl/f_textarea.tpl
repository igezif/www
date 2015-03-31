<div>
	<label for="<?=$input->name?>"><?=$input->label?></label>
	<textarea id="<?=$input->name?>" name="<?=$input->name?>" <?php include "jsv.tpl"; ?>><?=$input->value?></textarea>
</div>