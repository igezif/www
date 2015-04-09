<?php

abstract class Config {

	const SITENAME = "prorab54.ru";
	const SECRET = "EEE";
	const ADDRESS = "http://prorab54.ru";
	const ADM_NAME = "Василий Борисович";
	const ADM_EMAIL = "vasilek.php@yandex.ru";
	
	const API_KEY = "DKEL39DL";
	const REFRESH_KEY = "update113";
	
	const DB_HOST = "localhost";
	const DB_USER = "root";
	const DB_PASSWORD = "123qwe";
	const DB_NAME = "vostok";
	const DB_PREFIX = "";
	const DB_SYM_QUERY = "?";
	
	const DIR_IMG = "/img/";
	const DIR_IMG_PRODUCT = "/img/product/";
	const DIR_IMG_BRAND = "/img/brand/";
	//const DIR_AVATAR = "img/avatar/";
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
	const MAX_SIZE_IMG = 300000;
}