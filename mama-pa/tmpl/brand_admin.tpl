<h3>Бренды</h3>
<table border = "1">
<?php foreach ($items as $item) { ?>
<tr><td><?=$item->id?></td><td><?=$item->name?></td><td><?=($item->img) ? $item->img : "нет"?></td></tr>
<?php } ?>
</table>