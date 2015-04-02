<div class = "admin_block">
	<div class = "row section_header">
		<div class = "big_arow"></div>
		<div><h2>Администраторская панель</h2></div>
	</div>
	<?php if ($message) { ?><span class="message"><?=$message?></span><?php } ?>
	<form name="auth" action="<?=$action?>" method="post">
		<div>
			<input type="text" name="login" placeholder="Логин" />
			<input type="password" name="password" placeholder="Пароль" />
			<input type="submit" name="auth" value="Войти" />
		</div>
	</form>
</div>