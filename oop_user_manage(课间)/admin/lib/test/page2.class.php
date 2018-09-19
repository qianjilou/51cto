<?php
	// print_r( $_SERVER );
	// echo $_SERVER['REQUEST_URI'];
	$url_parse = array();
	$new_url = '';
	$url_parse = parse_url( $_SERVER['REQUEST_URI'] );	
	$arr = array();
	parse_str( $url_parse['query'], $arr );
	// print_r( $arr );
	unset( $arr['p'] );
	// print_r( $arr );
	echo $_SERVER['REQUEST_URI'] . "<br/>";
	$new_url = $url_parse['path'] . '?' . http_build_query( $arr );
	echo $new_url . "<br/>";
?>