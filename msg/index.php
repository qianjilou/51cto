<?php

//加载函数库
require_once 'model/db.php';

//获取姓名
$name = getName();


//显示视图文件
include 'view/index.html';

