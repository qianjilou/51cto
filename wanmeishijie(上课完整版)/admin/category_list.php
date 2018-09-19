<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>分类管理</title>
	<link rel="stylesheet" href="../css/style.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
</head>
<body>
	<?php
		require( "init.php" );
		require( "header.php" );
		$cat = new CategoryModel( $db );
		$list = $cat->get_cat_list();
	?>

	<div class="layout">
		<div class="cat_title">
			分类管理
		</div>
		<ul>
			<?php
				if ( !empty( $list ) ) {
					foreach ( $list as $k_lev1 => $v_lev1 ) {
						?>
						<li class="level1">
							<?php echo $v_lev1['cat_name']; ?>
							<span class="oper">
								<a href="category_info.php?id=<?php echo $v_lev1['cat_id'] ?>">编辑</a>
								<a href="category_info.php?id=<?php echo $v_lev1['cat_id'] ?>&act=del">删除</a>
								<a href="category_info.php">添加</a>
							</span>
						</li>
							<ul class="level2" style="border:none;">
								<?php
									if ( !empty( $v_lev1['has_son'] ) ) {
										foreach ( $v_lev1['has_son'] as $k_lev2 => $v_lev2 ) {
											?>
											<li class="level2">
												<?php echo $v_lev2['cat_name']; ?>
												<span class="oper">
													<a href="category_info.php?id=<?php echo $v_lev2['cat_id'] ?>">编辑</a>
													<a href="category_info.php?id=<?php echo $v_lev2['cat_id'] ?>&act=del">删除</a>
													<a href="category_info.php">添加</a>
												</span>
											</li>
												<ul class="level3" style="border:none;">
													<?php
														if ( !empty( $v_lev2['has_son2'] ) ) {
															foreach ( $v_lev2['has_son2'] as $k_lev3 => $v_lev3 ) {
																?>
																	<li class="level3">
																	<?php echo $v_lev3['cat_name']; ?>
																	<span class="oper">
																		<a href="category_info.php?id=<?php echo $v_lev3['cat_id'] ?>">编辑</a>
																		<a href="category_info.php?id=<?php echo $v_lev3['cat_id'] ?>&act=del">删除</a>
																		<a href="category_info.php">添加</a>
																	</span>
																	</li>
																<?php
															}
														}
													?>
												</ul>
											</li>
											<?php
										}
									}
								?>
							</ul>
						</li>
						<?php
					}
				}
			?>			
		</ul>
	</div>
</body>
</html>