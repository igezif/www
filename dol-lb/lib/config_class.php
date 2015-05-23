<?php
class Config {
	/* DataBase */
	public $db_host = "localhost";
	public $address = "/";
	public $db_user = "root";
	public $db_password = "123qwe";
	public $db_name = "vasilek_lb";
	public $db_prefix = "lb_";
	public $sym_query = "{?}";
	
	/* ------- */
	public $sitename = "dol-lb.ru";
	public $secret = "DFSJLFSDLJG";
	public $admname = "Василий Борисович";
	public $admemail = "vasilek.php@yandex.ru";
	public $admemail2 = "vasilek.php@yandex.ru";
	public $adm_login = "Admin";
	public $adm_password = "";
	public $email = "eee@mail.ru";
	public $phone = "8(383)777 77 77";
	
	public $count_on_page = 3;
	public $count_others = 6;
	
	public $pagination_count = 10;
	
	public $dir_text = "lib/text/";
	public $dir_tmpl = "tmpl/";
	public $dir_tmpl_admin = "admin/tmpl/";
	
	public $max_name = 255;
	public $max_title = 255;
	public $max_text = 65535;
	
	public $max_size_img = 102400;	
}