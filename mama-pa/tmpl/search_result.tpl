<?=$hornav?>
<section class = "content border basket">
	<h1 class = "product_header">Результат поиска: "<?=$query?>"</h1>
	<?php if ($error_len) { ?><p id="message_search_result">Слишком короткий поисковый запрос!</p><?php } ?>
	<div id="search_result">
		<p id = "what_search">Что искали: <b><?=$query?></b></p>
		<?php $number = 0; foreach ($data as $d) { $number++; ?>
			<div class="search_item">
				<div class="article_info">
					<ul>
						<li><?=$number?>. <a href="<?=$d->link?>"><b><?=$d->title?></b></a></li>
						<?php if (isset($d->section) || isset($d->category)) { ?>
							<li><?=$d->section->title?><?php if ($d->category) { ?>/<?=$d->category->title?><?php } ?></li>
						<?php } ?>
					</ul>
					<div class="clear"></div>
				</div>
				<div class="search_text"><?=htmlspecialchars_decode($d->description)?></div>
			</div>
		<?php } ?>	
	</div>
</section>