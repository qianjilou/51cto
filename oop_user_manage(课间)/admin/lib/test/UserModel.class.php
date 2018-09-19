<?php
	require( "mysql.class.php" );

	class UserModel {

		private $tb_name = 'users';
		private $user_name;
		private $user_password;
		public $db;

		public function __construct ( &$db, $name = '', $password = '' ) {
			$this->user_name = $name;
			$this->user_password = $password;
			$this->db = $db;
		}

		//用户登录行为
		public function user_login ( $user_name, $user_password ) {
			$sql = "SELECT * FROM {$this->tb_name} WHERE user_name = '$user_name' AND user_password = '$user_password'";
			$res = $this->db->get_row( $sql );
			if ( $res ) {
				return true;
			} else {
				return false;
			}
		}

		//判断有没有这个用户
		public function has_user ( $user_name ) {
			$sql = "SELECT * FROM {$this->tb_name} WHERE user_name = '$user_name'";			
			$res = $this->db->get_row( $sql );			
			if ( $res ) {
				return true;
			} else {
				return false;
			}
		}

		//用户注册行为
		public function add_user ( $user_name, $user_password ) {
			
			if ( $this->has_user( $user_name ) ) {
				return false;
			} else {
				$cur_time = date( "Y-m-d H:i:s", time() );
				$res = $this->db->add( $this->tb_name, array( 'user_name' => $user_name, 'user_password' => $user_password,'reg_time' => $cur_time ) );
				return $res;
			}
		}

		//取出所有用户
		public function get_user_list ( $cur_page = '', $page_size = '' ) {
			
		}

		//取出一条用户信息
		public function get_user_byid ( $user_id ) {
			$sql = "SELECT * FROM {$this->tb_name} WHERE user_id = $user_id";
			return $this->db->get_row( $sql );
		}

		//更新一条用户信息
		public function update_user_byid ( $user_id, $data ) {
			return $this->db->update( $this->tb_name, $data, "WHERE user_id = $user_id" );			
		}

		//删除用户
		public function del_user_byid ( $user_id ) {
			return $this->db->query( "DELETE FROM {$this->tb_name} WHERE user_id = $user_id" );
		}
	}

	$user = new UserModel( $mysql );
	// $res = $user->add_user( "bianxingjinggang", "bbxxjjgg" );
	// $res = $user->user_login( "bianxingjinggang", "bbxxjjgg" );
	
	// if ( $res ) {
	// 	echo "ok";
	// } else {
	// 	echo "error";
	// }	
	// $res = $user->update_user_byid( 235, array( 'user_name' => 'jinggangbianxing' ) );
	$res = $user->del_user_byid( 235 );
	if ( $res ) {
		echo "ok";
	} else {
		echo "error";
	}	

?>