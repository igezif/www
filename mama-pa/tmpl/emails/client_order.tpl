Здравствуйте <?=$name?>!

<img style = "height: 150px;" src="http://www.mama-pa.ru/img/main/logo.png" alt = "Image" />
Вами была сделана покупка на сайте <?=$site?><br />
Вы выбрали следующие товары:<br /><br />
<?php foreach ($products as $product) { ?>
<div style="border-bottom: 1px solid #e7e3a7; padding: 0 0 10px 0;"><div><?=$product->title?></div><div><img style = "height: 150px;" src = "http://www.mama-pa.ru/<?=$product->img?>" /></div><div>Цена <?=$product->price?> рублей</div></div>
<?php } ?>
<b>Общая сумма покупок: <?=$summ?> рублей</b>