<?php
	function __autoload ( $class ) {
		require( "./lib/" . $class . ".class.php" );
	}
	$db = new Mysql( "user_system" );
?>