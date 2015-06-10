<?php foreach ($items as $section) { ?>
	<section class = "content middle">
		<div class = "row section_header">
			<div class = "big_arow"></div>
			<div><h2><?=$section->title?></h2></div>
		</div>
		<div class = "border section_block">
			<div class = "section_ul">
				<ul>
					<?php foreach ($section->categories as $category) { ?>
					<li>
						<a href = "<?=$category->link?>" alt = ""><?=$category->title?></a>
					</li>
					<?php } ?>
				</ul>
			</div>
			<?php foreach ($section->products as $product) { ?>
			<div class = "section_item">
				<div class = "section_info_wrap">
					<a class = "section_image" href = "<?=$product->link?>">
						<img src = "<?=$product->img?>" alt = "Изображение" />
					</a>
					<a href = "<?=$product->link?>" class = "section_description"><?=$product->title?></a>
				</div>
				<div class = "section_price_wrap">
					<div class = "section_price_block">
						Цена: <span class = "section_price_digit"><?=$product->price?></span> 
						<span class = "section_price_word"> <span class = "rouble">&#8399;</span></span>
					</div>
					<div class = "add_basket section_buy row" data-id="<?=$product->id?>">
						<div class = "arow_small"></div>
						<div>В корзину</div>
					</div>
				</div>

			</div>
			<?php } ?>
		</div>
	</section>
<?php } ?>