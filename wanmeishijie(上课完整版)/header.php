<?php
	require( "init.php" );
	$cat = new CategoryModel( $db );
	$nav_list = $cat->get_nav_list();
?>
<script type="text/javascript" src="./js/jquery.min.js"></script>
<div id="menu">
	<div class="layout">
		<a href="#" class="logo">完美世界</a>
		<span class="log_line"></span>
		<h4><span class="icon tit"></span></h4>
		<ul>
			<li>
			<a href="index.php" class="on">首页</a>
			<?php
				if ( !empty( $nav_list ) ) {
					foreach( $nav_list as $k => $v ) {
						?>
						<a href="<?php echo $v['url']; ?>"><?php echo $v['cat_name']; ?></a>
						<?php
					}
				}
			?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
</div>

<?php
	if ( isset( $_SERVER['SCRIPT_NAME'] ) ) {		
		$cur_file = str_replace( '/', '', strrchr( $_SERVER['SCRIPT_NAME'], '/' ) );
		// echo $cur_file . "<br/>";
		//$prefix: category, article, ads
		list( $prefix ) = explode( '.', $cur_file );
		// echo $prefix;
		?>
		<script>
		$(function(){			
			$("#menu li a").each(function(){				
				if ( /<?php echo $prefix . '.php'; ?>/.test( $(this).attr( "href" ) ) ) {										
					$(this).attr( "class", "on" );
				} else {
					$(this).attr( "class", "" );
				}
			});
		});
		</script>
		<?php
	}
?>