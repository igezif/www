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
	<form id = "order_form" name = "order_form" action = "<?=$action?>" method = "POST">
		<div class="row row_order_form">
			<div class = "order_form_label"><b>Ваше имя</b></div>
			<div>
				<input type = "text" name = "name" data-type = "text" />
			</div>
		</div>
		<div class="row row_order_form">
			<div class = "order_form_label"><b>Ваш Email</b></div>
			<div>
				<input type = "text" name = "email" data-type = "email" />
			</div>
		</div>
		<div class="row row_order_form">
			<div class = "order_form_label"><b>Ваш телефон</b></div>
			<div>
				<input type = "text" name = "phone" data-type = "phone" />
			</div>
			
		</div>
		<div>
			<div class = "order_form_label address_order_form_label"><b>Адрес доставки</b></div>
			<div class = "row row_order_form">
				<div class = "order_form_label">Город</div>
				<div>
					<input type = "text" name = "region" data-type = "text" />
				</div>
				<div class = "order_form_label">Индекс</div>
				<div>
					<input type = "text" name = "index" data-type = "integer" />
				</div>
			</div>
			<div class="row">
				<div class = "order_form_label">Улица</div>
				<div>	
					<input type = "text" name = "street" data-type = "text" />
				</div>
				<div class = "order_form_label for_home">Дом</div>
				<div>
					<input type = "text" name = "home" data-type = "text" />
				</div>
				<div class = "order_form_label">Квартира</div>
				<div>
					<input type = "text" name = "float" />
				</div>
			</div>
			<div class = "delivery_order_form">
				<div class = "order_form_label"><b>Способ доставки</b></div>
				<div class = "order_form_radio">
					<input type="radio" name="delivery" value="Доставка курьером" checked /> <span class = "order_form_label">Доставка курьером</span>
				</div>
				<div class = "order_form_radio">
					<input type="radio" name="delivery" value="Доставка транспортной организацией" /> <span class = "order_form_label">Доставка транспортной организацией</span>
				</div>
				<div class = "order_form_radio">
					<input type="radio" name="delivery" value="Самовывоз" /> <span class = "order_form_label">Самовывоз</span>
				</div>
			</div>
			<div class = "pay_order_form">
				<div class = "order_form_label"><b>Способ оплаты</b></div>
				<div class = "order_form_radio">
					<input type="radio" name="pay" value="Наличными при получении" checked /> <span class = "order_form_label">Наличными при получении</span>
				</div>
				<div class = "order_form_radio">
					<input type="radio" name="pay" value="На карту Сбербанка" /> <span class = "order_form_label">На карту Сбербанка</span>
				</div>
				<!--<div class = "order_form_radio">
					<input type="radio" name="pay" value="3" /> <span class = "order_form_label">Сервис ROBOKASSA</span>
				</div>-->
			</div>
			<input type = "submit" name = "order" class="button green set_order" value = "Завершить оформление" />
		</div>
	</form>
</section>