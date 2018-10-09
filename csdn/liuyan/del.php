<?php date_default_timezone_set('PRC'); //设置中国时区 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>删除留言</title>
</head>
<body>

	<center>
		<?php include("./menu.php");?>

		<h3>删除留言</h3>

		<?php
			//执行留言信息删除操作

			//1. 获取要删除的留言信息id号
			$id = $_GET['id'];
			//2. 读取留言信息，并去掉后面的多余的@符
			$info = rtrim(file_get_contents("./liuyan.db"),"@");

			//3. 拆分留言，使用分隔符“@@@”
			$list = explode("@@@", $info);

			//4. 删除对应的留言数据
			unset($list[$id]);
			//5. 拼装后写回留言文件中
			file_put_contents("liuyan.db", implode("@@@", $list)."@@@");

			//6. 输出成功提醒


		?>
	</center>

</body>
</html>