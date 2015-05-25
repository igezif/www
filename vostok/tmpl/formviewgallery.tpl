<?php if ($message) { ?><p class="admin_message"><?=$message?></p><?php } ?>
<table class = "admin_form_table">
	<form class = "admin_form" name = "<?=$name?>" action = "<?=$action?>" method = "POST" enctype="<?=$enctype?>" onsubmit="return checkForm(this)">
	<?php foreach ($inputs as $input) { ?>
		<?php include "f_".$input->type.".tpl"; ?>
	<?php } ?>
	</form>
</table>
