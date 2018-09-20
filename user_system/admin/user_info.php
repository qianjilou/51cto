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
		if (isset($_REQUEST['id'])) {
			$user = new UserModel($db);
			$user_info = $user->get_user_byid($_REQUEST['id']);
			print_r($user_info);
		}
	?>

	<div class="layout">
	<div id="tips"></div>
		<form action="" method="post" id="user_form">
			<table class="w100 tb">
				<tr>
					<td colspan='2' class="size28" >用户注册</td>
				</tr>
				<tr>
					<td class="size28">用户名:</td>
					<td><input type="text" name="user_name" class="size28" id="user_name"></td>
				</tr>
				<tr>
					<td class="size28">密码:</td>
					<td><input type="text" name="user_password" class="size28" id="user_password"></td>
				</tr>
				<tr>
					<td colspan='2' align="center">
						<input type="submit" name="reg" value="注册" class="btn size28">
						<input type="submit" name="login" value="登录" class="btn size28">
					</td>
				</tr>
			</table>

		</form>
		
		
	</div>
</body>
</html>