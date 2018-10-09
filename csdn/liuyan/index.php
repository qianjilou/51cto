<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文本式留言板</title>
</head>
<body>
	<center>
		<?php include("./menu.php");?>
		<h3>添加留言</h3>
		<form action="doAdd.php" method="post">
			<table width="380" cellpadding="4">
				<tr>
					<td align="right">标题：</td>
					<td><input type="text" name="title" /></td>
				</tr>
				<tr>
					<td align="right">留言者：</td>
					<td><input type="text" name="author" /></td>
				</tr>
				<tr>
					<td align="right">留言内容：</td>
					<td>
						<textarea name="content" rows="5" cols="30"></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="提交">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" value="重置">
					</td>
				</tr>
			</table>


		</form>
	</center>
</body>
</html>