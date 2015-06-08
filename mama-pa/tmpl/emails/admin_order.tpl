Здравствуйте!

На сайте <?=$site?> сделана покупка,<br />
покупатель: <?=$name?><br />
email: <?=$email?><br />
телефон: <?=$phone?><br />
адрес: <?=$address?><br />
комментарии: <?=$notice?><br />
способ оплаты: <?=$pay?><br />
способ достаки: <?=$delivery?><br /><br />
Выбраны следующие товары:
<table border="1"><tr><td><b>id</b></td><td><b>Наименование</b></td><td><b>цена</b></td></tr><?php foreach ($products as $product) { ?><tr><td><?=$product->id?></td><td><?=$product->title?></td><td><?=$product->price?></td></tr><?php } ?></table>
<b>Общая сумма покупок: <?=$summ?> рублей</b>