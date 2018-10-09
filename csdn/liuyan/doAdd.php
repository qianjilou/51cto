<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文本式留言板</title>
</head>
<body>
	<center>
		<?php include("./menu.php");?>
		<h3>执行添加留言</h3>
		<?php
			//执行留言信息操作

			//1.获取留言信息
			$title = $_POST['title'];
			$author = $_POST['author'];
			$content = $_POST['content'];
			$time = time();//获取时间戳（添加）


			//2.拼装留言信息
			$msg = "{$title}##{$author}##{$content}##{$time}";
			echo $msg;

			//3.将留言信息写入到liuyan.db中
			file_put_contents("./liuyan.db", $msg."@@@",FILE_APPEND);
			//4.输出成功信息

			echo "留言成功";

		?>
	</center>
</body>
</html>