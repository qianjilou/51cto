<?php
require_once '../config/db.php';
//数据库相关操作函数库

/**
 * @param array $dbConfig 数据库连接配置参数（数组形式）
 */



function initDbConnect($dbConfig = array()){
	//建立数据库连接
	$link = mysqli_connect ("{$dbConfig['db_host']}:{$dbConfig['db_port']}",$dbConfig['db_user'],$dbConfig['db_pswd'],$dbConfig['db_name']);
	if ($link) {
		die('连接失败:').mysql_error($link);
	}
	//
}

function getAllMsgs(){
	initDbConnect()
}