<h2>Бронирование путёвок</h2>
<form action="functions.php" method="post" name="reservation_form" onsubmit="return false;">
	<table id="reservation">
		<tr>
			<td><i>Фамилия ребёнка:</i></td><td><input type="text" size="31"  name="surname"/></td>
		</tr>
		<tr>
			<td></td><td class="message"><div id="message_surname">некорректная фамилия!</div></td>
		</tr>
		<tr>
			<td><i>Имя ребёнка:</i></td><td><input type="text" size="31"  name="name"/></td>
		</tr>
		<tr>
			<td></td><td class="message"><div id="message_name">некорректное имя!</div></td>
		</tr>
		<tr>
			<td><i>Отчество ребёнка:</i></td><td><input type="text" size="31"  name="patronymic"/></td>
		</tr>
		<tr>
			<td></td><td class="message"><div id="message_patronymic">некорректное отчество!</div></td>
		</tr>
		<tr>
			<td><i>Год рождения ребёнка:</i></td>
			<td>
				<select name="year_born">
					<?php for ($i = 0; $i < count($this->years); $i++) { ?>
					<option value="<?=$this->years[$i]?>"><?=$this->years[$i]?></option>
					<?php } ?>
			   </select>
			</td>
		</tr>
		<tr>
			<td><i>Сезон:</i></td>
			<td>
				<select name="sezon">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
			   </select>
			</td>
		</tr>
		<tr>
			<td><i>Ваш e-mail:</i></td><td><input type="text" size="31" name="email"/></td>
		</tr>
		<tr>
			<td></td><td class="message"><div id="message_email">некорректный email!</div></td>
		</tr>
		
		<tr>
			<td><i>Контактный телефон:</i></td><td><input type="text" size="31" name="phone"/></td>
		</tr>
		<tr>
			<td><span id="phone">пример: 89137654321</span></td><td class="message"><div id="message_phone">некорректный телефон!</div></td>
		</tr>
		<tr>
			
			<td></td><td><input type="submit"  name="reserv" value="Забронировать" id="res_button"/></td>
		</tr>
	</table>
</form>