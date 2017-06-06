//首页广告和banner
$(function(){
	
/*导航切换*/	

	$(".nav-ul li a").wrapInner( '<span class="out"></span>' );
	
	$(".nav-ul li a").each(function() {
		$( '<span class="over">' +  $(this).text() + '</span>' ).appendTo( this );
	});

	$(".nav-ul li a").hover(function() {
		$(".out",	this).stop().animate({'top':	'43px'},	300); // move down - hide
		$(".over",	this).stop().animate({'top':	'0px'},		300); // move down - show

	}, function() {
		$(".out",	this).stop().animate({'top':	'0px'},		300); // move up - show
		$(".over",	this).stop().animate({'top':	'-43px'},	300); // move up - hide
	});	
	
});

//玫瑰整形权威专家
if($("div").hasClass("main2-r1-c")){       
	
	$(".main2-r1-c ul li").hover(function(){
		$(".main2-r1-c ul li").children("span").stop(false,true).eq($(this).index()).animate({bottom:'0px'},500);
	},function(){
		$(".main2-r1-c ul li").children("span").stop(false,true).eq($(this).index()).animate({bottom:'-88px'},500);
	});
}

//首页时尚申城效果
if($("div").hasClass("fashion-c-js")){
	var _fashion = $(".fashion-c");
	document.getElementById('fashion-t-ico').onclick = function(){
		
		this.getElementsByTagName("i")[0].className = 'ad';
		setTimeout(function(){
			document.getElementById('fashion-t-ico').getElementsByTagName("i")[0].className = '';
		},400);
		var _i = 0;
		function TimerScroll(){
			if(_i == 6){clearInterval(_timer); _timer = false; return;}
			_fashion.eq(_i).animate({marginTop:'-162px'},300,function(){
				$(this).children("dl").eq(0).remove().appendTo($(this));
				$(this).css("margin-top","0px");
			});
			_i++;
		}
		var _timer = setInterval(TimerScroll,50);
		clearInterval(_s);
		_s = setInterval(autoScroll,10000);
	}
	
	function autoScroll(){
		var _j = 0;
		function TimerScroll_auto(){
			if(_j == 6){clearInterval(_auto);return;}
			_fashion.eq(_j).animate({marginTop:'-162px'},300,function(){
				$(this).children("dl").eq(0).remove().appendTo($(this));
				$(this).css("margin-top","0px");
			});
			_j++;
		}
		var _auto = setInterval(TimerScroll_auto,50);
	}
	var _s = setInterval(autoScroll,10000);
	$(".fashion-c-js").hover(function(){
		clearInterval(_s);
	},function(){
		_s = setInterval(autoScroll,10000);
	});
} 


//首页焦点图
/*if(document.getElementById('banner')){
	var _Lilen = $("#banner ul li").length;
	var _t = document.getElementById('banner-t').getElementsByTagName('li');
	var _w = parseFloat(_t[0].currentStyle ? _t[0].currentStyle['width'] : getComputedStyle(_t[0], null)['width']);
	var _time = 300;
	document.getElementById("banner-t").style.width = _Lilen*100+'%';
	var _li = '';
	for(var _i = 0; _i < _Lilen; _i++){
		if(_i == 0){
			_li += '<li class="on"><a href="javascript:void(0)">'+(_i+1)+'</a></li>'; 
		}else{
			_li += '<li><a href="javascript:void(0)">'+(_i+1)+'</a></li>'; 
		}
	}
	var _m = document.createElement('div');
	_m.className = 'banner-m';
	_m.innerHTML = ['<ul id="banner-m">',_li,'</ul>'].join('');
	document.getElementById('banner').appendChild(_m);
	$("#banner-m").find("li").hover(function(){
		var _index  = $(this).index();
		var _indo = parseInt(_index)*_w+'px';
		$("#banner-m li").removeClass('on').eq(_index).addClass('on');
		$("#banner-t").stop().animate({right:_indo}, _time);		
	});
	
	var _l = document.getElementById('banner-m').getElementsByTagName('li');
	function autoChange(){
		for(var _i = 0; _i < _l.length; _i++){
			
			if(_l[_i].className == 'on'){
				_t = _i;
			}
			_l[_i].className = '';
		}
		if(_t == _l.length-1){
			_l[0].className = 'on';
			$("#banner-t").stop().animate({right:'0px'}, _time);
		}else{
			_l[_t+1].className = 'on';
			$("#banner-t").stop().animate({right:(_t+1)*_w+'px'}, _time);
		}
	}
	var _o = setInterval(autoChange, 5000);
	document.getElementById('banner').onmouseover = function (){
		clearInterval(_o);
	}
	document.getElementById('banner').onmouseout = function(){
		_o = setInterval(autoChange, 5000);
	}
}*/

