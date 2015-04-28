<!DOCTYPE html>
<html>
<?=$head?>
<body>
	<form id = "modal_form" action="#">
		<div id = "close_modal_form"></div>
		<div><input type = "text" name = "name" placeholder = "Ваше имя" /></div>
		<div><input type = "text" name = "phone" placeholder = "Ваш телефон" /></div>
		<div><input type = "text" name = "email" placeholder = "Ваш email" /></div>
		<div><textarea></textarea></div>
		<div><input type = "submit" value = "Отправить" /></div>
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
