<header>
	<nav id = "headnav" class = "content">
		<div id = "top_menu_wrap" class = "row">
			<div id = "phone">
				<a href = "tel:89137813997">+7-913-781-39-97</a>
			</div>
			<div class = "row menu_network">
				<a href = "#" class = "logo_vk"></a>
				<a href = "#" class = "logo_facebook"></a>
				<a href = "#" class = "logo_twitter"></a>
				<a href = "#" class = "logo_mail"></a>
			</div>
			<a id = "basket" href = "/basket">
				<b>Корзина</b><b id = "summ_header"><span id = "span_summ"><?=$summ?></span> <span class = "rouble header_rouble">&#8399;</span></b>
			</a>
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