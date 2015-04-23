<nav class = "content hornav">
	<p>
		<?php $first = true; foreach ($data as $d) { ?>
			<?php if (!$first) { ?> > <?php } ?>
			<?php if ($d->link) { ?><a href="<?=$d->link?>"><?=$d->title?></a><?php } else { ?><?=$d->title?><?php } ?>
		<?php $first = false; } ?>
	</p>
</nav>