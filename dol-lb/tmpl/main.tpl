<!DOCTYPE html>
<html lang="ru">
<head>
	<title><?=$this->title?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="<?=$this->meta_desc?>" />
	<meta name="keywords" content="<?=$this->meta_key?>" />
	<link rel="stylesheet" href="css/main.css" type="text/css" />
	<link rel="stylesheet" href="css/lightbox.css" type="text/css" />
	<link rel="shortcut icon" href="img/icon.ico" type="image/x-icon" />
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?105"></script>
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/lightbox-2.6.min.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
</head>
<body id="top">
    <div id="conteiner">
        <div id="header">
            <a href="<?=$this->index?>"><img src="img/logo.png" alt="Картинка" class="logo"/></a>
            <img src="img/header.png" alt="Картинка" class="header_right"/>
        </div>
        <div id="main_content">
    		<div id="left">
    			<ul class="leftmenu">
                    <li><a href="<?=$this->link_news?>">Новости</a></li>
                    <li><a href="<?=$this->link_gallery?>">Фотогалерея</a></li>
                    <li><a href="<?=$this->link_reservation?>">Бронирование путёвок</a></li>
                    <li><a href="<?=$this->link_vacancy?>">Вакансии</a></li>
                    <li><a href="<?=$this->link_questions?>">Вопросы</a></li>
                </ul>
                <form action="functions.php" method="post" name="vote_form">
                    <ul class="votemenu">
                        <li class="q"><span><?=$this->vote_title?></span></li>
						<?php for ($i = 0; $i < count($this->vote_variants); $i++) { ?>
							<li><div><input type="radio" name="vote_item" value="<?=$this->vote_variants[$i]["id"]?>"/><?=$this->vote_variants[$i]["title"]?></div></li>
						<?php } ?>
                    </ul>
                    <input type="submit" name="vote" value="Голосовать" id="vote_input"/> 
                </form>    
    		</div>
    		<div id="right">
				<div class="vk">
                    <!-- VK Widget -->
                    <div id="vk_groups"></div>
                    <script type="text/javascript">
                        VK.Widgets.Group("vk_groups", {mode: 0, width: "230", height: "400", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 2748196);
                    </script>
                </div>
    		</div>
    		<div id="center">
    			<ul class="topmenu">
                    <li><a href="<?=$this->index?>">Главная</a></li>
                    <li><a href="<?=$this->link_about?>">О лагере</a></li>
                    <li><a href="<?=$this->link_contacts?>">Контакты</a></li>
                </ul>
				<?php include "content_".$this->content.".tpl"; ?>
    		</div>
    		<div class="clear">
				<?php if ($this->content == "news") include "content_pagination.tpl"; ?>
			</div>
    		<hr/>
    		<div id="footer">
				<table>
					<tr>
						<td><!--LiveInternet counter--><script type="text/javascript"><!--
							document.write("<a href='http://www.liveinternet.ru/click' "+
							"target=_blank><img src='//counter.yadro.ru/hit?t11.15;r"+
							escape(document.referrer)+((typeof(screen)=="undefined")?"":
							";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
							screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
							";"+Math.random()+
							"' alt='' title='LiveInternet: показано число просмотров за 24"+
							" часа, посетителей за 24 часа и за сегодня' "+
							"border='0' width='88' height='31'><\/a>")//--></script><!--/LiveInternet-->
						</td>
						<td>ДОЛ "Лазурный берег" Все права защищены &copy; 2014</td>
					</tr>
				</table>
    		</div>
    	</div>
    </div>
	<p id="back-top">
		<a href="#top"><span></span></a>
	</p>
</body>
</html>