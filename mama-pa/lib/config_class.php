<?php

abstract class Config {

	const SITENAME = "www.mama-pa.ru";
	const SECRET = "EEE";
	const ADDRESS = "http://mama-pa";
	const ADM_NAME = "Василий Борисович";
	const ADM_EMAIL = "vasilek.php@yandex.ru";
	
	const API_KEY = "DKEL39DL";
	
	const DB_HOST = "localhost";
	const DB_USER = "root";
	const DB_PASSWORD = "123qwe";
	const DB_NAME = "mapa";
	const DB_PREFIX = "xyz_";
	const DB_SYM_QUERY = "?";
	
	const DIR_IMG = "img/";
	const DIR_IMG_PRODUCTS = "img/products/";
	//const DIR_AVATAR = "img/avatars/";
	const DIR_TMPL = "tmpl/";
	const DIR_EMAILS = "tmpl/emails/";
	
	const LAYOUT = "main";
	const FILE_MESSAGES = "text/messages.ini";
	
	const FORMAT_DATE = "%d.%m.%Y %H:%M:%S";
	
	//const COUNT_ARTICLES_ON_PAGE = 3;
	//const COUNT_SHOW_PAGES = 10;
	
	const MIN_SEARCH_LEN = 3;
	const LEN_SEARCH_RES = 255;
	
	const SEF_SUFFIX = ".html";
	
	//const DEFAULT_AVATAR = "default.png";
	const MAX_SIZE_IMG = 51200;
}

?>