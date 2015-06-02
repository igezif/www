<?php

abstract class Config {
	/* DataBase */
	const DB_HOST = "localhost";
	const DB_USER = "root";
	const DB_PASSWORD = "123qwe";
	const DB_NAME = "wm28081_mama-pa";
	const DB_PREFIX = "xyz_";
	const DB_SYM_QUERY = "?";
	/* ------- */

	const SITENAME = "www.mama-pa.ru";
	const SECRET = "EEE";
	const ADDRESS = "http://www.mama-pa.ru";
	const ADM_NAME = "Козлов Андрей";
	const ADM_EMAIL = "shop@mama-pa.ru";
	const ADM_EMAIL2 = "belo-zhenya@yandex.ru";
	const ADM_EMAIL3 = "vasilek.php@yandex.ru";
	
	const API_KEY = "DKEL39DL";
	const REFRESH_KEY = "update113";
	
	const DIR_IMG = "/img/";
	const DIR_IMG_PRODUCT = "/img/product/";
	const DIR_IMG_FSAPRODUCT = "/img/fsa-product/";
	const DIR_IMG_BRAND = "/img/brand/";
	//const DIR_AVATAR = "img/avatar/";
	const DIR_TMPL = "tmpl/";
	const DIR_EMAILS = "tmpl/emails/";
	
	const LAYOUT = "main";
	const FILE_MESSAGES = "text/messages.ini";
	
	const FORMAT_DATE = "%d.%m.%Y %H:%M:%S";
	
	const COUNT_PRODUCTS_ON_PAGE = 9;
	const COUNT_SHOW_PAGES = 10;
	
	const MIN_SEARCH_LEN = 3;
	const LEN_SEARCH_RES = 255;
	
	const SEF_SUFFIX = ".html";
	
	//const DEFAULT_AVATAR = "default.png";
	const MAX_SIZE_IMG = 300000;
}