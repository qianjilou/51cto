<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户编辑</title>
	<link rel="stylesheet" href="../style/style.css">
	<script type="text/javascript" src="../js/jquery182.js"></script>
	<script type="text/javascript" src="../js/index.js"></script>
</head>
<body>
	<?php require("init.php");?>
	<?php
		if (isset( $_REQUEST['edit'])) {
			$user = new UserModel($db);
			$user_name = trim($_REQUEST['user_name']);
			$user_password = trim($_REQUEST['user_password']);
			$data = array('user_name'=>$user_name,'user_password'=>$user_password );
			if ($user->update_user_byid($_REQUEST['id'] , $data)) {
				echo "OK";
			}else{
				echo "ERROR";
			}
		}

		if (!empty($_REQUEST['id'])) {
			$user = new UserModel($db);
			$user_info = $user->get_user_byid($_REQUEST['id']);
		}
	?>

	<div class="layout">
	<div id="tips"></div>
		<form action="" method="post" id="user_form">
			<table class="w100 tb">
				<tr>
					<td colspan='2' class="size28" >
						<?php echo !empty( $user_info ) ? "用户编辑":"用户添加";?>
					</td>
				</tr>
				<tr>
					<td class="size28">用户名:</td>
					<td><input type="text" name="user_name" class="size28" id="user_name" value="<?php echo !empty($user_info) ? $user_info['user_name']:'';?>"></td>
				</tr>
				<tr>
					<td class="size28">密码:</td>
					<td><input type="text" name="user_password" class="size28" id="user_password" value="<?php echo !empty($user_info) ? $user_info['user_password']:'';?>"></td>
				</tr>
				<tr>
					<td colspan='2' align="center">
						<?php 
							if (!empty($user_info)) {
								?>
									<input type="submit" name="edit" value="编辑" class="btn size28"/>
									<?php
								}else{
									?>
									<input type="submit" name="add" value="添加" class="btn size28"/>
								<?php
								}
						?>
						
						
					</td>
				</tr>
			</table>
			<?php
				if (isset($_REQUEST['add'])) {
					$user = new UserModel($db);
					$user_name = trim($_REQUEST['user_name']);
					$user_password = trim($_REQUEST['user_password']);
					if ($user->add_user($user_name,$user_password)) {
						?>
						<script>
							$(function () {
								$("#tips").html("<span class='success'>添加成功!</span>");
							});
						</script>
						<?php
					}else{
						?>
						<script>
							$(function () {
								$("#tips").html("<span class='error'>添加失败!</span>");
							});
						</script>
						<?php

					}
					

				}
			?>
			<input type="hidden" name="id" value="<?php echo !empty( $user_info ) ? $user_info['user_id'] : '';?>">
		</form>
		
		
	</div>
</body>
</html>