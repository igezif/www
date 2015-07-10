<div>
	<?php if (isset($hornav)) { ?><?=$hornav?><?php } ?><h2>
	Группа № <?=$group->number?> от <?=$group->date_reg?>
	<input type = "hidden" name = "group_id" value = "<?=$group->id?>" />
	</h2>
	<table border = "1" class = "table_group">
		<tr>
			<td>
				#
			</td>
			<td>
				ФИО
			</td>
		</tr>
		<?php $i = 1; foreach ($students as $student) { ?>
		<tr>
			<td>
				<?=$i?>
			</td>
			<td>
				<?=$student->name?>
			</td>
		</tr>
		<?php $i++; } ?>
	</table>
	<div><a href = "/logout"><b>Выход</b></a></div>
</div>