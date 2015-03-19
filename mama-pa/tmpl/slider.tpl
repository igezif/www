<div class = "content middle">
	<div class = "row border" id = "slider">
		<div id = "slider_data">
			<?php foreach ($items as $item) { ?>
			<div class = "slider_item">
				<img src = "<?=$item->img?>" alt = "Image" />
				<p class = "name"><?=$item->name?></p>
				<p class = "description"><?=$item->description?></p>
				<p class = "link"><?=$item->link?></p>
			</div>
			<?php } ?>
		</div>
		
		
		<!-- <div id = "slider_image">
			<a href = ""><img src = "/img/slider/1.jpg" alt = "" /></a>
		</div>
		<div id = "slider_content">
			<div id = "slider_description">бcfbdfghdfgdfgd dfgdfg dfgdfgdfg оты</div>
			<div id = "slider_name"><b>боты dfgdfgd dfgdfgfhfghfgn fgfghrt ghrthrthrthhhhhhh hhhhhhhhhhhhh hhhhhhhhhhhhhh hhhhhhhh hhhhhhhhh</b></div>
			<a href = ""><div id = "slider_button">Посмотреть</div></a>
		</div>
		<div id = "slider_carousel">
			<a><div class = "slider_product"><img src = "/img/slider/2.jpg" alt = "" /></div></a>
			<a><div class = "slider_product" id = "active_slide"><div id = "slider_arow"></div><img src = "/img/slider/1.jpg" alt = "" /></div></a>
			<a><div class = "slider_product"><img src = "/img/slider/3.jpg" alt = "" /></div></a>
		</div> -->
		
		
	</div>	
</div>