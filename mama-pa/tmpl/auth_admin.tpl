<?php if ($message) { ?><span class="message"><?=$message?></span><?php } ?>
<form name="auth" action="<?=$action?>" method="post">
	<div>
		<input type="text" name="login" placeholder="Логин" />
		<input type="password" name="password" placeholder="Пароль" />
		<input type="submit" name="auth" value="Войти" />
	</div>
</form>