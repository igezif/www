<div id="pagination">
	<p>
		<?php for ($i = 0; $i < count($this->pages); $i++) { ?>
		<a href="<?=$this->pages[$i]["link"]?>" id="<?=$this->pages[$i]["id"]?>"><?=$this->pages[$i]["number"]?></a>
		<?php } ?>
	</p>
</div>