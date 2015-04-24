<?=$hornav?>
<section class = "content border">
	<div class = "row">
		<div class = "product_img">
			<h1 class = "product_header">
				<?=$title?>
			</h1>
			<img src = "<?=$img?>" alt = "Изображение" />
			<div class = "product_description">
				<?=$description?>
			</div>
		</div>
		<div class = "product_info">
			<div class = "product_price">
				<div>
					<b><?=$price?></b> р.
				</div>
			</div>
			<!--<div>наличие <?=$available?></div>
			<div>номер <?=$id?></div>-->
			<div class = "product_brand">
				<b>Бренд:</b> <?=$brand?>
				<img src = "<?=$brand_img?>" alt = "Изображение" />
			</div>
			<div class = "add_basket button_add_basket" data-basket="<?=$id?>">
				В корзину
			</div>
		</div>
	</div>
	<?php if ($foto) { ?>
	<div class = "row product_fotos">
		<?php foreach($foto as $f) { ?>
		<div>
			<img src = "<?=$f->url?>" alt = "Изображение" />
		</div>
		<?php } ?>
	</div>
	<?php } ?>
</section>