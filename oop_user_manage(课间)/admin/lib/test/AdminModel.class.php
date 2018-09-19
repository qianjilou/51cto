<?php
	// require( "mysql.class.php" );

	class AdminModel {

		private $tb_name = 'admin';
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
	}

	// $admin = new AdminModel( $mysql );
	// $res = $admin->user_login( "ghost123", "ghost123" );
	// if ( $res ) {	
	// 	echo "ok";
	// } else {
	// 	echo "error";
	// }

?>