//首页幻灯片按钮显示隐藏
	$(".fx_banner_common").hide();
			$(".ic_content").hover(function(){
				$(".fx_banner_common").stop().fadeIn();
				},function(){
				$(".fx_banner_common").fadeOut();					
		})
					
	//////////////////////

if(document.getElementById('banner')){

	var _banner = $("#banner-t li");
	
	var _list = '';
	for(var _i = 0; _i < _banner.length; _i++){
		if(_i == 0){
			_list += '<li class="on"><a href="javascript:void(0)">'+(_i+1)+'</a></li>'; 
		}else{
			_list += '<li><a href="javascript:void(0)">'+(_i+1)+'</a></li>'; 
		}
	}
	var _m = document.createElement('div');
	_m.className = 'banner-m';
	_m.style.zIndex = '10';
	_m.innerHTML = ['<ul id="banner-m">',_list,'</ul>'].join('');
	document.getElementById('banner').appendChild(_m);
	delete _m;
	for(var _i = 0; _i < _banner.length; _i++){
		if(_i == 0){
			_banner[_i].style.zIndex = '2';
			_banner[_i].style.opacity = '1';
		}else{
			_banner[_i].style.zIndex = '0';
			_banner[_i].style.opacity = '0';
		}
	}
	
	var _mli = document.getElementById('banner-m').getElementsByTagName('li');
	for(var _i = 0; _i < _banner.length; _i ++){
		_mli[_i].index = _i;
		_mli[_i].onclick = function(){     //鼠标点击
			if(_banner.is(":animated")==false){
				var _this = this.index;
				var _s = '';

				for(var _j = 0; _j < _banner.length; _j++){
					if(_banner[_j].style.zIndex == '2'){
						_s = _j;break;
					};
				}
				
				if(_s != _this){
					
					for(var _j = 0; _j < _banner.length; _j++){
						_mli[_j].className = '';
					}
					_mli[_this].className = 'on';
					
					_banner[_this].style.zIndex = '1';
					_banner.eq(_s).animate({opacity:'0'},300,function(){
						$(this).css({"z-index":"0"});
						_banner.eq(_this).css("z-index","2");
					});
					_banner.eq(_this).animate({opacity:'1'},300);
				}
			}
		}
	}
	
	function autoPlay(){
		var _d = '', _s = '';

		for(var _j = 0; _j < _banner.length; _j++){
			if(_banner[_j].style.zIndex == '2'){
				_s = _j;
				if(_j == (_banner.length-1)){_d = 0;}else{_d = _j+1;}
				break;
			};
		}

		for(var _j = 0; _j < _banner.length; _j++){
			_mli[_j].className = '';
		}
		_mli[_d].className = 'on';
				
		_banner[_d].style.zIndex = '1';
		_banner.eq(_s).animate({opacity:'0'},300,function(){
			$(this).css({"z-index":"0"});
			_banner.eq(_d).css("z-index","2");
		});
		_banner.eq(_d).animate({opacity:'1'},300);
	}
	
	var _n = setInterval(autoPlay, 5000);
	
	$("#banner").hover(function(){
		clearInterval(_n);
		_n = false;
	},function(){
		if(!_n)_n = setInterval(autoPlay, 5000);
	});
}

