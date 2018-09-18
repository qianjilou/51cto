<?php
header('Content-Type:text/html;charset=utf-8');
date_default_timezone_set('PRC'); //设置中国时区 
	class Mysql{

		private $host;//主机
		private $dbuser;//数据库用户名
		private $dbpassword;//数据库密码
		private $dbname;
		private $charset = 'utf8';
		public $link;

		public function __construct($dbname,$host='localhost',$dbuser='root',$dbpassword='12345678'){

			$this->host = $host;
			$this->dbuser = $dbuser;
			$this->dbpassword = $dbpassword;
			$this->dbname = $dbname;

			//1.链接数据库
			$this->connect();

			//2.选择数据库
			$this->select_db();

			//3.设定编码
			$this->set_db_charset();

		}

		public function connect(){
			$this->link = mysql_connect($this->host,$this->dbuser,$this->dbpassword);
		}

		public function select_db(){
			mysql_select_db($this->dbname);
		}

		public function set_db_charset(){
			$this->query("set names" . $this->charset);
		}

		public function query($sql){
			return mysql_query($sql);
		}

		//取出所有数据
		public function get_all($sql){
			$list = array();
			$res = $this->query($sql);
			while ($row =mysql_fetch_assoc($res)) {
				$list[] = $row; 
			}
			return $list;
		}

		// 取出一行数据
		public function get_row($sql){
			$res = $this->query($sql);
			return mysql_fetch_assoc($res);
		}


	/*
		array(
			'user_name'=>'bajia',
			'user_password'=>'bajia123',
			'ret_time'=>'2018-10-10 10:10:10'
		);
		假如，我们传一个封装好的表的字段和字段值对应关系数值

		我们最终要处理这个参数成一个sql语句
		INSERT INTO USER(user_name,user_password,reg_time) VALUES('bajie','bajie123','2018-10-10 10:10:10')
	*/


		public function add ($tb_name,$data){
			$sql = '';
			$sql .= "INSERT INTO $tb_name (";
			
			echo "<br>";
			if (is_array($data)) {
				echo "1.是数组"."<br>";
			}else{
				echo "2.不是数组"."<hr>";
			}
			$sql .= implode(",", array_keys($data)) . ")";
			$filed_values = array_values($data);
			$parse_data = $this->add_quote($filed_values);
			$sql .= "VALUES (".implode(",", $parse_data).")";
			var_dump($sql);
			return $this->query( $sql );
		}


		/*
			array(
				user_name => 'rulai',
				user_password => 'rulai123',

			)
			UPDATE USER SET user_name = 'putizushi' WHERE user_id =11
		*/

		public function update($tb_name,$data,$condition){
			$sql = "";
			$sql .= "UPDATE $tb_name SET ";
			$sql .= $this->implode_fileds($data) . " " . $condition;
			return $this->query($sql);
		}


		public function implode_fileds($data){
			$sql= '';
			foreach ($data as $key => $v) {
				$sql .= "$key = '$v',";
			}
			return substr($sql, 0, -1 );
		}

		public function add_quote($data){
			$arr = array();
			foreach ($data as $key => $v) {
				$arr[$key] = "'$v'";
			}
			return $arr;
		}
	}



	$mysql = new Mysql("user_system");
	// $list = $mysql->get_all("SELECT * FROM dede_flink WHERE 1 = 1");
	// print_r($list);
	// $row = $mysql->get_row("SELECT * FROM dede_flink WHERE id = 2");

	//  print_r($row);
	// $cur_time = date("Y-m-d H:i:s",time());
	// $data = array('user_name'=>'bajie','user_password'=>'bajie123','reg_time'=>$cur_time);
	// var_dump($data);
	// $res = $mysql->add("user",$data);
	// var_dump($res);
	// if ($res) {
	// 	echo "ok";
	// }else{
	// 	echo "error";
	// }
	$cur_time = date("Y-m-d H:i:s",time());
	$data = array('user_name'=>'tangtang','user_password'=>'tangtang123','reg_time'=>$cur_time);

	$res = $mysql->update("user",$data,"WHERE user_id = 9");
	var_dump($res);
	if ($res) {
		echo "right";
	}else{
		echo "error";
	}
