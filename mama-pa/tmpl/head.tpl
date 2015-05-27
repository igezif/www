<head>
	<title><?=$title?></title>
	<?php foreach ($meta as $m) { ?>
		<meta <?php if ($m->http_equiv) { ?>http-equiv<?php } else { ?>name<?php } ?>="<?=$m->name?>" content="<?=$m->content?>" />
	<?php } ?>
	<?php if ($favicon) { ?>
		<link href="<?=$favicon?>" rel="shortcut icon" type="image/x-icon" />
	<?php } ?>
		<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic" />
	<?php foreach ($css as $href) { ?>
		<link type="text/css" rel="stylesheet" href="<?=$href?>" />
	<?php } ?>
	<?php if (isset($js)) { foreach ($js as $src) { ?>
		<script type="text/javascript" src="<?=$src?>"></script>
	<?php } }?>
</head>