//首页预约成功效果
$(function(){
	if(document.getElementById('main2-l2-c'))
	{
		var _ul = $("#main2-l2-c").children('ul');
		function autoScroll(){
			_ul.animate({marginTop:'-30px'},300,function(){
				$(this).children('li').eq(0).remove().appendTo($(this));
				$(this).css('margin-top','0px');
			});
		}
		var _auto = setInterval(autoScroll,2000);
		$("#main2-l2-c").hover(function(){
			clearInterval(_auto);
		},function(){
			_auto = setInterval(autoScroll,2000);
		});
	}
	
	if(document.getElementById('nowyy') && document.getElementById('lastyy')){
		
		var newD = new Date();
		document.getElementById('nowyy').innerHTML = 50 + parseInt(newD.getSeconds()); 
			
		document.getElementById('lastyy').innerHTML = 60 - parseInt(newD.getSeconds());
		
		setInterval(function(){
			var newD = new Date();
			document.getElementById('nowyy').innerHTML = 50 + parseInt(newD.getSeconds()); 
			
			document.getElementById('lastyy').innerHTML = 60 - parseInt(newD.getSeconds());
		},20000);
	}
})


//首页活动专区效果
if(document.getElementById('hotspot-r-c')){
	var _l = document.getElementById('hotspot-r-c').getElementsByTagName('ul')[0].getElementsByTagName('li').length;
	
	var _m = document.createElement('div');
	
}

//首页商务通效果
if(document.getElementById('swt-right-index')){
	$("#swt-right-index ul li").hover(function(){
		$(this).children("a").addClass("swt-hover");
		$(this).stop().animate({right:"84px"},200);
	
	},function(){
		$(this).animate({right:"0px"},200,function(){
			$(this).stop().children("a").removeClass("swt-hover");
		});
	});
}

//首页菜单动态调整位置
function posTop(obj) {
	var Top = 0;
	while (obj) {
		Top += obj.offsetTop;
		obj = obj.offsetParent;
	}
	return parseInt(Top);
}
var _menudiv = document.getElementById('submenu').getElementsByTagName('div');

window.onscroll = function(){
	
	if(parseInt(document.documentElement.scrollTop || document.body.scrollTop) > posTop(document.getElementById('nav')) + 43){	

		$(".nav-submenu-xl").css("top",(parseInt(document.documentElement.scrollTop || document.body.scrollTop) - posTop(document.getElementById('submenu'))+43)+"px");
	}else{
		$(".nav-submenu-xl").css("top","43px");
	}
}

//首页导航效果
if(document.getElementById("submenu")){
var _submenu = $("#submenu").find('.submenu1');
var _time = 100;

function autoScrollDown(){
	if($(".nav-submenu").css("height") == '0px'){
		if(!-[1,] && !window.XMLHttpRequest){
			$(".nav-submenu").css("height","420px").find('.submenu1').eq(0).animate({top:'0px'},_time,function(){
				_submenu.eq(1).css("top","0px").animate({top:'105px'},_time,function(){
					_submenu.eq(2).css("top","105px").animate({top:'210px'},_time,function(){
						_submenu.eq(3).css("top","210px").animate({top:'315px'},_time);
					})
				});
			});
		}else{
			$(".nav-submenu").css("height","420px").find('.submenu1').eq(0).animate({bottom:'-105px'},_time,function(){
				_submenu.eq(1).css("bottom","-105px").animate({bottom:'-210px'},_time,function(){
					_submenu.eq(2).css("bottom","-210px").animate({bottom:'-315px'},_time,function(){
						_submenu.eq(3).css("bottom","-315px").animate({bottom:'-420px'},_time);
					})
				});
			
			});
		}
	}
}

function autoScrollUp(){
	$(".nav-l").removeClass("nav-l-hover");
	$(".nav-submenu").css("height","0px").find('.submenu1').stop().css("bottom","0px");
	$(".nav-submenu-xl").hide().children('div').hide();
	_submenu.removeClass('submenu1-hover');
}

$(".nav-l").hover(function(){

	clearTimeout(_autoscroll);
	$(".nav-l").addClass("nav-l-hover");
	autoScrollDown();
},function(){
	autoScrollUp();
});

var _autoscroll = setTimeout(function(){autoScrollUp();},5000);

$(function(){
	$(".nav-l").addClass("nav-l-hover");
	autoScrollDown();
}); 

_submenu.hover(function(){
	_submenu.removeClass('submenu1-hover').eq($(this).index()).addClass('submenu1-hover');
	$(".nav-submenu-xl").show().children('div').hide().eq($(this).index()).show();
	
});
}


