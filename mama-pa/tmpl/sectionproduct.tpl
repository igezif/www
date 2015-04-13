<?=$hornav?>
<section class = "content border">
	<h1>
		<?=$title?>
	</h1>
	<div class = "row section_product_wrap">
		<?php foreach($products as $product) { ?>
		<a href = "<?=$product->link?>" class = "section_product_item">
			<div class = "section_image">
				<img src = "<?=$product->img?>" alt = "Изображение" />
			</div>
			<div class = "section_description"><?=$product->title?></div>
			<div class = "section_price_wrap">
				<div class = "section_price_block">
					Цена: <span class = "section_price_digit"><?=$product->price?></span> 
					<span class = "section_price_word">руб.</span>
				</div>
				<div class = "row section_buy"><div class = "arow_small"></div><div>Купить</div></div>
			</div>
		</a>
		<?php } ?>
	</div>
	<?=$pagination?>
</section>