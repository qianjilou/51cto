<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>分类添加|编辑</title>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<link href="../css/style.css" rel="stylesheet" />
</head>
<body>
	<?php
		require( "./init.php" );
		require( "./header.php" );
	?>
	<?php
		$cat = new CategoryModel( $db );
		$cat_info = array();
		if ( isset( $_REQUEST['add'] ) ) {
			
			$cat_name = $_REQUEST['cat_name'];
			if ( $cat->has_category( $cat_name ) ) {
				echo "<script>alert('分类已经存在')</script>";				
			} else {
				$cat_id = $_REQUEST['cat_id'];
				$cat_desc = trim( $_REQUEST['cat_desc'] );
				$feature_name = trim( $_REQUEST['feature_name'] );

				$img_big = '';
				$img_center = '';
				$img_small = '';

				if ( !empty( $_FILES['upload_img']['tmp_name'] ) ) {
					
					$image = new Image( $_FILES['upload_img'], "../upload/" );
					$img_big = $image->upload_img();								
					if ( !empty( $img_big ) ) {
						list( $file_pre, $file_suf ) = explode( ".", $img_big );
						$img_center = $image->make_thumb( "../upload/" . $img_big, "../upload/" . $file_pre . '_center.' . $file_suf, 300, 200 );
						$img_center = substr( strrchr( $img_center, "/" ), 1 );
					}
				}

				$is_show = isset( $_REQUEST['is_show'] ) ? $_REQUEST['is_show'] : 1;
				$sort = isset( $_REQUEST['sort'] ) ? $_REQUEST['sort'] : 50;
				$url = isset( $_REQUEST['url']  ) ? $_REQUEST['url'] : '';
				$type= isset( $_REQUEST['type'] ) ? $_REQUEST['type'] : 0;

				$data = array(
					'cat_name' => $cat_name,
					'cat_desc' => $cat_desc,
					'feature_name' => $feature_name,
					'url' => $url,
					'sort' => $sort,
					'is_show' => $is_show,
					'img_big' => $img_big,
					'img_center' => $img_center,
					'img_small' => $img_small,
					'type' => $type,
					'pid' => $cat_id,
				);
				
				if ( $cat->add_category( $data ) ) {
					echo "<script>alert('分类添加成功!')</script>";
				}else {
					echo "<script>alert('分类添加失败!')</script>";
				}
			}
		}

		if ( isset( $_REQUEST['update'] ) ) {
			//更新操作
			$cat_id = $_REQUEST['cat_id'];
			$cat_name = $_REQUEST['cat_name'];
			$cat_desc = trim( $_REQUEST['cat_desc'] );
			$feature_name = trim( $_REQUEST['feature_name'] );

			$img_big = '';
			$img_center = '';
			$img_small = '';

			$cat_info = $cat->get_cat_detail( $_REQUEST['id'] );

			if ( !empty( $_FILES['upload_img']['tmp_name'] ) ) {
				
				$image = new Image( $_FILES['upload_img'], "../upload/" );
				$img_big = $image->upload_img();								
				if ( !empty( $img_big ) ) {
					list( $file_pre, $file_suf ) = explode( ".", $img_big );
					$img_center = $image->make_thumb( "../upload/" . $img_big, "../upload/" . $file_pre . '_center.' . $file_suf, 300, 200 );
					$img_center = substr( strrchr( $img_center, "/" ), 1 );
				}
			}

			$img_big = !empty( $img_big ) ? $img_big : $cat_info['img_big'];
			$img_center = !empty( $img_center ) ? $img_center : $cat_info['img_center'];
			$img_small = !empty( $img_small ) ? $img_small : $cat_info['img_small'];

			$is_show = isset( $_REQUEST['is_show'] ) ? $_REQUEST['is_show'] : 1;
			$sort = isset( $_REQUEST['sort'] ) ? $_REQUEST['sort'] : 50;
			$url = isset( $_REQUEST['url']  ) ? $_REQUEST['url'] : '';
			$type= isset( $_REQUEST['type'] ) ? $_REQUEST['type'] : 0;

			$data = array(
				'cat_name' => $cat_name,
				'cat_desc' => $cat_desc,
				'feature_name' => $feature_name,
				'url' => $url,
				'sort' => $sort,
				'is_show' => $is_show,
				'img_big' => $img_big,
				'img_center' => $img_center,
				'img_small' => $img_small,
				'type' => $type,
				'pid' => $cat_id,
			);
			if ( $cat->update_category( $_REQUEST['id'], $data ) ) {
				echo "<script>alert('更新成功!')</script>";
			} else {
				echo "<script>alert('更新失败!')</script>";
			}
		}

		if ( !empty( $_REQUEST['id'] ) ) {
			//取出信息，编辑操作
			$cat_info = $cat->get_cat_detail( $_REQUEST['id'] );
		}
		
	?>
	<div class="layout">
		<form action="" method="post" enctype="multipart/form-data">
			<table class="tb w100">
				<tr>
					<?php
					if ( !empty( $cat_info ) ) {
						?>
						<th colspan="2">分类编辑</th>
						<?php
					}else {
						?>
						<th colspan="2">分类添加</th>
						<?php
					}
					?>
							
				</tr>
				<tr>
					<th>分类名称</th>
					<td><input type="text" name="cat_name" 
					value="<?php
					if ( !empty( $cat_info ) ) {
						echo $cat_info['cat_name'];
					}
					?>" /></td>
				</tr>
				<tr>
					<th>选择分类</th>
					<td>
						<select name="cat_id">
							<option>请选择</option>
							<option value="0">顶级分类</option>
							<?php
								$cat_list = $cat->get_cat_list();
								if ( !empty( $cat_list ) ) {
									foreach ( $cat_list as $k => $v ) {
										?>
										<option value="<?php echo $v['cat_id']; ?>"
										<?php
											if ( !empty( $cat_info ) ) {
												echo $cat_info['pid'] == $v['cat_id'] ? "selected" : "";
											}
										?>
										><?php echo $v['cat_name']; ?></option>
										<?php
										if ( !empty( $v['has_son'] ) ) {
											foreach ( $v['has_son'] as $s_k => $s_v ) {
												?>
												<option value="<?php echo $s_v['cat_id']; ?>"
												<?php
													if ( !empty( $cat_info ) ) {
														echo $cat_info['pid'] == $s_v['cat_id'] ? "selected" : "";
													}
												?>
												>
												<?php echo str_repeat( "&nbsp", 4 ) . '|--'; ?>
												<?php echo $s_v['cat_name']; ?>
												</option>
												<?php
												if ( !empty( $s_v['has_son2'] ) ) {
													foreach ( $s_v['has_son2'] as $sk2 => $sv2 ) {
														?>
														<option value="<?php echo $sv2['cat_id']; ?>"
														<?php
															if ( !empty( $cat_info ) ) {
																echo $cat_info['pid'] == $sv2['cat_id'] ? "selected" : "";
															}
														?>
														>
														<?php echo str_repeat( "&nbsp", 8 ) . '|--'; ?>
														<?php echo $sv2['cat_name']; ?>
														</option>
														<?php
													}
												}
												?>
												<?php
											}
										}
										?>
										<?php
									}
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<th>分类描述</th>
					<td>
						<textarea name="cat_desc"><?php echo !empty( $cat_info ) ? $cat_info['cat_desc'] : ''; ?></textarea>
					</td>
				</tr>
				<tr>
					<th>特征分类名</th>
					<td><input type="text" name="feature_name" 
					value="<?php
					if ( !empty( $cat_info ) ) {
						echo $cat_info['feature_name'];
					}	
					?>"/></td>
				</tr>
				<tr>
					<th>中图</th>
					<td>
						<?php
							if ( !empty( $cat_info['img_center'] ) ) {
								?>
								<img src="../upload/<?php echo $cat_info['img_center']; ?>" width="300" height="200" />
								<?php
							}
						?>						
					</td>
				</tr>
				<tr>
					<th>文件上传</th>
					<td><input type="file" name="upload_img" /></td>
				</tr>
				<tr>
					<th>是否显示</th>
					<td>
						<input type="radio" name="is_show" value="0"
						 <?php
						 if ( !empty( $cat_info ) ) {
						 	echo $cat_info['is_show'] == 0 ? "checked" : "";
					 	} ?>/>否
						<input type="radio" name="is_show" value="1" <?php
						 if ( !empty( $cat_info ) ) {
						 	echo $cat_info['is_show'] == 1 ? "checked" : "";
					 	} ?>/>是
					</td>
				</tr>
				<tr>
					<th>推荐类型</th>
					<td>						
						<input type="radio" name="type" value="0" <?php
						 if ( !empty( $cat_info ) ) {
						 	echo $cat_info['type'] == 0 ? "checked" : "";
					 	} ?>/>无
						<input type="radio" name="type" value="1" <?php
						 if ( !empty( $cat_info ) ) {
						 	echo $cat_info['type'] == 1 ? "checked" : "";
					 	} ?>/>最新
						<input type="radio" name="type" value="2" 
						<?php
						 if ( !empty( $cat_info ) ) {
						 	echo $cat_info['type'] == 2 ? "checked" : "";
					 	} ?>/>热门
					</td>
				</tr>
				<tr>
					<th>排序</th>
					<td>
						<input type="text" name="sort" 
						value="<?php
						if ( !empty( $cat_info ) ) {
							echo $cat_info['sort'];
						}
						?>"/>
					</td>
				</tr>
				<tr>
					<th>URL</th>
					<td>
						<input type="text" name="url" 
						value="<?php
						if ( !empty( $cat_info ) ) {
							echo $cat_info['url'];
						}
						?>"/>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<?php
							if ( !empty( $cat_info ) ) {
								?>
								<input type="submit" name="update" value="更新分类" class="btn"/>
								<?php		
							} else {
								?>
								<input type="submit" name="add" value="添加分类" class="btn"/>
								<?php
							}
						?>
						
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>