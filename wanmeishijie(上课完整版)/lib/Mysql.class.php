<?php
	class Mysql {

		private $host; //主机
		private $dbuser; //数据库用户名
		private $dbpassword; //数据库密码
		private $dbname; // 数据库名
		private $charset = 'utf8';
		public $link;

		public function __construct ( $dbname, $host = 'localhost', $dbuser = 'root', $dbpassword = 'root'  ) {

			$this->host = $host;
			$this->dbuser = $dbuser;
			$this->dbpassword = $dbpassword;
			$this->dbname = $dbname;

			//第一步：链接数据库
			$this->connect();

			//第二步：选择数据库
			$this->select_db();

			//第三步：设定数据库编码
			$this->set_db_charset();			
		}

		public function connect () {
			$this->link = mysql_connect( $this->host, $this->dbuser, $this->dbpassword );
		}

		public function select_db () {
			mysql_select_db( $this->dbname );
		}

		public function set_db_charset () {
			$this->query( "set names " . $this->charset );
		}

		public function query( $sql ) {			
			return mysql_query( $sql );
		}

		//取出所有数据
		public function get_all( $sql ) {
			$list = array();
			$res = $this->query( $sql );
			while ( $row = mysql_fetch_assoc( $res ) ) {
				$list[] = $row;
			}
			return $list;
		}

		//取出一行数据
		public function get_row ( $sql ) {			
			$res = $this->query( $sql );			
			return mysql_fetch_assoc( $res );
		}

		//取出一列数据
		public function get_col ( $sql ) {
			$res = $this->query( $sql );
			$row = mysql_fetch_row( $res );
			return $row[0];
		}
		
		public function add ( $tb_name, $data ) {

			$sql = '';
			$sql .= "INSERT INTO $tb_name (";
			$sql .= implode( ",", array_keys( $data ) ) . ")";
			$filed_values = array_values( $data );
			$parse_data = $this->add_quote( $filed_values );
			$sql .= " VALUES (" . implode( ",", $parse_data ) . ")";
			// mysql_query( $sql ) or die ( mysql_error() );
			// echo $sql;die();
			return $this->query( $sql );
		}

		public function update( $tb_name, $data, $condition ) {

			$sql = "";
			$sql .= "UPDATE $tb_name SET ";
			$sql .= $this->implode_fileds( $data ) . " " . $condition;
			// echo $sql;die();
			return $this->query( $sql );
		}

		public function implode_fileds ( $data ) {
			$sql = '';
			foreach ( $data as $key => $v ) {
				$sql .= "$key = '$v',";
			}
			return substr( $sql, 0, -1 );
		}

		public function add_quote ( $data ) {
			$arr = array();
			foreach ( $data as $key => $v ) {
				$arr[$key] = "'$v'";
			}
			return $arr;
		}
	}
	$db = new Mysql( "wanmeishijie" );
?>