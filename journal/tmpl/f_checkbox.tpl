<div>
	<label for="<?=$input->name?>"><?=$input->label?></label>
	<input id="<?=$input->name?>" type="checkbox" name="<?=$input->name?>" value="<?=$input->value?>" <?php if($input->on) { ?>checked<?php } ?> />
</div>