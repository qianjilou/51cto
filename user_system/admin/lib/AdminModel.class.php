<?php
header('Content-Type:text/html;charset=utf-8');
date_default_timezone_set('PRC'); //设置中国时区 

	class AdminModel{
		private $name;
		private $password;
		private $tb_name = 'admin';
		private $db;

		public function __construct( &$db, $name = '', $password = ''){
			$this->db = $db;
			$this->name = $name;
			$this->password = $password;

		}

		

		public function admin_login($name, $password){
			$sql = "SELECT * FROM {$this->tb_name} WHERE admin_user = '$name' AND admin_password = '$password'";
			$res = $this->db->get_row($sql);
			if ($res) {
				return true;
			}else{
				return false;
			}
		}
	
	}
		