<?=$hornav?>
<section class = "content border">
	<div class = "row for_order_header">
		<div><h1 class = "product_header"><?=$header?></h1></div>
		<div class = "order_summ">
			общая сумма
			<span class = "summ_order_wrap">
				<?=$summ?> 
				<span class="rouble order_rouble">&#8399;</span>
			</span>
		</div>
	</div>	
	<form name = "order_form" action = "<?=$action?>" method = "POST">
		<div class="row row_order_form">
			<div class = "order_form_label"><b>Ваше имя</b></div>
			<div>
				<input type = "text" name = "name" />
			</div>
		</div>
		<div>
			<div class = "order_form_label address_order_form_label"><b>Адрес доставки</b></div>
			<div class = "row row_order_form">
				<div class = "order_form_label">Город</div>
				<div>
					<input type = "text" name = "region" />
				</div>
				<div class = "order_form_label">Индекс</div>
				<div>
					<input type = "text" name = "index" />
				</div>
			</div>
			<div class="row">
				<div class = "order_form_label">Улица</div>
				<div>	
					<input type = "text" name = "street" />
				</div>
				<div class = "order_form_label for_home">Дом</div>
				<div>
					<input type = "text" name = "home" />
				</div>
				<div class = "order_form_label">Квартира</div>
				<div>
					<input type = "text" name = "float" />
				</div>
			</div>
			<div class = "delivery_order_form">
				<div class = "order_form_label"><b>Способ доставки</b></div>
				<div class = "order_form_radio">
					<input type="radio" name="delivery" value="0" checked /> <span class = "order_form_label">Досавка курьером</span>
				</div>
				<div class = "order_form_radio">
					<input type="radio" name="delivery" value="1" /> <span class = "order_form_label">Доставка почтой</span>
				</div>
				<div class = "order_form_radio">
					<input type="radio" name="delivery" value="2" /> <span class = "order_form_label">Самовывоз</span>
				</div>
			</div>
			<input type = "submit" name = "order" display = "none" />
			<div class = "button green set_order">
				Завершить оформление
			</div>
		</div>
	</form>
</section>