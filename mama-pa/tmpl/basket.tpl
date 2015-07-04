<?=$hornav?>
<section class = "content border basket">
	<h1 class = "product_header"><?=$header?></h1>
	<table>
		<tr>
			<td colspan = "2">
				<p id = "basket_text"><?=$text?></p>
			</td>
			<td class = "basket_count center">
				<p>Кол-во</p>
			</td>
			<td class = "basket_price center">
				<p>Цена</p>
			</td>
			<td class = "basket_price center">
				<p>Сумма</p>
			</td>
			<td>
			</td>
		</tr>
		<?php if ($items) { ?>
			<?php foreach ($items as $product) { ?>
			<tr>
				<td class = "basket_image">
					<a class="section_image" href="<?=$product->link?>">
						<img src="<?=$product->img?>" alt="Изображение">
					</a>
				</td>
				<td class = "basket_title">
					<a href="<?=$product->link?>">
						<?=$product->title?>
					</a>
				</td>
				<td class = "basket_count">
					<div>
						<div data-id = "<?=$product->id?>" class="count_basket_arow_wrap count_minus">
							<div class="count_basket_arow_left"></div>
						</div>
						<div data-id = "<?=$product->id?>" class="basket_product_count"><?=$product->count?></div>
						<div data-id = "<?=$product->id?>" class="count_basket_arow_wrap count_plus">
							<div class="count_basket_arow_right"></div>
						</div>
					</div>
				</td>
				<td class = "basket_price center">
					<?=$product->price?> <span class = "rouble">&#8399;</span>
				</td>
				<td class = "basket_price center">
					<span data-id = "<?=$product->id?>" class="basket_product_summ"><?=$product->summ?></span> <span class = "rouble">&#8399;</span>
				</td>
				<td class = "basket_delete center">
					<div class = "del_basket" data-id="<?=$product->id?>">
						Удалить
					</div>
				</td>
			</tr>
			<?php } ?>
		<tr id = "tr_basket_summ">
			<td class = "right" colspan = "4">
				<b>Итого:</b>
			</td>
			<td class = "center">
				<span id = "basket_span_summ"><?=$summ?></span> <span class = "rouble">&#8399;</span>
			</td>
			<td>
			</td>
		</tr>
		<?php } ?>
	</table>
	<?php if ($items) { ?>
	<a class = "button green set_order" href = "<?=$link_order?>">
		Оформить заказ
	</a>
	<?php } ?>
</section>