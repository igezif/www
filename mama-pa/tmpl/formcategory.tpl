<?php if ($message) { ?><p class="admin_message"><?=$message?></p><?php } ?>
<form class = "admin_form" name = "<?=$name?>" action = "<?=$action?>" method = "POST" enctype="<?=$enctype?>">
	<div class = "border row">
		<div class = "admin_block"  style = "vertical-align: top;">
			<?php foreach ($inputs as $input) { ?>
				<?php include "f_".$input->type.".tpl"; ?>
			<?php } ?>
		</div>
		<div style = "vertical-align: top;">
			<p style = "text-align: center;">Выберите секцию</p>
			
				<table class = "admin_table" id = "admin_slider_products"> 
					<tr>
						<td>№</td><td>Название</td><td class = "for_radio_td"></td>
					</tr>
					<?php $i = 1; foreach($sections as $section) { ?>
					<tr <?php if(isset($section_id) && $section->id == $section_id) { ?>class = "admin_active_slider_product"<?php } ?>>
						<td><?=$i?></td>
						<td><?=$section->title?></td>
						<td class = "for_radio_td">
							<input name="section_id" type="radio" value="<?=$section->id?>" <?php if(isset($section_id) && $section->id == $section_id) { ?>checked<?php } ?> />
						</td>
					</tr>
					<?php $i++; } ?>
				</table>
			
		</div>
	</div>
</form>