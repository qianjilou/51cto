<div id="menu">
		<div class="layout">
			<a href="#" class="logo">完美世界</a>
			<span class="log_line"></span>
			<h4><span class="icon tit"></span></h4>
			<ul>
				<li>
				<a href="category_list.php" class="on">分类管理</a>
				<a href="article_list.php">文章管理</a>
				<a href="ads_list.php">首页广告管理</a>
				<a href="logout.php">登出</a>
				</li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
</div>
<div class="clear"></div>

<?php
	if ( isset( $_SERVER['SCRIPT_NAME'] ) ) {		
		$cur_file = str_replace( '/', '', strrchr( $_SERVER['SCRIPT_NAME'], '/' ) );
		// echo $cur_file . "<br/>";
		//$prefix: category, article, ads
		list( $prefix ) = explode( '_', $cur_file );
		// echo $prefix;
		?>
		<script>
		$(function(){			
			$("#menu li a").each(function(){				
				if ( /<?php echo $prefix; ?>/.test( $(this).attr( "href" ) ) ) {										
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