<h2>Новости</h2>
<?php for ($i = 0; $i < count($this->news); $i++) { ?>
	<div class="article">
		<h3><?=$this->news[$i]["title"]?></h3>
		<div class="image">
			<img src = "<?=$this->news[$i]["img_src"]?>" alt = "<?=$this->news[$i]["title"]?>" title = "<?=$this->news[$i]["title"]?>" />
		</div>
		<p><?=$this->news[$i]["intro_text"]?></p>
		<span>
			<?=$this->news[$i]["date"]?>
			<br/>
			<a href="<?=$this->news[$i]["link"]?>">Подробнее</a>
			
		</span>
	</div>
	<hr/>
<?php } ?>

