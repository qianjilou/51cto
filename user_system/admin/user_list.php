<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../style/style.css">
	<script type="text/javascript" src="../js/jquery182.js"></script>
	<script type="text/javascript" src="../js/index.js"></script>
<<<<<<< HEAD
	<script type="text/javascript" src="../js/adddate.js"></script>
=======
>>>>>>> a99e61acb65809097032890f6802f1afb471f5b6
</head>
<body>
<?php require ("init.php");?>

	<?php
		if (isset($_REQUEST['action']) && $_REQUEST['action'] = 'del') {
			$user = new UserModel( $db );
			$user->del_user_byid($_REQUEST['id']);
		}

	?>
<<<<<<< HEAD
	<div class="layout">
		<form action="user_list.php" method="post" >
			<input type="text" name="search_name" class="size28">
			<input type="text" name="search_time" class="size28" onclick="SelectDate(this,'yyyy-MM-dd')">
			<input type="submit" name="submit" value="搜索" class="btn">
		</form>

	</div>
=======
>>>>>>> a99e61acb65809097032890f6802f1afb471f5b6

	<div class="layout">
		<table class="tb w100">
			<tr>
				<th colspan="4">用户管理</th>
			</tr>
			<tr>
				<th>用户ID</th>
				<th>用户名</th>
				<th>时间</th>
				<th>操作</th>
			</tr>
			<?php 
				$user = new UserModel($db);
<<<<<<< HEAD
				$p = !empty($_REQUEST['p']) ? intval( $_REQUEST['p'] ) : 1;
				// $total = $user->count_users();
				$page_size = 20;

				$list = $user->get_user_list($p , $page_size);
				$total = array_pop( $list );
=======
				$list = $user->get_user_list();
>>>>>>> a99e61acb65809097032890f6802f1afb471f5b6
				if (!empty($list)) {
					foreach ($list as $u) {
						?>
						<tr>
							<td><?php echo $u['user_id'];?></td>
							<td><?php echo $u['user_name'];?></td>
							<td><?php echo $u['reg_time'];?></td>
							<td>
								<a href="user_info.php">添加</a>
								<a href="user_info.php?id=<?php echo $u['user_id'];?>">编辑</a>
								<a href="user_list.php?action=del&id=<?php echo $u['user_id'];?>">删除</a>

							</td>
						</tr>
						<?php
					}
				}
			?>
		</table>
<<<<<<< HEAD

		<?php
			$page = new Page( $total ,$page_size );
			$page->build_page_list();
		?>

=======
>>>>>>> a99e61acb65809097032890f6802f1afb471f5b6
	</div>
</body>
</html>