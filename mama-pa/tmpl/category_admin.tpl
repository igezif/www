<h3>Бренды</h3>
<table border = "1">
<tr><td>№</td><td>Навание</td><td>Картинка</td></tr>
<?php $i = 1; foreach ($items as $item) {?>
<tr><td><?=$i?></td><td><a href = "<?=$item->link?>"><?=$item->name?></a></td><td><?=($item->img) ? $item->img : "нет"?></td></tr>
<?php $i++; } ?>
</table>