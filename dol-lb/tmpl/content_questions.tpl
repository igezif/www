<h2>Oбpaтнaя cвязь</h2>
<form action="functions.php" method="post" name="send_form" onsubmit="return false;">
	<table id="questions">
		<tr>
			<td><i>Ваше имя:</i></td><td><input type="text" size="31"  name="name_1"/></td>
			
		</tr>
		<tr>
			<td></td><td class="message"><div id="message_name_1"></div></td>
		</tr>
		<tr>
			<td><i>Ваш e-mail:</i></td><td><input type="text" size="31" name="email_1"/></td>
		</tr>
		<tr>
			<td></td><td class="message"><div id="message_email_1"></div></td>
		</tr>
		<tr>
			<td><i>Тема сообщения:</i></td><td><input type="text" size="31"  name="subject"/></td>
		</tr>
		<tr>
			<td></td><td class="message"><div id="message_subject"></div></td>
		</tr>
		<tr>
			<td colspan="2"><i>Сообщение:</i></td>
		</tr>
		<tr>
			<td colspan="2"><textarea cols="50" rows="20" name="text"></textarea></td>
		</tr>
		<tr>
			<td class="message" colspan="2"><div id="message_text"></div></td>
		</tr>
		<tr>
			<td class="message"><div id="update" title="обновить картинку"></div></td>
			<td class="message"><img src="/captcha.php" alt="" id="captcha" /></td>
		</tr>
		<tr>
			<td><i>Текст на изображении:</i></td><td><input type="text" size="31" name="captcha"/></td>
		</tr>
		<tr>
			<td></td><td class="message"><div id="message_captcha"></div></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="send" value="Отправить"/></td>
		</tr>
	</table>
</form>
