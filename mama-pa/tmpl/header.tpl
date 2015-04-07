<header>
	<nav id = "headnav" class = "content">
		<div id = "top_menu_wrap" class = "row">
			<div id = "phone">
				+7-913-781-39-97
			</div>
			<div id="top_menu" class = "row">
				<a href="#">Статус заказа</a>
				<a href="#">Доставка</a>
				<a href="#">Оплата</a>
				<a href="#">Контакты</a>
			</div>
			<div id = "menu_network" class = "row">
				<a href = "#" id = "logo_vk"></a>
				<a href = "#" id = "logo_facebook"></a>
				<a href = "#" id = "logo_twitter"></a>
				<a href = "#" id = "logo_mail"></a>
			</div>
			<div id = "basket">
				<a href = "#"><b>Корзина</b><b>0.00</b></a>
			</div>
		</div>
		<div id = "second_menu_wrap" class = "row">
			<div id = "logo">
				<a href = "/"><img src = "/img/main/logo.png" alt = "Изображение"/></a>
			</div>
			<div id = "second_menu_and_search">
				<div id = "second_menu">
					<div class = "row">
						<?php foreach($menu_items as $item) { ?>
						<a href="<?=$item->link?>"><?=$item->title?></a>
						<?php } ?>
					</div>
				</div>
				<div id = "search">
					<form action = "<?=$link_search?>" name = "search_form">
						<table>
							<tr>
								<td>
									<input name = "search" value = "" placeholder = "Поиск..." />
								</td>
								<td id = "td_search">
									<button><span>Искать</span><span></span></button>
								</td>
							</tr>
						</table>	
					</form>
				</div>
			</div>
		</div>
	</nav>
</header>