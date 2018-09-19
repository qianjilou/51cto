<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户编辑</title>
	<link rel="stylesheet" href="../css/style.css" />
	<script type="text/javascript" src="../js/jquery.min.js"></script>
</head>
<body>
<?php
	require( "init.php" );
?>


	<div class="layout">
	<div id="tips"></div>
	<?php
		if ( isset( $_REQUEST['add'] ) ) {
			$user = new UserModel( $db );
			$user_name = trim( $_REQUEST['user'] );
			$user_password = trim( $_REQUEST['password'] );
			$res = $user->add_user( $user_name, $user_password );
			if ( $res ) {
				?>
				<script>
				$(function(){
					$( "#tips" ).html( "<span class='success'>用户添加成功</span>" );
				});
				</script>
				<?php
			} else {
				?>
				<script>
				$(function(){
					$( "#tips" ).html( "<span class='error'>用户添加失败</span>" );
				});
				</script>
				<?php
			}
		}

		if ( isset( $_REQUEST['update'] ) ) {
			$user = new UserModel( $db );
			$user_name = trim( $_REQUEST['user'] );
			$user_password = trim( $_REQUEST['password'] );
			$data = array( 'user_name' => $user_name, 'user_password' => $user_password );
			$res = $user->update_user_byid( $_REQUEST['id'], $data );
			if ( $res ) {
				?>
				<script>
				$(function(){
					$( "#tips" ).html( "<span class='success'>用户更新成功</span>" );
				});
				</script>
				<?php
			} else {
				?>
				<script>
				$(function(){
					$( "#tips" ).html( "<span class='error'>用户更新失败</span>" );
				});
				</script>
				<?php
			}
		}

		if ( !empty( $_REQUEST['id'] ) ) {
			$user = new UserModel( $db );
			$user_info = $user->get_user_byid( $_REQUEST['id'] );
		}
	?>
		<form action="" method="post">
			<table class="tb w100 size28">
				<tr>					
					<th colspan="2"><?php echo !empty( $user_info ) ? "用户编辑" : "用户添加"; ?></th>
				</tr>
				<tr>
					<th>用户名:</th>
					<td><input type="text" name="user" id="user" class="size24" 
					value="<?php echo !empty( $user_info['user_name'] ) ? $user_info['user_name'] : ''; ?>" /></td>
				</tr>
				<tr>
					<th>密码:</th>
					<td><input type="text" name="password" id="password" class="size24" ]
					value="<?php echo !empty( $user_info['user_password'] ) ? $user_info['user_password'] : ''; ?>" /></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<?php
							if ( !empty( $user_info ) ) {
								?>
								<input type="submit" name="update" id="update" value="编辑" class="btn size28"/>
								<?php
							} else {
								?>
								<input type="submit" name="add" id="add" value="添加" class="btn size28"/>
								<?php
							}
						?>
						
					</td>
				</tr>
				<input type="hidden" id="id" name="id" 
				value="<?php echo !empty( $user_info['user_id'] ) ? $user_info['user_id'] : ''; ?>" />
			</table>			
		</form>		
	</div>
</body>
</html>