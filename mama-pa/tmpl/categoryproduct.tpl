<?=$hornav?>
<section class = "content border">
	<h1 class = "product_header">
		<?=$title?>
	</h1>
	<div class = "row">
		<div class = "category_ul">
			
		</div>
		<div class = "row section_product_wrap">
			<?php foreach($products as $product) { ?>
			<div class = "section_product_item">
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
	</div>
	<?=$pagination?>
</section>