/*新品推荐*/
$(function(){
	$("#safety_left a").hover(function(){
		
		$(this).children(".safelicon").stop().animate({top:"0px"},100);
		$(this).find(".st_hs").hide();
	},function(){
		$(this).children(".safelicon").stop().animate({top:"135px"},100);
		$(this).find(".st_hs").show();
	});
/*安全标准*/

	$("#safety_right_conr ul li").hover(function(){
		
		var _index = $(this).index();
		
		$("#safety_right_conr ul li").removeClass('safety_hli').eq(_index).addClass('safety_hli');
		
		for(var _i = 0; _i < 6; _i++){
			if(_i != _index){
				$("#safety_right_conl").children('div').children('span').eq(_i).css('bottom','-68px');
			}
		}
		
		$("#safety_right_conl").children('div').hide().eq(_index).show().children('span').stop(true,false).animate({bottom:'0px'},500);
	});
})


/*微信*/
if(document.getElementById('mchat')){
	var _mchat = document.getElementById('mchat');
	var _mchat2 = document.getElementById('mchat2');
	
	if(_mchat){
		_mchat.onclick = function(){
			createChat();	
		}
	}
	
	if(_mchat2){
		_mchat2.onclick = function(){
			createChat();	
		}	
	}
	
	function createChat(){
		var _div  = document.createElement('div');
		_div.style.width    = '100%';
		_div.style.height   = '100%';
		_div.style.position = 'fixed';
		_div.style.left     = '0px';
		_div.style.top 		= '0px';
		_div.id				= 'chat1';
		_div.onclick        = function(){
			document.body.removeChild(document.getElementById('chat1'));
			document.body.removeChild(document.getElementById('chat2'));
		}
		
		if (navigator.appName.indexOf("Internet Explorer") != -1){
			
			_div.style.filter  = 'alpha(opacity=70)';
			_div.style.opacity = '0.7';
		}else{
			_div.style.opacity = '0.7';
		}
		_div.style.backgroundColor = '#000';
		_div.style.zIndex   = '100000000';
		
		document.body.appendChild(_div);	
		
		delete _div;
		
		var _div1 = document.createElement('div');
		_div1.style.width = '500px';
		_div1.style.height = '275px';
		_div1.style.left = '50%';
		_div1.style.top = '-50%';
		_div1.style.marginLeft = '-240px';
		_div1.style.position = 'fixed';
		_div1.style.zIndex = '100000001';
		_div1.style.backgroundColor = '#fff';
		_div1.style.borderRadius	= '8px';
		
		_div1.id = 'chat2';
		
		_div1.innerHTML = ['<div style="width:462px; padding-left:27px; line-height:40px;border-bottom:1px solid #eeeeee;padding-right:10px;font-size:14px; overflow:hidden;"><h3 style="color:#333;font-size:15px; display:inline; float:left;">扫描微信二维码到手机</h3><a href="javascript:void(0);" id="closewx" onclick="closeChat();" style="position:absolute; top:5px; right:7px"><img src="/images2013/closewx.png" /></a></div>',
		'<div style="width:468px; padding-left:27px;padding-top: 10px; overflow:hidden;">',
			'<ul>',
				'<li style="width:206px;display:inline; float:left; font-size:12px; line-height:24px; position:relative;"><img src="/images2013/wx_02.jpg" /><div style="position:absolute; top:-17px; left:-23px;" class="qrcode"><img src="/images2013/wx_03.png" /></div></li>',
				'<li style="display:inline; float:left;width:251px; font-size:12px; line-height:24px; margin:5px 0px;"><h3 style="font-size:13px; color:#333">上海玫瑰医疗美容医院官方微信正式开通：</h3></li>'
				,'<li style="display:inline; float:left;width:251px; font-size:12px; line-height:24px; ">1、任何有关求美的问题，都可以扫描二维码或者是搜索“上海玫瑰”直接与我们在线专家沟通交流；</li>',
				'<li style="display:inline; float:left;width:251px; font-size:12px; line-height:24px;">2、您可以通过微信自带的扫描二维码功能，直接扫描左侧的二维码图像关注我们；</li>',
				'<li style="display:inline; float:left;width:251px; font-size:12px; line-height:24px;">3、扫描二维码，可免专家挂号费、免费泊车、并可享受最新的整形优惠。</li>',
			'</ul>',
		'</div>'].join('');
		document.body.appendChild(_div1);
		delete _div1;
		
		//$("#chat2").animate({height:'275px'},300);
		$("#chat2").animate({top:'35%'},500);
		
		$("#closewx").bind("click",function(){
		
			$("#chat1,#chat2").remove();
		});
	}
	
	function closeChat(){
		//alert('a');
		document.body.removeChild(document.getElementById('chat1'));
		document.body.removeChild(document.getElementById('chat2'));
	}
	/* document.getElementById('closewx').onclick = function(){
		document.body.removeChild(document.getElementById('chat1'));
		document.body.removeChild(document.getElementById('chat2'));
	} */
	//document.getElementById('chat1').setAttribute('onclick',document.all &&　!document.documentMode ? eval(function(){closeChat()}) : 'javascript:closeChat()');
}

