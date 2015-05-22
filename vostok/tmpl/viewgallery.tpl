<?=$hornav?>
<h1 class = "cursive center"><?=$header?></h1>
<div class = "content gallery_grid">
	<?php foreach ($items as $item) { ?>
	<a href = "<?=$item->link?>" class = "gallery_item">
		<div class = "gallery_img_wrap">
			<img src = "<?=$item->img?>" alt = "Изображение" />
		</div>
		<div class = "center gallery_item_view"><?=$item->title?></div>
	</a>
	<?php } ?>
</div>