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
<<<<<<< HEAD
		public function get_user_list( $p = '',$page_size=''){
			$sql = "";
			$sql .= "SELECT * FROM {$this->tb_name} WHERE 1 = 1 ";
			$limit = "";
			$where = '';
			$count_sql = '';

			$count_sql = "SELECT COUNT(*) as nums FROM {$this->tb_name} WHERE 1 =1 ";

			$_SERVER['REQUEST_URI'] .= '?';

			if ( !empty($_REQUEST['search_name'])) {
				$where .= " AND user_name LIKE '%{$_REQUEST['search_name']}%' ";
				$sql .= $where;
				var_dump($sql);
				$count_sql .= $where;
				$_SERVER['REQUEST_URI'] .= "&search_name={$_REQUEST['search_name']}";
			}
			
			if ( !empty( $_REQUEST['search_name'] ) ) {
				$where .= " AND DATE_FORMAT ( reg_time , '%Y-%m-%d' ) = '{$_REQUEST['search_time']}'";
				$sql .= $where;
				$count_sql .= $where;
				$_SERVER['REQUEST_URI'] .= "&search_time={$_REQUEST['search_time']}";
			}


			$order = ' ORDER BY user_id ASC ';
			$sql .= $order;

			if ( !empty($p) && !empty($page_size)) {
				$limit .= "LIMIT " . ($p - 1) * $page_size . " , ". $page_size;
				$sql .= $limit;
			}
			// var_dump($sql);

			$total = $this->db->get_col( $count_sql );

			$list = $this->db->get_all($sql);
			array_push( $list, $total );
=======
		public function get_user_list(){
			$sql = "SELECT * FROM {$this->tb_name} WHERE 1 = 1";
			$list = $this->db->get_all($sql);
>>>>>>> a99e61acb65809097032890f6802f1afb471f5b6
			return $list;
		}

		public function get_user_byid($user_id){
			$sql = "SELECT * FROM {$this->tb_name} WHERE user_id = $user_id";
			return $this->db->get_row($sql);
		}

		public function update_user_byid($user_id, $data){
			return $this->db->update($this->tb_name, $data, "WHERE user_id = $user_id");
		}

		public function del_user_byid($user_id){
			return $this->db->query("DELETE FROM {$this->tb_name} WHERE user_id = $user_id");
		}
<<<<<<< HEAD

		public function count_users(){
			return $this->db->get_col("SELECT COUNT(*) AS nums FROM {$this->tb_name} ");
		}
=======
>>>>>>> a99e61acb65809097032890f6802f1afb471f5b6
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