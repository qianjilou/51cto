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
		$adsModel = new AdsModel( $db );		
		
		$p = isset( $_REQUEST['p'] ) ? intval( $_REQUEST['p'] ) : 1;

		$total = $adsModel->count_ads();
		$page_size = 2;
		$page = new Page( $total, $page_size );

		$list = $adsModel->get_ads_list( $p, $page_size );
	?>
	<div class="layout">
		<table class="tb w100">
			<tr>
				<th colspan="6">轮播管理</th>
			</tr>
			<tr>
				<th>广告图片ID</th>
				<th>图片</th>
				<th>是否显示</th>
				<th>链接</th>
				<th>排序</th>
				<th>操作</th>
			</tr>
			<?php
				if ( !empty( $list ) ) {
					foreach ( $list as $k => $v ) {
						?>
						<tr>
							<td><?php echo $v['ads_id']; ?></td>
							<td><img src="../upload/<?php echo $v['img_center']; ?>" width="150" height="100" /></td>
							<td><?php echo $v['is_show'] == 0 ? "否" : "是"; ?></td>
							<td><?php echo $v['url']; ?></td>
							<td><?php echo $v['sort']; ?></td>
							<td>
								<a href="ads_info.php">添加</a>
								<a href="ads_info.php?id=<?php echo $v['ads_id']; ?>">编辑</a>
								<a href="ads_list.php?id=<?php echo $v['ads_id']; ?>&act=del">删除</a>
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
