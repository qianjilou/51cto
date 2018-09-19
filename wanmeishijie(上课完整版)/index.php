<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>完美世界</title>
	<link rel="stylesheet" href="./css/front.css" />
	<script type="text/javascript" src="./js/front_common.js"></script>
	<script type="text/javascript" src="./js/front_index.js"></script>
</head>
<body>
	<?php
		require( "header.php" );
		$ads = new AdsModel( $db );
		$ads_list = $ads->get_front_ads();		
	?>

	<div id="wrap">
		<div class="layout">
			<div class="slider">
				<div class="img_block" id="img_block">
					
					<?php
						if ( !empty( $ads_list ) ) {
							foreach ( $ads_list as $k => $v ) {
								?>
								<a href="<?php echo $v['url']; ?>"><img src="./upload/<?php echo $v['img_center']; ?>" <?php echo ( $k != 0 ) ? "class='hide'" : "" ?> width=980 height=400 /></a>
								<?php
							}
						}
					?>
				
					<div class="small_icon" id="small_icon">
						<?php
							if ( !empty( $ads_list ) ) {
								for ( $i = 0; $i < count( $ads_list ); $i++ ) {
									?>
									<li><a href="javascript:void(0)" onclick="toggle(<?php echo $i; ?>)"><?php echo ( $i + 1 ); ?></a></li>
									<?php
								}
							}
						?>						
					</div>
				</div>
			</div>
		</div>

		<div class="layout">
			<div id="tuijian">
				<?php
					$feature_list = $cat->get_feature_category();
					// print_r( $feature_list );
					if ( !empty( $feature_list ) ) {
						foreach ( $feature_list as $k => $v ) {
							?>
							<a href="<?php echo $v['url']; ?>">
								<img src="./upload/<?php echo $v['img_center']; ?>" />
								<span>
									<?php echo $v['feature_name']; ?>
								</span>
							</a>				
							<?php
						}
					}
				?>
			</div>
		</div>

		<div class="layout">
			<div class="tab_box">
				<div class="tab_btn">
					<a href="javascript:void(0)" class="on">在线游戏</a>
					<a href="javascript:void(0)">Arc游戏平台</a>
					<a href="javascript:void(0)">媒体群</a>
					<a href="javascript:void(0)">完美公益</a>
					<a href="javascript:void(0)">购物</a>
				</div>
			</div>
			<div class="clear"></div>
			<div class="list">
				<div class="game_top">
					<?php
						$center_feature_cat = $cat->get_feature_category( 2 );
						if ( !empty( $center_feature_cat ) ) {
							foreach ( $center_feature_cat as $k => $v ) {
								?>
								<a href="<?php echo $v['url']; ?>">
									<span class="icon 
									<?php
										if ( $v['type'] == 1 ) {
											echo "top_new";
										}else if ( $v['type'] == 2 ) {
											echo "top_hot";
										}else if ( $v['type'] == 0 ) {
											echo "";
										}
									?>
									"></span>
									<img src="./upload/<?php echo $v['img_center']; ?>" width=191 height=97 />
								</a>					
								<?php
							}
						}
					?>
				</div>
				<div class="game_box list_l3">
					<h2>大型游戏</h2>
						<?php
							$big_game = $cat->get_cat_list( 2 );				
							if ( !empty( $big_game ) ) {
								foreach ( $big_game as $k => $v ) {
									?>
									<a href="<?php echo $v['url']; ?>" target="_blank"><span class="icon i4"></span>
									 <?php echo $v['cat_name']; ?><span class="icon 
										<?php
											if ( $v['type'] == 0 ) {
												echo "";
											}else if ( $v['type'] == 1 ) {
												echo "new";
											} else if ( $v['type'] == 2 ) {
												echo "hot";
											}
										?>
									 "></span></a>
									<?php
								}
							}
						?>
                        
				</div>
				<div class="game_box list_l2">
					<h2>手机游戏</h2>
					<?php
						$big_game = $cat->get_cat_list( 4 );				
						if ( !empty( $big_game ) ) {
							foreach ( $big_game as $k => $v ) {
								?>
								<a href="<?php echo $v['url']; ?>" target="_blank"><span class="icon i4"></span>
								 <?php echo $v['cat_name']; ?><span class="icon 
									<?php
										if ( $v['type'] == 0 ) {
											echo "";
										}else if ( $v['type'] == 1 ) {
											echo "new";
										} else if ( $v['type'] == 2 ) {
											echo "hot";
										}
									?>
								 "></span></a>
								<?php
							}
						}
					?>					
				</div>
				<div class="game_box list_l1">
					<h2>网页游戏</h2>
					<?php
						$big_game = $cat->get_cat_list( 3 );				
						if ( !empty( $big_game ) ) {
							foreach ( $big_game as $k => $v ) {
								?>
								<a href="<?php echo $v['url']; ?>" target="_blank"><span class="icon i4"></span>
								 <?php echo $v['cat_name']; ?><span class="icon 
									<?php
										if ( $v['type'] == 0 ) {
											echo "";
										}else if ( $v['type'] == 1 ) {
											echo "new";
										} else if ( $v['type'] == 2 ) {
											echo "hot";
										}
									?>
								 "></span></a>
								<?php
							}
						}
					?>		
				</div>
				<div class="game_box list_l1">
					<h2>主机游戏</h2>
                    <?php
						$big_game = $cat->get_cat_list( 5 );				
						if ( !empty( $big_game ) ) {
							foreach ( $big_game as $k => $v ) {
								?>
								<a href="<?php echo $v['url']; ?>" target="_blank"><span class="icon i4"></span>
								 <?php echo $v['cat_name']; ?><span class="icon 
									<?php
										if ( $v['type'] == 0 ) {
											echo "";
										}else if ( $v['type'] == 1 ) {
											echo "new";
										} else if ( $v['type'] == 2 ) {
											echo "hot";
										}
									?>
								 "></span></a>
								<?php
							}
						}
					?>		
				</div>
				<div class="clear"></div>
			</div>
		</div>

		<div class="layout pt40">
			<div class="news">
				<div class="tit01">
			        <span>热点新闻</span>
			    </div>
			    <div class="news_main">
			        <ul>
			        	<?php
			        		$arcModel = new ArticleModel( $db );
			        		$arc_list = $arcModel->get_index_articles();			        		
			        		if ( !empty( $arc_list ) ) {
			        			foreach ( $arc_list as $k => $v ) {
			        				?>
			        				<li class="<?php echo ( $k == 0) ? 'hot' : ''; ?>">
						                <?php if ( $k == 0 ) { ?>
						                <h3><img src="./upload/<?php echo $v['img_center']; ?>" width="220px" height="150px" alt=""></h3>
						                <?php } ?>
						                <h2><a href="<?php echo 'news_detail.php?arc_id=' . $v['article_id']; ?>" target="_blank"><?php echo $v['title']; ?></a></h2>
						                <p>
						                	<?php 
						                $content = strip_tags( htmlspecialchars_decode( $v['content'], ENT_QUOTES ) );
						                echo mb_substr( $content, 0, 81 ) . '...'; 
						                ?>
						            	</p>
						                <div class="clr"></div>
						            </li>
			        				<?php
			        			}
			        		}
			        	?>
			            <div class="clear"></div>
			        </ul>
			         <div class="hot_news"></div>
			    </div>
			</div>
			<div class="weibo">
				<div class="tit01"><span>关注完美</span></div>
				<h2><span class="icon weixin"></span> 微信</h2>
				<p>
					<?php
						$wechat = $cat->get_cat_list( 34 );
						if ( !empty( $wechat ) ) {
							foreach ( $wechat as $k => $v ) {
								?>
								<a href="javascript:void(0)" style="z-index: 0;"><?php echo $v['cat_name']; ?> <img src="images/2dc/pwrdwx.gif" alt="" style="display: none; opacity: 0;"><span class="icon jia"></span></a>					
								<?php
							}
						}
					?>
					
				</p>
				<h2><span class="icon sina"></span> 微博</h2>
				<p>
					<?php
						$weblog = $cat->get_cat_list( 38 );
						if ( !empty( $weblog ) ) {
							foreach( $weblog as $k => $v ) {
								?>
								<a href="http://weibo.com/wanmeishikong" target="_blank"><span class="icon i4"></span> <?php echo $v['cat_name'];?></a>
								<?php
							}
						}
					?>
					
				</p>					
			</div>
		</div>
		
	</div>

	
	<div class="bottom"><div class="max"><ul class="content"><li><div class="tit01"><span>公司</span></div><p><a href="http://www.wanmei.com/enterprise/company.htm">公司简介</a></p><p><a href="http://hr.wanmei.com" target="_blank">招聘信息</a></p><p><a href="http://www.wanmei.com/enterprise/aboutme.htm">联系我们</a></p><p><a href="http://www.wanmei.com/enterprise/legal.htm">法律声明</a></p><p><a href="http://www.wanmei.com/enterprise/sitemap.htm">网站地图</a></p></li><li><div class="tit01"><span>账号</span></div><p><a href="http://passport.wanmei.com/jsp/member/register.jsp">注册通行证账号</a></p><p><a href="http://passport.wanmei.com/">账号安全</a></p><p><a href="http://passport.wanmei.com/jsp/indulge/index.jsp">防沉迷登记</a></p><p><a href="http://passport.wanmei.com/jsp/member/password.jsp">修改密码</a></p></li><li><div class="tit01"><span>充值</span></div><p><a href="http://pay.wanmei.com">充值中心</a></p><p><a href="http://www.wanmei.com/pay/goukazhinan.shtml">购卡指南</a></p><p><a href="http://www.wanmei.com/pay/faq_other.shtml">充值问题</a></p></li><li><div class="tit01"><span>游戏</span></div><p><a href="http://www.arcgames.cn/">Arc游戏平台</a></p><p><a href="http://www.173.com/">Arc页游</a></p><p><a href="http://www.4games.com">海外4Games</a></p><p><a href="http://www.laohu.com">老虎游戏</a></p></li><li><div class="tit01"><span>服务</span></div><p><a href="http://vip.wanmei.com">特权VIP</a></p><p><a href="http://cs.wanmei.com">客服中心</a></p><p><a href="http://www.wanmei.com/jiazhang/">家长监护</a></p></li><li class="r"><div class="tit01"><span>商城</span></div><p><a href="http://shop.wanmei.com">完美商城</a></p><p><a href="http://wanmei.tmall.com">天猫旗舰店</a></p><p><a href="http://wanmeishijie.jd.com">京东旗舰店</a></p></li></ul><!--h5><a href="http://www.wanmei.com/enterprise/company.htm">公司介绍</a> | <a href="#">开发团队</a> | <a href="http://hr.wanmei.com" target="_blank">招聘信息</a> | <a href="aboutme.htm">联系我们</a> | <a href="proclaim.htm">法律声明</a> | <a href="map.htm">网站地图</a></h5--><h5 style="text-align:center; line-height:2;">京ICP证：050016号《网络文化经营许可证》编号：京网文[2011]0782-287号《网络视听许可证》编号：0110587 京公网安备110105019888号 <br>建议18岁以上的成年人游戏<br>完美世界（北京）网络技术有限公司 版权所有</h5><h5 style="text-align:center;"><a href="http://www.hd315.gov.cn/beian/view.asp?bianhao=010202005060700536" target="_blank"><img src="images/icp.gif" alt=""></a><a href="https://ss.knet.cn/verifyseal.dll?sn=2011011300100005061&amp;ct=df&amp;pa=011371" target="_blank"><img src="images/kexin.gif" alt=""></a><a href="http://www.bjwhzf.gov.cn/accuse.do" target="_blank"><img src="images/sc.gif" alt=""></a><a href="http://www.cogcpa.org/" target="_blank"><img src="images/bq.gif" alt=""></a><a href="http://www.wanmei.com/news_lvse.htm" target="_blank"><img src="images/lvse.gif" alt=""></a></h5><h6>京ICP证：050016号《网络文化经营许可证》<br>完美世界（北京）网络技术有限公司 版权所有</h6></div></div>


</body>
</html>