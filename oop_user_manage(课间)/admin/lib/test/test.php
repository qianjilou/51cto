<?php
	$sql = mysql_connect( "localhost", "root", "root" ) or die( mysql_error() );
	mysql_query( "set names utf8" );
	mysql_select_db( "php0625" );
	$sql = "INSERT INTO users (user_name,user_password,reg_time) VALUES ('bianxingjinggang','bbxxjjgg','2015-10-10 09:51:36')";
	$res = mysql_query( $sql ) or die( mysql_error() );
	var_dump( $res );
?>