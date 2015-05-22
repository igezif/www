<?=$hornav?>
<h1 class = "cursive center"><?=$header?></h1>
<div class = "content gallery_grid">
	<?php foreach ($items as $item) { ?>
	<a href="<?=$item->img?>" data-lightbox="roadtrip" class = "gallery_image_wrap" title="<?=$title?>">
		<img src="<?=$item->img?>" alt="Изображение">
	</a>
	<?php } ?>
</div>