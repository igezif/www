<?php if (isset($hornav)) { ?><?=$hornav?><?php } ?>
<h1>Регистрация</h1>
<?php if ($message) { ?><p class="admin_message"><?=$message?></p><?php } ?>
<form name = "<?=$name?>" action = "<?=$action?>" method = "<?=$method?>">
	<?php foreach ($inputs as $input) { ?>
		<div><?php include "f_".$input->type.".tpl"; ?></div>
	<?php } ?>
</form>