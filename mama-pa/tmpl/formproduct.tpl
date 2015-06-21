<?php if ($message) { ?><p class="admin_message"><?=$message?></p><?php } ?>
	<form class = "border row admin_form" name = "<?=$name?>" action = "<?=$action?>" method = "POST" enctype="<?=$enctype?>">
		<div class = "admin_block"  style = "vertical-align: top;">
			<?php foreach ($inputs as $input) { ?>
				<?php include "f_".$input->type.".tpl"; ?>
			<?php } ?>
		</div>
		<div>
			<div style = "vertical-align: top; margin: 10px 0 0 0;">
				<p style = "margin: 0 0 0 10px;">Выберите категорию</p>
				<table class = "admin_table"> 
					<tr>
						<td>№</td><td>Название</td><td class = "for_radio_td"></td>
					</tr>
					<?php $i = 1; foreach($categories as $category) { ?>
					<tr <?php if(isset($category_id) && $category->id == $category_id) { ?>class = "admin_active_slider_product"<?php } ?>>
						<td><?=$i?></td>
						<td><?=$category->title?></td>
						<td class = "for_radio_td">
							<input name="category_id" type="radio" value="<?=$category->id?>" <?php if(isset($category_id) && $category->id == $category_id) { ?>checked<?php } ?> />
						</td>
					</tr>
					<?php $i++; } ?>
				</table>
			</div>
			<div style = "vertical-align: top; margin: 10px 0 0 0;">
				<p style = "margin: 10px 0 0 10px;">Выберите бренд</p>
				<table class = "admin_table"> 
					<tr>
						<td>№</td><td>Название</td><td class = "for_radio_td"></td>
					</tr>
					<?php $i = 1; foreach($brands as $brand) { ?>
					<tr <?php if(isset($brand_id) && $brand->id == $brand_id) { ?>class = "admin_active_slider_product"<?php } ?>>
						<td><?=$i?></td>
						<td><?=$brand->title?></td>
						<td class = "for_radio_td">
							<input name="brand_id" type="radio" value="<?=$brand->id?>" <?php if(isset($brand_id) && $brand->id == $brand_id) { ?>checked<?php } ?> />
						</td>
					</tr>
					<?php $i++; } ?>
				</table>
			</div>
		</div>
	</form>
	<?php if(isset($fotos)) { ?>
	<div class = "dop_admin_foto row border">
		<p>Фотографии</p>
		<?php foreach($fotos as $foto) { ?>
		<div class = "wrap_dop_admin_foto">
			<a href = "<?=$foto->link_delete?>">Удалить</a>
			<img src = "<?=$foto->url?>" alt = "Изображение" />
		</div>
		<?php } ?>
		<form name = "form_for_small_img" action = "<?=$action?>" method = "POST" enctype="<?=$enctype?>">
			<input type = 'file' name = 'small_img' id = 'input_file' />
			<input type="submit" name="upload_small_img" value="Сохранить">
		</form>
	</div>
	<?php  } ?>
</div>