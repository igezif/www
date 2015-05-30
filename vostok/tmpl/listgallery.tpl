<?php if ($message) { ?><p class="admin_message"><?=$message?></p><?php } ?>
<h2 class = "admin_header"><?=$header?></h2>
<a href = "<?=$link_insert?>" class = "admin_link_entry">Добавить</a>
<table border = "1" class = "admin_gallery_table">
	<tr><td><i><b>№</b></i></td><td><i><b>Название</b></i></td><td><i><b>Описание</b></i></td><td><i><b>Ключевые слова</b></i></td><td><i><b>Удалить/<br />Редактировать</b></i></td></tr>
	<?php $i = 1; foreach ($items as $item) { ?>
	<tr>
		<td>
			<b><?=$i?></b>
		</td>
		<td>
			<a href = "<?=$item->link_list?>"><?=$item->title?></a>
			<img src = "<?=$item->img?>" alt = "Изображение" />
		</td>
		<td>
			<?=$item->meta_desc?>
		</td>
		<td>
			<?=$item->meta_key?>
		</td>
		<td>
			<a href = "<?=$item->link_delete?>">Удалить</a><br /><br />
			<a href = "<?=$item->link_update?>">Редактировать</a>
		</td>
	</tr>
	<?php $i++; } ?>
</table>