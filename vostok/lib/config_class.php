<?php

abstract class Config {
	/* DataBase */
	const DB_HOST = "localhost";
	const DB_USER = "root";
	const DB_PASSWORD = "123qwe";
	const DB_NAME = "vostok";
	const DB_PREFIX = "service_";
	const DB_SYM_QUERY = "?";
	/* ------- */

	const SITENAME = "prorab154.ru";
	const SECRET = "EEE";
	const ADDRESS = "http://prorab54.ru";
	const ADM_NAME = "Василий Борисович";
	const ADM_EMAIL = "vasilek.php@yandex.ru";
	const ADM_EMAIL_2 = "lepeshkin_ilya@mail.ru";
	
	const DIR_IMG_HOMES = "/img/homes/";

	const DIR_IMG_VIEWGALLERY = "/img/viewgallery/";

	const DIR_IMG_GALLERY = "/img/gallery/";

	const DIR_IMG_IMGGALLERY = "/img/imggallery/";
	
	const DIR_IMG_COLLECTIVE = "/img/collective/";
	
	const DIR_IMG = "/img/";

	const DIR_TMPL = "tmpl/";
	const DIR_EMAILS = "tmpl/emails/";
	
	const LAYOUT = "main";
	const FILE_MESSAGES = "text/messages.ini";
	
	const FORMAT_DATE = "%d.%m.%Y %H:%M:%S";
	
	const SEF_SUFFIX = ".html";

	const MAX_SIZE_IMG = 300000;
}