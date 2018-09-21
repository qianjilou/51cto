<?php 
	require ("init.php");

	//向user_system数据库中的user表中插入1000条数据
	$user = new UserModel( $db );
	$user_info = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	//
	for ($ind=0; $ind < 1000; $ind++) { 
		$name = substr( $user_info, mt_rand( 0, strlen($user_info) - 7) , 6);
		$password = substr( $user_info, mt_rand( 0, strlen($user_info) - 7) , 6);
		$user->add_user( $name, $password);
	}
 ?>