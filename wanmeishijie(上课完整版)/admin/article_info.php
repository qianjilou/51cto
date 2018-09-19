<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>分类添加|编辑</title>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<link href="../css/style.css" rel="stylesheet" />
	<link rel="stylesheet" href="../plugin/kindeditor/plugins/code/prettify.css" />
    <script charset="utf-8" src="../plugin/kindeditor/kindeditor.js"></script>
    <script charset="utf-8" src="../plugin/kindeditor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="../plugin/kindeditor/plugins/code/prettify.js"></script>
    <script>
        KindEditor.ready(function(K) {
                var editor1 = K.create('textarea[name="content"]', {
                        cssPath : '../plugin/kindeditor/plugins/code/prettify.css',
                        uploadJson : '../plugin/kindeditor/php/upload_json.php',
            fileManagerJson: '../plugin/kindeditor/php/file_manager_json.php',
            allowFileManager: true,
            afterCreate: function() {
                var self = this;
                K.ctrl(document, 13, function() {
                    self.sync();
                    K('form[name=article_add]')[0].submit();
                });
                K.ctrl(self.edit.doc, 13, function() {
                    self.sync();
                    K('form[name=article_add]')[0].submit();
                });
            }
        });
        prettyPrint();
    });
</script>
</head>
<body>
	<?php
		require( "./init.php" );
		require( "./header.php" );
	?>
	<?php
		$cat = new CategoryModel( $db );

		$articleModel = new ArticleModel( $db );

		if ( isset( $_REQUEST['add'] ) ) {

			$title = htmlspecialchars( trim( $_REQUEST['title'] ), ENT_QUOTES );
			$author = htmlspecialchars( trim( $_REQUEST['author'] ), ENT_QUOTES );
			$cat_id = $_REQUEST['cat_id'];
			$content = htmlspecialchars( trim( $_REQUEST['content'] ), ENT_QUOTES );

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

			$is_show = trim( $_REQUEST['is_show'] );
			$sort = trim( $_REQUEST['sort'] );
			$rec_to_index = trim( $_REQUEST['rec_to_index'] );
			
			$data = array(
				'title' => $title,
				'author' => $author,
				'cat_id' => $cat_id,
				'content' => $content,
				'img_big' => $img_big,
				'img_center' => $img_center,
				'img_small' => $img_small,
				'is_show' => $is_show,
				'sort' => $sort,
				'rec_to_index' => $rec_to_index,
				'publish_time' => date( "Y-m-d H:i:s" ),
			);			
			if ( $articleModel->add_article( $data ) ) {
				echo "<script>alert('文章添加成功!');</script>";
			}else {
				echo "<script>alert('文章添加失败!');</script>";
			}
		}

		if ( isset( $_REQUEST['update'] ) ) {

			$title = htmlspecialchars( $_REQUEST['title'], ENT_QUOTES );
			$author = htmlspecialchars( $_REQUEST['author'], ENT_QUOTES );
			$cat_id = $_REQUEST['cat_id'];
			$content = htmlspecialchars( trim( $_REQUEST['content'] ), ENT_QUOTES );

			$img_big = '';
			$img_center = '';
			$img_small = '';

			$arc_detail = $articleModel->get_arc_info( $_REQUEST['id'] );

			if ( !empty( $_FILES['upload_img']['tmp_name'] ) ) {
					
				$image = new Image( $_FILES['upload_img'], "../upload/" );
				$img_big = $image->upload_img();								
				if ( !empty( $img_big ) ) {
					list( $file_pre, $file_suf ) = explode( ".", $img_big );
					$img_center = $image->make_thumb( "../upload/" . $img_big, "../upload/" . $file_pre . '_center.' . $file_suf, 300, 200 );
					$img_center = substr( strrchr( $img_center, "/" ), 1 );
				}
			}


			$img_big = empty( $img_big ) ? $arc_detail['img_big'] : $img_big;
			$img_center = empty( $img_center ) ? $arc_detail['img_center'] : $img_center;
			$img_small = empty( $img_small ) ? $arc_detail['img_small'] : $img_small;

			$is_show = $_REQUEST['is_show'];
			$sort = $_REQUEST['sort'];
			$rec_to_index = $_REQUEST['rec_to_index'];
			
			$data = array(
				'title' => $title,
				'author' => $author,
				'cat_id' => $cat_id,
				'content' => $content,
				'img_big' => $img_big,
				'img_center' => $img_center,
				'img_small' => $img_small,
				'is_show' => $is_show,
				'sort' => $sort,
				'rec_to_index' => $rec_to_index,
				'publish_time' => date( "Y-m-d H:i:s" ),
			);

			if ( $articleModel->update_article( $_REQUEST['id'], $data ) ) {
				echo "<script>alert('文章更新成功!');</script>";
			}else {
				echo "<script>alert('文章更新失败!');</script>";
			}
		}

		if ( !empty( $_REQUEST['id'] ) ) {
			$arc_info = $articleModel->get_arc_info( $_REQUEST['id'] );			
		}
	?>
	<div class="layout">
		<form action="" method="post" enctype="multipart/form-data">
			<table class="tb w100">
				<tr>
					<?php
						if ( !empty( $arc_info ) ) {
							?>
							<th colspan="2">文章添加</th>
							<?php		
						}else {
							?>
							<th colspan="2">文章编辑</th>
							<?php
						}
					?>
					
				</tr>
				<tr>
					<th>文章标题</th>
					<td><input type="text" name="title" value="<?php if ( !empty( $arc_info ) ) { echo $arc_info['title'];}?>" size=60 /></td>
				</tr>
				<tr>
					<th>作者</th>
					<td>
						<input type="text" name="author" 
						value="<?php
						if ( !empty( $arc_info['author'] ) ) {
							echo $arc_info['author'];
						}
						?>"/>
					</td>
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
											if ( !empty( $arc_info ) ) {
												echo $arc_info['cat_id'] == $v['cat_id'] ? "selected" : "";
											}
										?>
										><?php echo $v['cat_name']; ?></option>
										<?php
										if ( !empty( $v['has_son'] ) ) {
											foreach ( $v['has_son'] as $s_k => $s_v ) {
												?>
												<option value="<?php echo $s_v['cat_id']; ?>"
												<?php
													if ( !empty( $arc_info ) ) {
														echo $arc_info['cat_id'] == $s_v['cat_id'] ? "selected" : "";
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
															if ( !empty( $arc_info ) ) {
																echo $arc_info['cat_id'] == $sv2['cat_id'] ? "selected" : "";
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
					<th>内容</th>
					<td>
						<textarea name="content"><?php echo !empty( $arc_info['cat_id'] ) ? $arc_info['content'] : ""; ?></textarea>
					</td>
				</tr>
				<?php
					if ( !empty( $arc_info['img_center'] ) ) {
						?>
						<tr>
							<th>中图</th>
							<td>
								<img src="../upload/<?php echo !empty( $arc_info['img_center'] ) ? $arc_info['img_center'] : ''; ?>" />				
							</td>
						</tr>
						<?php
					}
				?>
				
				<tr>
					<th>文件上传</th>
					<td><input type="file" name="upload_img" /></td>
				</tr>
				<tr>
					<th>是否显示</th>
					<td>
						<input type="radio" name="is_show" value="0" <?php
						if ( !empty( $arc_info['is_show'] ) ) {
							echo $arc_info['is_show'] == 0 ? "checked" : '';
						}
						 ?>/>否
						
						<input type="radio" name="is_show" value="1" <?php
						if ( !empty( $arc_info['is_show'] ) ) {
							echo $arc_info['is_show'] == 1 ? "checked" : '';
						}
						 ?>/>是
					</td>
				</tr>
				<tr>
					<th>排序</th>
					<td>						
						<input type="text" name="sort" value="<?php if ( !empty( $arc_info['sort'] ) ) { echo $arc_info['sort']; } ?>" />
					</td>
				</tr>
				<tr>
					<th>推荐到首页</th>
					<td>
						<input type="radio" name="rec_to_index" value="0" <?php
							if ( isset( $arc_info['rec_to_index'] ) ) {
								echo ( $arc_info['rec_to_index'] == 0 ) ? "checked" : '';
							}
						 ?> />否
						<input type="radio" name="rec_to_index" value="1"  <?php
							if ( isset( $arc_info['rec_to_index'] ) ) {
								echo ( $arc_info['rec_to_index'] == 1 ) ? "checked" : '';
							}
						 ?>/>是
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<?php
						if ( !empty( $arc_info ) ) {
							?>
							<input type="submit" name="update" value="更新文章" class="btn"/>
							<?php
						}else {
							?>
							<input type="submit" name="add" value="添加文章" class="btn"/>
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