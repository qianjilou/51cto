<?php
	class UserModel {

		private $tb_name = 'user';
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

			$sql = '';
			$count_sql = '';
			$where = '';
			$limit = '';

			$sql = "SELECT * FROM {$this->tb_name} WHERE 1 = 1";			
			$count_sql = "SELECT COUNT(*) AS nums FROM {$this->tb_name} WHERE 1 = 1";

			$_SERVER['REQUEST_URI'] .= '?';

			if ( !empty( $_REQUEST['search_user'] ) ) {
				$where .= " AND user_name LIKE '%{$_REQUEST['search_user']}%'";
				$sql .= $where;
				$count_sql .= $where;
				$_SERVER['REQUEST_URI'] .= "&search_user={$_REQUEST['search_user']}";
			}

			if ( !empty( $_REQUEST['search_time'] ) ) {
				$where .= " AND DATE_FORMAT( reg_time, '%Y-%m-%d' ) = '{$_REQUEST['search_time']}'";
				$sql .= $where;
				$count_sql .= $where;
				$_SERVER['REQUEST_URI'] .= "&search_time={$_REQUEST['search_time']}";
			}

			// echo $_SERVER['REQUEST_URI'] . "<br/>";

			$order_by = " ORDER BY user_id ASC";
			$sql .= $order_by;

			if ( !empty( $cur_page ) && !empty( $page_size ) ) {
				$limit .= " LIMIT " . ( $cur_page - 1 ) * $page_size . ',' . $page_size;
				$sql .= $limit;
			}
			

			//取出所有用户用于分页
			$total_users = $this->db->get_col( $count_sql );

			$list = $this->db->get_all( $sql );
			array_push( $list, $total_users );
			return $list;
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

?>