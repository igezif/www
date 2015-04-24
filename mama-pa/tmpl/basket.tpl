<section class = "content border basket">
	<h1>Корзина</h1>
	<table>
	<?php foreach ($items as $product) { ?>
		<tr>
			<td>
				<a class="section_image" href="<?=$product->link?>">
					<img src="<?=$product->img?>" alt="Изображение">
				</a>
			</td>
			<td>
				<a href="<?=$product->link?>" alt="Image">
					<?=$product->title?>
				</a>
			</td>
			<td>
				<div>
					<?=$product->price?>
				</div>
			</td>
			<td>
				<div class = "del_basket" data-basket="<?=$product->id?>">
					Удалить
				</div>
			</td>
		</tr>
	<?php } ?>
	</table>
</section>