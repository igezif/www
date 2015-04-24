<?php foreach ($items as $section) { ?>
	<section class = "content middle">
		<div class = "row section_header">
			<div class = "big_arow"></div>
			<div><h2><?=$section->title?></h2></div>
		</div>
		<div class = "row border section_block">
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
				<a class = "section_image" href = "<?=$product->link?>">
					<img src = "<?=$product->img?>" alt = "Изображение" />
				</a>
				<div class = "section_description"><?=$product->title?></div>
				<div class = "section_price_wrap">
					<div class = "section_price_block">
						Цена: <span class = "section_price_digit"><?=$product->price?></span> 
						<span class = "section_price_word">руб.</span>
					</div>
					<div class = "add_basket section_buy row" data-basket="<?=$product->id?>">
						<div class = "arow_small"></div>
						<div>Купить</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</section>
<?php } ?>