<?php
	if ( !empty( $_SESSION['admin_user'] ) && !empty( $_SESSION['admin_password'] ) ) {
		$admin = new AdminModel( $db );
		if ( !$admin->admin_login( $_SESSION['admin_user'], $_SESSION['admin_password']) ) {
			header( "Location:index.php" );
		}
		echo "欢迎您：{$_SESSION['admin_user']} | <a href='logout.php'>推出登录</a>";
	}else{
		header("Location:index.php");
	}

?>