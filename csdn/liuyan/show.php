<?php date_default_timezone_set('PRC'); //设置中国时区 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>查看留言</title>
</head>
<body>

	<center>
		<?php include("./menu.php");?>

		<h3>查看留言</h3>

		<table width="700" border="1">
			<tr>
				<td>留言标题</td>			
				<td>留言者</td>			
				<td>留言内容</td>			
				<td>添加时间</td>			
				<td>操作</td>	
			</tr>

			<?php
			//获取留言信息并展示

			//1.读取留言信息
			$info = file_get_contents("./liuyan.db");
			$info = rtrim($info,"@");

			//2.拆分每条留言信息
			$list = explode("@@@",$info);

			//3.遍历每条留言信息
			foreach ($list as $key => $value) {
			//4.拆分每条留言信息中的每个字段信息 ##
				$msg = explode("##", $value);
				echo "<tr>";
				echo "<td>{$msg[0]}</td>";
				echo "<td>{$msg[1]}</td>";
				echo "<td>{$msg[2]}</td>";
				echo "<td>".date("Y-m-d H:i",$msg[3])."</td>";
				echo "<td><a href='del.php?id={$key}'>删除</a></td>";
				echo "</tr>";
				
			}


			?>

		</table>
	</center>

</body>
</html>