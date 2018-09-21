<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>分页演示</title>
</head>
<style>
	.page a{
		padding:5px;
		margin-left:5px;
	}
</style>
<body>
	
</body>
</html>


<?php
	/**
		分页：
		第一个问题：
		100条数据，每页显示20条，一共5页  向上取整
		100条数据，每页显示18条，一共6页  向上取整

		第二个问题：翻页?
			$page_size = 5;
			$p = 1 SELECT * FROM news LIMIT 0,5 ($p -1) * $page_size, $page_size;
			$p = 1 SELECT * FROM news LIMIT 5,5 
			$p = 1 SELECT * FROM news LIMIT 10,5 

		第三个问题：
		1、每次显示的页码数都是8条：$page_step
		2、当前页的前面页面偏移为5条：$page_offset
		3、当前页给一个变量：$cur_page
		4、总数为：$total
		5、起点：$start
		6、终点：$end
		实际情况分析：总数1088条

		第一种情况
		一，如果 $total > $page_step  第一页进来的时候 显示 1 - 8 条
		二，如果 $total < $page_step  第一页进来的时候 显示 1 - $page_step
		三、$cur_page < $page_step - 2 不跳
			$stat = 1;
			$end =  $page_step
	
		第二种状态：
		一、当前页满足什么条件，我们就开始页码偏移
		$cur_page > $page_step -1 , 我们就开始改变页码显示的起点和终点
		$start = $cur_page - $page_offset
		$end = $cur_page - $page_offset + $cur_page




	*/	

	$link = mysql_connect("localhost","root","12345678");
	mysql_select_db("user_system");
	mysql_query("set names utf8");

	$tb_name = 'user';

	$p = !empty( $_REQUEST['p']) ? intval( $_REQUEST['p'] ) : 1;

	$sql = "SELECT COUNT(*) as nums FROM $tb_name";
	$rs = mysql_query($sql);
	$row = mysql_fetch_row($rs);
	$all_arcs = $row[0];


	//假如我们每页显示10条
	$page_size = 10;
	//算出总的页码
	$total = ceil($all_arcs / $page_size);


	$sql = "SELECT * FROM $tb_name WHERE 1 = 1 LIMIT ". ($p - 1) * $page_size . ',' .  $page_size  ." ";
	$res = mysql_query($sql);
	$list  = array();
	while ($row = mysql_fetch_assoc( $res )) {
		$list[] = $row;
	}
	

	echo "<ul>";
	foreach ($list as $arc) {
		echo "<li>{$arc['user_name']}......{$arc['user_password']}.......{$arc['reg_time']}</li>";
	}
	echo "</ul>";

	

	//输出总的页码
	echo "<div class='page'>";
	echo "<a href='page.php?p=1'>首页</a>";
	if ($p > 1) {
		echo "<a href='page.php?p=".($p - 1)."'>上一页</a>";
	}else{
	    echo "<a>上一页</a>";
	}


	$start = '';
	$end = '';
	$page_step = 8;
	$page_offset = 5;
	if ($p < $page_step -1) {
		$start = 1;
		$end = $page_step;
		if ($end > $total) {
			$start = 1;
			$end = $total;
		}
	}else{
		$start = $p - $page_offset;
		$end = $p + $page_step - $page_offset -1;
		if ( $end > $total ) {
			$end = $total;
		}
	}



	for ($ind = $start;$ind <= $end; $ind ++){
		echo "<a href='page.php?p=" . $ind ."'>" .$ind . "</a>";
	}
	if ($p < $total) {
		echo "<a href='page.php?p=".($p + 1)."'>下一页</a>";
	}else{
		echo "<a>下一页</a>";
	}
	
	echo "<a href='page.php?p=".$total."'>尾页</a>";
	echo "</div>";
