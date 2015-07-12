<!DOCTYPE html>
<html>
<?=$head?>
<body>
	<div id = "for_popup_message">
		
	</div>
	<div id = "container">
		<header>
			<nav id = "headnav" class = "content">
				<div id = "top_menu_wrap" class = "row">
					<div id = "phone">
						<a href = "tel:89137813997">+7-913-781-39-97</a>
					</div>
					<div class = "top_menu_delivery">
						<a href = "<?=$link_delivery?>">Оплата/Доставка</a>
					</div>
					<div class = "top_menu_opt">
						<a href = "<?=$link_opt?>">Опт</a>
					</div>
					<div class = "row menu_network">
						<a href = "//vk.com/mama_pa" class = "logo_vk"></a>
						<a href = "#" class = "logo_facebook"></a>
						<a href = "#" class = "logo_twitter"></a>
						<a href = "#" class = "logo_mail"></a>
					</div>
					<a id = "basket" href = "<?=$link_basket?>">
						<div>
							<div>
								<img src = "/img/main/basket.png" alt = "Image" />
							</div>
							<div>Корзина</div>
						</div>
						<div>
							<span id = "span_summ"><?=$summ?></span> 
							<span class = "rouble header_rouble">&#8399;</span>
						</div>
					</a>
				</div>
				<div id = "second_menu_wrap" class = "row">
					<div id = "logo">
						<a href = "/"><img src = "/img/main/logo.png" alt = "Изображение"/></a>
					</div>
					<div id = "second_menu_and_search">
						<div id = "second_menu">
							<div class = "row">
								<a href = "/" <?php if($uri === "/") { ?>class = "active_second_menu_item"<?php } ?>>Главная</a>
								<?php foreach($menu_items as $item) { ?>
								<a href="<?=$item->link?>" <?php if($item->link === $uri) { ?>class = "active_second_menu_item"<?php } ?>><?=$item->title?></a>
								<?php } ?>
							</div>
						</div>
						<div id = "search">
							<form action = "<?=$link_search?>" method = "GET" name = "search_form">
								<table>
									<tr>
										<td>
											<input type = "text" name = "query" placeholder = "Поиск..." />
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
		<?=$content?>
		<div class="hFooter"></div>
	</div>
	<footer>
		<div class = "content footer">
			<div class = "row footer_wrap">
				<div class = "footer_block footer_sections">
					<div class = "footer_header"><b>Секции</b></div>
					<?php foreach($menu_items as $item) { ?>
					<div class = "footer_item">
						<a href="<?=$item->link?>"><?=$item->title?></a>
					</div>
					<?php } ?>
				</div>
				<div class = "footer_block footer_sections">
					<div class = "footer_header"><b>Информация</b></div>
					<div class = "footer_item">
						<a href = "<?=$link_contacts?>">Наши контакты</a>
					</div>
					<div class = "footer_item">
						<a href="mailto:shop@mama-pa.ru" title="Наша почта">shop@mama-pa.ru</a>
					</div>
				</div>
				<div class = "footer_block">
					<script type="text/javascript" src="//vk.com/js/api/openapi.js?116"></script>
					<!-- VK Widget -->
					<div id="vk_groups"></div>
					<script type="text/javascript">
						VK.Widgets.Group("vk_groups", {mode: 0, width: "260", height: "265", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 19668034);
					</script>
				</div>
				<div class = "footer_block footer_sections">
					<div class = "footer_header"><b>Давайте дружить</b></div>
					<div class = "row footer_network">	
						<a href = "//vk.com/mama_pa" class = "logo_vk"></a>
						<a href = "#" class = "logo_facebook"></a>
						<a href = "#" class = "logo_twitter"></a>
						<a href = "#" class = "logo_mail"></a>
					</div>
					<div class = "feedback_block">
						<div class = "feedback_header"><b>Обратная связь</b></div>
						<div class = "footer_item">Если у Вас есть вопросы:</div>
						<form name = "feedback" method = "POST" action = "ajax/feedback">
							<div>
								<input type = "text" name = "email" placeholder = "Ваш Email" data-type = "email" />
							</div>
							<div>
								<input type = "text" name = "phone" data-type = "phone" placeholder = "Ваш телефон" />
							</div>
							<div>
								<textarea placeholder = "Сообщение" name = "message" data-type = "text"></textarea>
							</div>
							<div>
								<button>ОТПРАВИТЬ</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div id = "copyright">Все права защищены &copy; <?=date("Y")?></div>
			<div id = "counter">
				<!-- Yandex.Metrika informer -->
				<a href="https://metrika.yandex.ru/stat/?id=30615942&amp;from=informer"
				target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/30615942/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
				style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:30615942,lang:'ru'});return false}catch(e){}"/></a>
				<!-- /Yandex.Metrika informer -->
				<!-- Yandex.Metrika counter -->
				<script type="text/javascript">
				(function (d, w, c) {
				    (w[c] = w[c] || []).push(function() {
				        try {
				            w.yaCounter30615942 = new Ya.Metrika({id:30615942,
				                    clickmap:true,
				                    trackLinks:true,
				                    accurateTrackBounce:true});
				        } catch(e) { }
				    });

				    var n = d.getElementsByTagName("script")[0],
				        s = d.createElement("script"),
				        f = function () { n.parentNode.insertBefore(s, n); };
				    s.type = "text/javascript";
				    s.async = true;
				    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

				    if (w.opera == "[object Opera]") {
				        d.addEventListener("DOMContentLoaded", f, false);
				    } else { f(); }
				})(document, window, "yandex_metrika_callbacks");
				</script>
				<noscript><div><img src="//mc.yandex.ru/watch/30615942" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
				<!-- /Yandex.Metrika counter -->
			</div>
		</div>
	</footer>
</body>
</html>
