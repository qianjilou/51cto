<?php
header('Content-Type:text/html;charset=utf-8');
date_default_timezone_set('PRC'); //设置中国时区 

	class UserModel{
		private $name;
		private $password;
		private $tb_name = 'user';
		private $db;

		public function __construct( &$db, $name = '', $password = ''){
			$this->db = $db;
			$this->name = $name;
			$this->password = $password;

		}

		public function add_user( $name, $password){
			if ($this->has_user( $name )) {
				return false;
			}else{
				$cur_time = date( "Y-m-d H:i:s", time() );
				$data = array('user_name' => $name,'user_password' => $password,'reg_time'=>$cur_time );
				return $this->db->add($this->tb_name,$data);
			}

		}

		public function has_user($name){
			$sql = "SELECT * FROM {$this->tb_name} WHERE user_name = '$name'";
			$row = $this->db->get_row($sql);
			if ($row) {
				return true;
			}else{
				return false;				
			}
		}

		public function user_login($name, $password){
			$sql = "SELECT * FROM {$this->tb_name} WHERE user_name = '$name' AND user_password = '$password'";
			$res = $this->db->get_row($sql);
			if ($res) {
				return true;
			}else{
				return false;
			}
		}
		public function get_user_list(){
			$sql = "SELECT * FROM {$this->tb_name} WHERE 1 = 1";
			$list = $this->db->get_all($sql);
			return $list;
		}

		public function get_user_byid($user_id){
			$sql = "SELETC * FROM {$this->tb_name} WHERE user_id = $user_id";
			return $this->db->get_row($sql);
		}
	}

	// $user = new UserModel( $db );
	// // $data = array('user_name' => 'qitiandasheng','user_password' => 'bimawen');
	// $user_name = 'qitiandasheng';
	// $user_password = 'bimawen123';
	// // $res = $user->add_user($user_name,$user_password);
	// // if ($res) {
	// // 	echo "OK";	
	// // }else{
	// // 	echo "ERROR";
	// // }
	// $res = $user->user_login($user_name,$user_password);
	// if ($res) {
	// 	echo "OK";	
	// }else{
	// 	echo "ERROR";
	// }