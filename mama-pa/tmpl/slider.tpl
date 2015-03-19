<div class = "content middle slider">
	<div class = "row border">
		<div class = "slider_image">
			<a href = ""><img src = "img/slider/slideshow.png" alt = "" /></a>
		</div>
		<div class = "slider_content">
			<div class = "slider_description">Коврик интерактивный</div>
			<div class = "slider_name"><b>Веселый тренажер</b></div>
			<a href = ""><div class = "slider_button">Посмотреть</div></a>
		</div>
		<div class = "slider_carousel">
			<a><div class = "slider_product"><img src = "img/products/tovar.png" alt = "" /></div></a>
			<a><div class = "slider_product active_slide"><div class = "slider_arow"></div><img src = "img/products/tovar.png" alt = "" /></div></a>
			<a><div class = "slider_product"><img src = "img/products/tovar.png" alt = "" /></div></a>
		</div>
		
		<div class = "slider_data">
			<?php foreach ($items as $item) { ?>
			<div class = "slider_item">
				<img src = "<?=$item->img?>" alt = "Image" />
				<p class = "name"><?=$item->name?></p>
				<p class = "description"><?=$item->description?></p>
				<p class = "link"><?=$item->link?></p>
			</div>
			<?php } ?>
		</div>
	</div>	
</div>