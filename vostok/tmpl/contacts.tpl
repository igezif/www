<?=$hornav?>
<h1 class = "cursive center">Контактная информация и схема проезда</h1>
<div class = "content rekizition">
	<p>
		<b><?=$name?></b>
	</p>
	<p>
		<?=$ind?>
	</p>
	<p><?=$address?></p>
	<p>Телефон: <?=$phone?></p>
	<p>Email: <?=$email?></p>
	<br />
	<p><b>Реквизиты:</b></p>
	<p>ИНН <?=$inn?></p>
	<p>КПП <?=$kpp?></p
	<p>БИК <?=$bik?></p>
	<p>р/с <?=$rs?></p
	<p><?=$bank?></p>
	<p>к/с <?=$ks?></p>
	<p>ОКПО <?=$okpo?></p>
	<p>ОКАТО <?=$okato?></p>
	<p>ОГРН <?=$ogrn?></p>
	<br />
</div>
<div class = "content">	
	<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=BZKtABaDL1PEoTafiLv6xsVXb1mijPkP&amp;width=1000&amp;height=450"></script>
</div>
<div class = "content form_os">
	<div>
		Если у Вас есть вопросы, заполнте форму, отправьте нам и уже в течение часа с Вами свяжется наш специалист по работе с клиентами
	</div>
	<table>
		<tr>
			<td>
				<label>
					Ваше имя:
				</label>
			</td>
			<td>
				<input type = "text" name = "name" />
			</td>
		</tr>
		<tr>
			<td>
				<label>
					Ваш email:
				</label>
			</td>
			<td>
				<input type = "text" name = "email" />
			</td>
		</tr>
		<tr>
			<td>
				<label>
					Ваш телефон:
				</label>
			</td>
			<td>
				<input type = "text" name = "phone" />
			</td>
		</tr>
		<tr>
			<td>
				<label>
					Сообщение:
				</label>
			</td>
			<td>
				<textarea name = "messaege"></textarea>
			</td>
		</tr>
		<tr>
			<td colspan = "2">
				<input type = "submit" value = "Отправить" />
			</td>
		</tr>
	</table>
</div>