//logo跑马特效
/* if(document.getElementById('ma')){
	function autoMA(){
		$("#ma").animate({right:'175px'},5000,function(){
			$("#ma1").fadeIn(300,function(){
				$("#ma2").fadeIn(300,function(){
					$("#ma3").fadeIn(300);
				});
			});
			setTimeout(function(){
				$("#ma").css({'bottom':'0px', 'right':'-91px'});
				$("#ma1,#ma2,#ma3").hide();
			},30000);
		});
	}
	autoMA();
	setInterval(autoMA,36000);
} */

/*活动专区特效*/
$(document).ready(function(){
	//环境
	if(document.getElementById("con_1")){
	var scrollPic_01 = new ScrollPic();
    scrollPic_01.scrollContId   = "con_1"; //内容容器ID
	scrollPic_01.arrLeftId      = "l_con_1";//左箭头ID
	scrollPic_01.arrRightId     = "r_con_1"; //右箭头ID
    scrollPic_01.frameWidth     = 780;//显示框宽度
    scrollPic_01.pageWidth      = 344; //翻页宽度
    scrollPic_01.speed          = 20; //移动速度(单位毫秒，越小越快)
    scrollPic_01.space          = 20; //每次移动像素(单位px，越大越快)
    scrollPic_01.autoPlay       = false; //自动播放
    scrollPic_01.autoPlayTime   = 0;
    scrollPic_01.initialize(); //初始化
	function autogun1(){
		scrollPic_01.rightMouseDown();scrollPic_01.leftEnd();
	}
	//setInterval(autogun1,3000); //如果需要自动切换就这里不要注释就好
	if (window.ActiveXObject){
		$("#con_1").children("div").children("div").css("float",'left');
	}
	}
});	