<?php if ($message) { ?><p class="admin_message"><?=$message?></p><?php } ?>
<form class = "admin_form" name = "<?=$name?>" action = "<?=$action?>" method = "POST" enctype="<?=$enctype?>" onsubmit="return checkForm(this)">
	<div class = "border row">
		<div class = "admin_block"  style = "vertical-align: top;">
			<?php if(isset($img)) { ?><div class = "admin_img"><?=$img?></div><?php } ?>
			<?php foreach ($inputs as $input) { ?>
				<?php include "f_".$input->type.".tpl"; ?>
			<?php } ?>
		</div>
		<div style = "vertical-align: top;">
			<p style = "text-align: center;">Выберите продукт</p>
			<div style = "height: 1000px; overflow-y: scroll; width: 650px; border: 1px solid #808080;">
				<table class = "admin_table" id = "admin_slider_products"> 
					<tr>
						<td>№</td><td>Название</td><td>Описание</td><td class = "admin_img">Картинка</td><td class = "for_radio_td"></td>
					</tr>
					<?php $i = 1; foreach($products as $product) { ?>
					<tr <?php if(isset($product_id) && $product->id == $product_id) { ?>class = "admin_active_slider_product"<?php } ?>>
						<td><?=$i?></td>
						<td><?=$product->title?></td>
						<td><?=$product->meta_desc?></td>
						<td class = "admin_img"><?=$product->img?></td>
						<td class = "for_radio_td">
							<input name="product_id" type="radio" value="<?=$product->id?>" <?php if(isset($product_id) && $product->id == $product_id) { ?>checked<?php } ?> />
						</td>
					</tr>
					<?php $i++; } ?>
				</table>
			</div>
		</div>
	</div>
</form>