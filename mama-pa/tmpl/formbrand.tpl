<p class="message"><?=$message?></p>
<div class = "border">
	<form class = "admin_form" name = "<?=$name?>" action = "<?=$action?>" method = "POST" enctype="<?=$enctype?>" onsubmit="return checkForm(this)">
		<?php foreach ($inputs as $input) { ?>
			<?php include "f_".$input->type.".tpl"; ?>
		<?php } ?>
	</form>
</div>