<?=$hornav?>
<section class = "content border delivery">
	<h1 class = "product_header"><?=$header?></h1>
	<div>
		<p>
			<b>Если Вы желаете приобрести детские товары оптом - нет проблем!</b>
		</p>
		<p class = "line_height">
			Мы являемся официальными дистрибьюторами, таких брендов как:
			<?php foreach($brands as $brand) { ?>
			<a href = "<?=$brand->link?>" class = "opt_link"><?=$brand->title?></a>,
			<?php } ?>
			запросить оптовый прайс и задать вопросы можно по электронной почте <a href = "mailto:shop@mama-pa.ru">shoр@mama-pa.ru</a> и по телефону 8-913-781-З997.
		</p>
	</div>
	<div class = "happy_pay center">
		Удачных покупок!
	</div>
</section>