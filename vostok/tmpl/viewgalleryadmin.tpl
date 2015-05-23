<div>
	<?php if ($message) { ?><p class="admin_message"><?=$message?></p><?php } ?>
	<div>
		<div></div>
		<div><h2>Галерея</h2></div>
	</div>
	<a href = "<?=$link_insert?>">Добавить</a>
	<div>
		<table border = "1" class = "admin_gallery_table">
			<tr><td><i><b>№</b></i></td><td><i><b>Навание</b></i></td><td><i><b>Описание</b></i></td><td><i><b>Ключевые слова</b></i></td><td><i><b>Удалить</b></i></td></tr>
			<?php $i = 1; foreach ($items as $item) { ?>
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