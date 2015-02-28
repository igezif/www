<h2>Фотогалерея<br/>ДОЛ "Лазурный берег"</h2>
<table id="gallery">
	<tr>
	<?php for ($i = 0; $i < count($this->gallery); $i++) { ?>
		<td>
			<a href="img/gallery/<?=$this->gallery[$i]["id"].".jpg"?>" data-lightbox="roadtrip" class="img_gallery" title="<?=$this->gallery[$i]["title"]?>"><img src="img/gallery/<?=$this->gallery[$i]["id"].".jpg"?>" alt="Изображение"/></a>
		</td>
		<?php if (($i + 1) % 3 == 0 && $i + 1 != count($this->gallery)) { ?></tr><tr><?php }
			else if ($i + 1 == count($this->gallery)) { ?></tr><?php } ?>
	<?php } ?>
</table>