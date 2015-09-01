<div class = "admin_block">
	<?php if ($message) { ?><p class="admin_message"><?=$message?></p><?php } ?>
	<div class = "row section_header">
		<div class = "big_arow"></div>
		<div><h2>Товары</h2></div>
	</div>
	<a class = "admin_insert" href = "<?=$link_insert?>">Добавить</a>
	<div class = "border">
		<table class = "admin_table" style = "font-size: 80%;">
			<tr>
				<td>№</td>
				<td>Навание</td>
				<td>Короткое<br />описание<br />meta-description</td>
				<td>Ключевые слова<br />meta-keywords</td>
				<td>Категория</td>
				<td>Бренд</td>
				<td>Цена</td>
				<td>Длинное<br />описание<br /></td>
				<td>Н</td>
			</tr>
			<?php $i = 1; foreach ($items as$item) {?>
			<tr>
				<td><?=$i?></td>
				<td class = "admin_img">
					<div><a href = "<?=$item->link_update?>"><?=$item->title?></a></div>
					<div><a class="link_adm_del" href = "<?=$item->link_delete?>">Удалить</a></div>
					<div><img src = "<?=$item->img?>" alt = "Img" /></div>
					<br /><br />
					ЧПУ - <a href = "<?=$item->alias?>"><?=$item->alias?></a><br />
					<?php if($item->video) { ?><div><a href = "<?=$item->video?>">video</a></div><?php } ?>
				</td>
				<td><?=$item->meta_desc?></td>
				<td><?=$item->meta_key?></td>
				<td><?=$item->category?></td>
				<td><?=$item->brand?></td>
				<td><?=$item->price?></td>
				<td><?=$item->full_text?></td>
				<td><?=$item->available?></td>
			</tr>
			<?php $i++; } ?>
		</table>
	</div>
</div>