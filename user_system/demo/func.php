<?php
	// print_r( $_SERVER );
	echo "<br/>";
	echo "<br/>";
	echo $_SERVER['REQUEST_URI'];
	echo "<br/>";
	echo "<br/>";
	$url = parse_url( $_SERVER['REQUEST_URI'] );
	print_r( $url );
	echo "<br/>";
	echo "<br/>";
	$args = array();
	$new_url = '';
	if ( isset ($url['query']) ) {
		parse_str( $url['query'] , $args );
		echo "<br/>";
		print_r($args);
		if ( isset( $args['p'] )) {
			unset( $args['p'] );
		}
		print_r($args);
		$new_url = $url['path'] . '?' . http_build_query( $args );
	}

	echo $new_url;

	echo "<br/>";
	print_r($args);