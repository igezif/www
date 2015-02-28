<?php
class Config {
	public $secret = "DFSJLFSDLJG";
	public $sitename = "dol-lb.ru";
	public $address = "/";
	public $db_host = "localhost";
	public $db_user = "root";
	public $db_password = "123qwe";
	public $db_name = "vasilek_lb";
	public $db_prefix = "lb_";
	public $sym_query = "{?}";
	
	public $admname = "Василий Борисович";
	public $admemail = "dol-lb@yandex.ru";
	public $adm_login = "Admin";
	public $adm_password = "";
	
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
?>
