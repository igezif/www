<!DOCTYPE html>
<html>
<?=$head?>
<body>
	<form class = "modal_form" method = "POST" action="/ajax/sendmail">
		<div class = "close_modal_form"></div>
		<div><input type = "text" data-type = "text" name = "name" placeholder = "Ваше имя" /></div>
		<div><input type = "text" name = "phone" placeholder = "Ваш телефон" /></div>
		<div><input type = "text" data-type = "email" name = "email" placeholder = "Ваш email" /></div>
		<div><textarea name = "message" data-type = "text"></textarea></div>
		<div><input type = "submit" value = "Отправить" /></div>
		<div class = "modal_form_message"></div>
	</form>
	<div id = "container">
		<?=$header?>
		<?=$content?>
		<div class="hFooter clear"></div>
	</div>
	<footer>
		<?=$footer?>
	</footer>
</body>
</html>
