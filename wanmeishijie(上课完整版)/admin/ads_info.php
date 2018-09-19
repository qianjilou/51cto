<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>轮播模块</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
</head>
<body>
	<?php
		require( "init.php" );
		require( "./header.php" );
	?>
	<?php
		$adsModel = new AdsModel( $db );
		if ( isset( $_REQUEST['add'] ) ) {
			$is_show = $_REQUEST['is_show'];
			$sort = $_REQUEST['sort'];
			$url = $_REQUEST['url'];

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

			$data = array(
				'url' => $url,
				'is_show' => $is_show,
				'sort' => $sort,
				'img_big' => $img_big,
				'img_center' => $img_center,
				'img_small' => $img_small,
			);
			if ( $adsModel->add_ads( $data ) ) {
				echo "<script>alert( '广告添加成功!' );</script>";
			} else {
				echo "<script>alert( '广告添加失败!' );</script>";
			}
		}

		if ( isset( $_REQUEST['update'] ) ) {
			$is_show = $_REQUEST['is_show'];
			$sort = $_REQUEST['sort'];
			$url = $_REQUEST['url'];

			$img_big = '';
			$img_center = '';
			$img_small = '';

			$ads_detail = $adsModel->get_ads_info( $_REQUEST['id'] );

			if ( !empty( $_FILES['upload_img']['tmp_name'] ) ) {
					
				$image = new Image( $_FILES['upload_img'], "../upload/" );
				$img_big = $image->upload_img();								
				if ( !empty( $img_big ) ) {
					list( $file_pre, $file_suf ) = explode( ".", $img_big );
					$img_center = $image->make_thumb( "../upload/" . $img_big, "../upload/" . $file_pre . '_center.' . $file_suf, 300, 200 );
					$img_center = substr( strrchr( $img_center, "/" ), 1 );
				}
			}
			
			$img_big = !empty( $img_big ) ? $img_big : $ads_detail['img_big'];
			$img_center = !empty( $img_center ) ? $img_center : $ads_detail['img_center'];
			$img_small = !empty( $img_small ) ? $img_small : $ads_detail['img_small'];

			$data = array(
				'url' => $url,
				'is_show' => $is_show,
				'sort' => $sort,
				'img_big' => $img_big,
				'img_center' => $img_center,
				'img_small' => $img_small,
			);
			if ( $adsModel->update_ads( $_REQUEST['id'], $data ) ) {
				echo "<script>alert( '广告更新成功!' );</script>";
			} else {
				echo "<script>alert( '广告更新失败!' );</script>";
			}
		}

		if ( !empty( $_REQUEST['id'] ) ) {
			$ads_info = $adsModel->get_ads_info( $_REQUEST['id'] );
		}
	?>
	<div class="layout">
		<form action="" method="post" enctype="multipart/form-data">
			<table class="tb w100">
				<tr>
					<?php
						if ( !empty( $ads_info ) ) {
							?>
							<th colspan="2">广告图片编辑</th>
							<?php
						} else {
							?>
							<th colspan="2">广告图片添加</th>
							<?php
						}
					?>
					
				</tr>
				<tr>
					<th>排序</th>
					<td>
						<input type="text" name="sort" value="<?php if ( !empty( $ads_info ) ) { echo $ads_info['sort']; } ?>"/>
					</td>
				</tr>
				<tr>
					<th>URL</th>
					<td><input type="text" name="url" 
					value="<?php
					if ( !empty( $ads_info ) ) {
						echo $ads_info['url'];
					}
					?>" /></td>
				</tr>
				<tr>
					<th>是否显示</th>
					<td>
						<input type="radio" name="is_show" value="0" 
						<?php 
							if ( isset( $ads_info['is_show'] ) ) {
								echo $ads_info['is_show'] == 0 ? "checked" : '';
							}							
						?>
						 />否
						<input type="radio" name="is_show" value="1" 
						<?php 
							if ( isset( $ads_info['is_show'] ) ) {
								echo $ads_info['is_show'] == 1 ? "checked" : '';
							}
						 ?> />是
					</td>
				</tr>
				<tr>
					<th>中图</th>
					<td>
						<?php
							if ( !empty( $ads_info['img_center'] ) ) {
								?>							
								<img src="../upload/<?php echo $ads_info['img_center']; ?>" />
								<?php
							}
						?>						
					</td>
				</tr>
				<tr>
					<th>文件上传</th>
					<td>
						<input type="file" name="upload_img" />
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<?php
							if ( !empty( $ads_info ) ) {
								?>
								<input type="submit" name="update" value="更新" class="btn" />		
								<?php
							} else {
								?>
								<input type="submit" name="add" value="添加" class="btn" />
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