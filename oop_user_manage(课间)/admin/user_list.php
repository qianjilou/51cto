<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户列表管理</title>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/adddate.js"></script>
	<link rel="stylesheet" href="../css/style.css" />
</head>
<body>
<?php
	require( "init.php" );
?>
	<div class="layout">
		<form action="user_list.php" method="post">
			<input type="text" name="search_user" class="size28" />
			<input type="text" name="search_time" class="size28" onclick="SelectDate( this, 'yyyy-MM-dd' )"/>
			<input type="submit" name="search" value="搜索" class="btn size24" />
		</form>
	</div>
	
	<?php
		if ( isset( $_REQUEST['search_user'] ) ) {
			?>
			<script>
			$( "input[name='search_user']" ).attr( "value", "<?php echo $_REQUEST['search_user']; ?>" );
			</script>
			<?php
		}
	?>

	<div class="layout">
		<div id="tips"></div>
		<table class="tb_name w100 size28" >
			<tr>
				<th colspan="4">用户管理中心</th>
			</tr>
			<tr>
				<td>ID</td>
				<td>用户名</td>
				<td>时间</td>
				<td>操作</td>				
			</tr>
			<?php
				if ( isset( $_REQUEST['act'] ) && $_REQUEST['act'] == "del" ) {
					$user = new UserModel( $db );
					$res = $user->del_user_byid( $_REQUEST['id'] );					
					if ( $res ) {
						?>
						<script>
						$(function(){
							$( "#tips" ).html( "<span class='success'>用户删除成功</span>" );
						});
						</script>
						<?php
					} else {
						?>
						<script>
						$(function(){
							$( "#tips" ).html( "<span class='error'>用户删除失败</span>" );
						});
						</script>
						<?php
					}
				}
			?>

			<?php
				$p = !empty( $_REQUEST['p'] ) ? intval( $_REQUEST['p'] ) : 1;
				$page_size = 10;
				$user = new UserModel( $db );
				$list = $user->get_user_list( $p, $page_size );
				$total = array_pop( $list );
				if ( !empty( $list ) ) {
					foreach ( $list as $u ) {
					?>
					<tr>
						<td><?php echo $u['user_id']; ?></td>
						<td><?php echo $u['user_name']; ?></td>
						<td><?php echo $u['reg_time']; ?></td>
						<td>
							<a href="user_info.php">添加</a>
							<a href="user_info.php?id=<?php echo $u['user_id']; ?>">编辑</a>
							<a href="user_list.php?act=del&id=<?php echo $u['user_id']; ?>">删除</a>
						</td>
					</tr>
					<?php
					}
				}
			?>
		</table>
		<?php
			$page = new Page( $total, $page_size );
			$page->build_page_list();
		?>
	</div>
</body>
</html>