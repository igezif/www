<?=$hornav?>
<section class = "content border">
	<div class = "row">
		<div class = "product_img">
			<h1 class = "product_header">
				<?=$title?>
			</h1>
			<div id = "wrap_big_image"><img src = "<?=$img?>" alt = "Изображение" id = "big_image" /></div>
			<?php if ($foto) { ?>
			<div class = "row product_fotos">
				<?php foreach($foto as $f) { ?>
				<img src = "<?=$f->url?>" alt = "Изображение" class = "gallery_image" />
				<?php } ?>
			</div>
			<?php } ?>
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
	<div class = "product_description">
		<?=$description?>
	</div>
</section>
<section class = "others_content middle">
	<div class = "row section_header">
		<div class = "big_arow"></div>
		<div><h2>C этим товаром также покупают</h2></div>
	</div>
	<div class = "row border others_block center">
		<?php foreach ($others as $product) { ?>
		<div class = "section_item">
			<a class = "section_image" href = "<?=$product->link?>">
				<img src = "<?=$product->img?>" alt = "Изображение" />
			</a>
			<a href = "<?=$product->link?>" class = "section_description"><?=$product->title?></a>
			<div class = "section_price_wrap">
				<div class = "section_price_block">
					Цена: <span class = "section_price_digit"><?=$product->price?></span> 
					<span class = "section_price_word">руб.</span>
				</div>
				<div class = "add_basket section_buy row" data-basket="<?=$product->id?>">
					<div class = "arow_small"></div>
					<div>В корзину</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</section>