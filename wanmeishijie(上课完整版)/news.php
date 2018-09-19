<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>完美世界</title>
	<link rel="stylesheet" href="./css/front.css" />
	<link rel="stylesheet" href="./css/css.css" />
	<script type="text/javascript" src="./js/front_common.js"></script>
	<script type="text/javascript" src="./js/front_index.js"></script>
</head>
<body>

	<?php
		require( "header.php" );
			
		$id = isset( $_REQUEST['id'] ) ? $_REQUEST['id'] : 7;
		$p = isset( $_REQUEST['p'] ) ? intval( $_REQUEST['p'] ) : 1;
		$page_size = 5;
		$articleModel = new articleModel( $db );
		$arc_list = $articleModel->get_arc_list( $id, $p, $page_size );
		$cat = new CategoryModel( $db );
		$cat_info = $cat->get_cat_detail( $id );
	?>

	
<div id="wrap">
 <div class="news_top"><?php echo isset( $cat_info['cat_name'] ) ? $cat_info['cat_name'] : ''; ?></div>
 <div class="news_title">您所在的位置：<a href="./index.php">首页</a> > <?php echo isset( $cat_info['cat_name'] ) ? $cat_info['cat_name'] : ''; ?></div>
 <div class="news_content">
	   <div class="news_content_left_title">
	     <ul>
	       <?php
     		
     		$cat_list = $cat->get_product_son_category( 6 );
        
	        $style = '';
	        $font_color = '';
     		if ( !empty( $cat_list ) ) {	
     			foreach ( $cat_list as $k => $v ) {
            if ( $v['cat_id'] == $id ) {
              $style = 'style="background-color:red;"';
              $font_color = "style='color:white;'";
            }else {
              $style = '';
              $font_color = '';
            }              
     				?>
     				<li <?php echo $style; ?>><a <?php echo $font_color; ?> href="news.php?id=<?php echo $v['cat_id']; ?>"><?php echo $v['cat_name']; ?></a></li>			
     				<?php
     			}
     		}
     	?>
	     </ul>
	   </div>
	   <div class="news_content_left_bg">
	   		<?php
	   			if ( !empty( $arc_list ) ) {
	   				foreach ( $arc_list as $k => $v ) {
	   					?>
	   					<div class="news_content_left_news">
						     <dl>
						       <dd><img src="./upload/<?php echo !empty( $v['img_center'] ) ? $v['img_center'] : 'touxiang1023.jpg'; ?>" width="170" height="110"></dd>
						       <dt><span class="news_font01"><a href="news_detail.php?id=<?php echo $id; ?>&arc_id=<?php echo $v['article_id']; ?>"><?php echo $v['title']; ?></a></span><br />
								<?php
								$content = strip_tags( htmlspecialchars_decode( $v['content'], ENT_QUOTES ) );
				                echo $articleModel->sub_str( $content, 100 ) . '...'; 
							 	?>
						<span class="news_font02"><?php  ?></span></dt>
						     </dl>
					   </div>   
	   					<?php
	   				}
	   			}
	   		?>		   
	   </div>
   <div class="news_content_right"><img src="images/news_right.png" width="220" height="136"></div>
   <div style=" clear:both;"></div>
   <?php
   	$total = $articleModel->count_article( $id );
   	$page = new Page( $total, $page_size );
   	$page->build_page_list();
   ?>
 </div>

 <div style=" clear:both;"></div>
</div>

	
	<div class="bottom"><div class="max"><ul class="content"><li><div class="tit01"><span>公司</span></div><p><a href="http://www.wanmei.com/enterprise/company.htm">公司简介</a></p><p><a href="http://hr.wanmei.com" target="_blank">招聘信息</a></p><p><a href="http://www.wanmei.com/enterprise/aboutme.htm">联系我们</a></p><p><a href="http://www.wanmei.com/enterprise/legal.htm">法律声明</a></p><p><a href="http://www.wanmei.com/enterprise/sitemap.htm">网站地图</a></p></li><li><div class="tit01"><span>账号</span></div><p><a href="http://passport.wanmei.com/jsp/member/register.jsp">注册通行证账号</a></p><p><a href="http://passport.wanmei.com/">账号安全</a></p><p><a href="http://passport.wanmei.com/jsp/indulge/index.jsp">防沉迷登记</a></p><p><a href="http://passport.wanmei.com/jsp/member/password.jsp">修改密码</a></p></li><li><div class="tit01"><span>充值</span></div><p><a href="http://pay.wanmei.com">充值中心</a></p><p><a href="http://www.wanmei.com/pay/goukazhinan.shtml">购卡指南</a></p><p><a href="http://www.wanmei.com/pay/faq_other.shtml">充值问题</a></p></li><li><div class="tit01"><span>游戏</span></div><p><a href="http://www.arcgames.cn/">Arc游戏平台</a></p><p><a href="http://www.173.com/">Arc页游</a></p><p><a href="http://www.4games.com">海外4Games</a></p><p><a href="http://www.laohu.com">老虎游戏</a></p></li><li><div class="tit01"><span>服务</span></div><p><a href="http://vip.wanmei.com">特权VIP</a></p><p><a href="http://cs.wanmei.com">客服中心</a></p><p><a href="http://www.wanmei.com/jiazhang/">家长监护</a></p></li><li class="r"><div class="tit01"><span>商城</span></div><p><a href="http://shop.wanmei.com">完美商城</a></p><p><a href="http://wanmei.tmall.com">天猫旗舰店</a></p><p><a href="http://wanmeishijie.jd.com">京东旗舰店</a></p></li></ul><!--h5><a href="http://www.wanmei.com/enterprise/company.htm">公司介绍</a> | <a href="#">开发团队</a> | <a href="http://hr.wanmei.com" target="_blank">招聘信息</a> | <a href="aboutme.htm">联系我们</a> | <a href="proclaim.htm">法律声明</a> | <a href="map.htm">网站地图</a></h5--><h5 style="text-align:center; line-height:2;">京ICP证：050016号《网络文化经营许可证》编号：京网文[2011]0782-287号《网络视听许可证》编号：0110587 京公网安备110105019888号 <br>建议18岁以上的成年人游戏<br>完美世界（北京）网络技术有限公司 版权所有</h5><h5 style="text-align:center;"><a href="http://www.hd315.gov.cn/beian/view.asp?bianhao=010202005060700536" target="_blank"><img src="images/icp.gif" alt=""></a><a href="https://ss.knet.cn/verifyseal.dll?sn=2011011300100005061&amp;ct=df&amp;pa=011371" target="_blank"><img src="images/kexin.gif" alt=""></a><a href="http://www.bjwhzf.gov.cn/accuse.do" target="_blank"><img src="images/sc.gif" alt=""></a><a href="http://www.cogcpa.org/" target="_blank"><img src="images/bq.gif" alt=""></a><a href="http://www.wanmei.com/news_lvse.htm" target="_blank"><img src="images/lvse.gif" alt=""></a></h5><h6>京ICP证：050016号《网络文化经营许可证》<br>完美世界（北京）网络技术有限公司 版权所有</h6></div></div>


</body>
</html>