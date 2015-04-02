<div class = "admin_block">
	<p class="message"><?=$message?></p>
	<div class = "row section_header">
		<div class = "big_arow"></div>
		<div><h2>Категории товаров</h2></div>
	</div>
	<a class = "admin_insert" href = "<?=$link_insert?>">Добавить</a>
	<table class = "admin_table">
		<tr><td><i>№</i></td><td><i>Навание</i></td><td><i>Картинка</i></td></tr>
		<?php $i = 1; foreach ($items as $item) {?>
		<tr><td><?=$i?></td><td><a href = "<?=$item->link?>"><?=$item->name?></a></td><td><?=($item->img) ? $item->img : "нет"?></td><td><a href = "<?=$item->link_delete?>">Удалить</a></td></tr>
		<?php $i++; } ?>
	</table>
</div>