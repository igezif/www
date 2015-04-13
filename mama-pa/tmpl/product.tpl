<?=$hornav?>
<section class = "content border">
	<h1>
		<?=$title?>
	</h1>
	<div><img src = "<?=$img?>" alt = "Изображение" /></div>
	<div>наличие <?=$available?></div>
	<div>номер <?=$id?></div>
	<div>цена <?=$price?></div>
	<div>бренд <?=$brand?></div>
	<div class = "row product_foto">
		<?php foreach($foto as $f) { ?>
		<div>
			<img src = "<?=$f->url?>" alt = "Изображение" />
		</div>
		<?php } ?>
	</div>
</section>