<div class = "admin_block">
	<?php if ($message) { ?><p class="admin_message"><?=$message?></p><?php } ?>
	<div class = "row section_header">
		<div class = "big_arow"></div>
		<div><h2>Секции</h2></div>
	</div>
	<a class = "admin_insert" href = "<?=$link_insert?>">Добавить</a>
	<div class = "border">
		<table class = "admin_table">
			<tr><td><i>№</i></td><td><i>Навание</i></td><td><i>Описание</i></td><td><i>Ключевые слова</i></td><td><i>Удалить</i></td></tr>
			<?php $i = 1; foreach ($items as $item) {?>
			<tr>
				<td>
					<b><?=$i?> </b>
				</td>
				<td>
					<a href = "<?=$item->link_update?>"><?=$item->title?></a>
				</td>
				<td>
					<?=$item->meta_desc?>
				</td>
				<td>
					<?=$item->meta_key?>
				</td>
				<td>
					<a href = "<?=$item->link_delete?>">Удалить</a>
				</td>
			</tr>
			<?php $i++; } ?>
		</table>
	</div>
</div>