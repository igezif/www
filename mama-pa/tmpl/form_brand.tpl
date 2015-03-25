<p class="message"><?=$message?></p>
<form name = "<?=$name?>" action = "<?=$action?>" enctype="<?=$enctype?>" onsubmit="return checkForm(this)">
	<table class = "admin_table">
		<?php foreach ($inputs as $input) {?>
		<tr>
			<td><?=$input->label?></td><td><input type="<?=$input->type?>" name = "<?=$input->name?>" value = "<?=$input->value?>" /></td>
		</tr>
		<?php } ?>
	</table>
</form>