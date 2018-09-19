<?php
	// require( "mysql.class.php" );

	function __autoload ( $class ) {
		require( "./" . $class . ".class.php" );
	}
	
	$mysql = new Mysql( "php0625" );
	$admin = new AdminModel( $mysql );
	print_r( $admin );
	print_r( $mysql );
?>