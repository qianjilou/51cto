<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>轮播列表管理</title>
	<link rel="stylesheet" href="../css/style.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
</head>
<body>
	<?php
		require( "init.php" );
		require( "header.php" );
		$articleModel = new ArticleModel( $db );		
		
		$p = isset( $_REQUEST['p'] ) ? intval( $_REQUEST['p'] ) : 1;		
		$total = $articleModel->count_article();
		$page_size = 8;
		$page = new Page( $total, $page_size );

		$list = $articleModel->get_arc_list( $p, $page_size );	
	?>
	<div class="layout">
		<table class="tb w100">
			<tr>
				<th colspan="6">文章管理</th>
			</tr>
			<tr>
				<th>ID</th>
				<th>标题</th>
				<th>是否显示</th>
				<th>分类</th>
				<th>排序</th>
				<th>操作</th>
			</tr>
			<?php
				if ( !empty( $list ) ) {
					foreach ( $list as $k => $v ) {
						?>
						<tr>
							<td><?php echo $v['article_id']; ?></td>
							<td><?php echo $v['title']; ?></td>
							<td><?php echo $v['is_show'] == 0 ? "否" : "是"; ?></td>
							<td><?php echo $v['cat_name']; ?></td>
							<td><?php echo $v['sort']; ?></td>
							<td>
								<a href="article_info.php">添加</a>
								<a href="article_info.php?id=<?php echo $v['article_id']; ?>">编辑</a>
								<a href="article_list.php?id=<?php echo $v['article_id']; ?>&act=del">删除</a>
							</td>
						</tr>
						<?php
					}
				}
			?>
		</table>
		<?php
			$page->build_page_list();
		?>
	</div>
</body>
</html>
