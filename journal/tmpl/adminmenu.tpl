<div>
	<h1>Здравствуйте <?=$admin->name?>!</h1>
	<?php if ($message) { ?><p class="admin_message"><?=$message?></p><?php } ?>
	<h2>Ваши группы</h2>
	<table border = "1" class = "table_group">
		<tr>
			<td>
				#
			</td>
			<td>
				номер
			</td>
			<td>
				Дата создания
			</td>
		</tr>
		<?php $i = 1; foreach ($groups as $group) { ?>
		<tr>
			<td>
				<?=$i?>
			</td>
			<td>
				<a href = "<?=$group->link?>"><?=$group->number?></a>
			</td>
			<td>
				<?=$group->date_reg?>
			</td>
		</tr>
		<?php $i++; } ?>
	</table>
	<div><a href = "/create">Создать группу</a></div>
	<div><a href = "/logout"><b>Выход</b></a></div>
</div>