<?php
	/*
		封装一个mysql数据库操作类
		OOP机制，设计模式 23种比较经典 工厂模式，单例模式，策略模式等
	 */
	class Mysql {

		private $dbhost;
		private $dbuser;
		private $dbpassword;
		private $dbname;
		public $dbcharset;
		public $dblink;

		public function __construct ( $_dbname, $host = 'localhost',
		 							$user = 'root', $password = 'root' ) {

			$this->dbname = $_dbname;
			$this->dbhost = $host;
			$this->dbuser = $user;
			$this->dbpassword = $password;
			$this->dbcharset = 'utf8';

			//连接数据库
			$this->connect();

			//选数据库
			$this->select_db();

			//设置编码
			$this->set_db_charset();
		}

		public function connect () {
			$this->dblink = mysql_connect( $this->dbhost, $this->dbuser, $this->dbpassword );
		}

		public function select_db () {
			mysql_select_db( $this->dbname );
		}

		public function set_db_charset () {
			$this->query( "set names " . $this->dbcharset );
		}

		public function query ( $sql ) {			
			return mysql_query( $sql );
		}

		//获取到所有数据
		public function get_all ( $sql ) {
			$list = array();
			$res = $this->query( $sql );
			while ( $row = mysql_fetch_assoc( $res ) ) {
				$list[] = $row;
			}
			return $list;
		}

		//获取表中的某一行数据，就是一条记录
		public function get_row ( $sql ) {
			$res = $this->query( $sql );
			return mysql_fetch_assoc( $res );
		}

		//取一个数据,通常用于统计
		public function get_col ( $sql ) {
			$res = $this->query( $sql );
			$row = mysql_fetch_row( $res );
			return $row[0];
		}
		// INSERT INTO 表名(字段1,字段2,字段N....) VALUES ( '值1'，'值2', '值N'..... );
		public function add ( $tb_name, $data ) {
			$sql = '';
			$sql .= "INSERT INTO $tb_name (" . implode( ",", array_keys( $data ) ) . ")";
			$field_values = array_values( $data );
			$sql .= " VALUES (" . implode( ",", $this->add_quote( $field_values ) ) . ")";			
			return $this->query( $sql );
		}

		public function update ( $tb_name, $data, $condition ) {
			$sql = '';
			$sql .= "UPDATE $tb_name SET " . substr( $this->implode_fields( $data ), 0, -1 )
			 . " " . $condition;
			return $this->query( $sql );
		}

		public function implode_fields ( $data ) {	
			$sql = '';
			foreach ( $data as $key => $value ) {
				$sql .= "$key = '$value',";
			}
			return $sql;
		}

		public function add_quote ( $data ) {
			$arr = array();
			foreach ( $data as $key => $value ) {
				$arr[$key] = "'$value'";
			}
			return $arr;
		}
	}

	// $mysql = new Mysql( "php0625" );
	// $res = $mysql->add( 'users', array( 'user_name' => 'bianxingjinggang', 'user_password' => 'bianxingjinggang' ) );
	// var_dump( $res );
	// $arc_list = $mysql->get_all( "SELECT article_id, title FROM article" );
	// print_r( $arc_list );
	// $arc_detail = $mysql->get_row( "SELECT * FROM article WHERE article_id = 1" );
	// print_r( $arc_detail );
	// $nums = $mysql->get_col( "SELECT COUNT(*) AS nums FROM article" );
	// echo $nums . "<br/>";
	
	// $mysql->add( 'article', array( 'title' => '国庆节', 'content' => '过完了' ) );
	// $mysql->update( 'article', array( 'title' => '圣诞节快到了333', 'content' => '工资快到手了333' ), 'WHERE article_id = 3' );
?>