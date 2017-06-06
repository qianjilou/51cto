

//banner切换效果
if(document.getElementById('chan-banner-jt')){
	var _li = $("#chan-banner ul li");
	$("#chan-banner-jt ul li").click(function(){
		
		//alert($("#chan-banner ul").html());
		if(_li.is(":animated") == false){
			var _obj = $("#chan-banner-jt ul li");
			var _i = $(this).index();
			var _s = '', _type = '', _typeback = '';
			for(var _t = 0; _t < _obj.length; _t++){
				if(document.getElementById("chan-banner").children[0].getElementsByTagName("li")[_t].style.zIndex == '2'){
					_s = _t;
					
					break;
				};
			}
			
			switch (parseInt(Math.random()*4+1)){
				case 1: _type = {opacity:'0',left:'765px'}; _typeback = {"z-index":"","opacity":"1","left":"0px"};break;
				case 2: _type = {opacity:'0',left:'-765px'}; _typeback = {"z-index":"","opacity":"1","left":"0px"};break;
				case 3: _type = {opacity:'0',top:'308px'}; _typeback = {"z-index":"","opacity":"1","top":"0px"};break;
				case 4: _type = {opacity:'0',top:'-308px'}; _typeback = {"z-index":"","opacity":"1","top":"0px"};break;
				default: _type = {opacity:'0',left:'765px'}; _typeback = {"z-index":"","opacity":"1","left":"0px"};break;
			}
			if(_s != $(this).index()){
				_li.eq(_i).css("z-index","1");
				_li.eq(_s).animate(_type,500,function(){
					$(this).css(_typeback);
					_li.eq(_i).css("z-index","2");
				});	
			}
		}
	});
	
	function autoChange(){
		
		if(_li.is(":animated") == false){
			var _obj = $("#chan-banner-jt ul li");
			var _i  = '';
			var _s  = '';
			for(var _t = 0; _t < _obj.length; _t++){
				if(document.getElementById("chan-banner").children[0].getElementsByTagName("li")[_t].style.zIndex == '2'){
					_s = _t;break;
				};
			}
			
			if(_s == 2){ _i = 0;}else{ _i = _s + 1; }
			
			switch (parseInt(Math.random()*4+1)){
				case 1: _type = {opacity:'0',left:'765px'}; _typeback = {"z-index":"","opacity":"1","left":"0px"};break;
				case 2: _type = {opacity:'0',left:'-765px'}; _typeback = {"z-index":"","opacity":"1","left":"0px"};break;
				case 3: _type = {opacity:'0',top:'308px'}; _typeback = {"z-index":"","opacity":"1","top":"0px"};break;
				case 4: _type = {opacity:'0',top:'-308px'}; _typeback = {"z-index":"","opacity":"1","top":"0px"};break;		
			}
			
			_li.eq(_i).css("z-index","1");
			_li.eq(_s).animate(_type,500,function(){
				$(this).css(_typeback);
				_li.eq(_i).css("z-index","2");
			});
		}
	}
	var _auto = setInterval(autoChange,5000);
	
	$(".main1-r").hover(function(){
		
		clearInterval(_auto);
		
	},function(){
		clearInterval(_auto);_auto = setInterval(autoChange,5000);
	});
}

//项目文章页案例展示切换
$(".cha-r-1-c3-t ul li").hover(function(){
	$(".cha-r-1-c3-t ul li").removeClass("ss01").eq($(this).index()).addClass("ss01");
	$(".cha-r-1-c3-c").find("dl").hide().eq($(this).index()).show();
});

//project页需求和烦恼切换特效
function showChannel(){
	if(arguments.length == 0){
		$("#pro-2-c").children("dl").show();
	}else{
		$("#pro-2-c").children("dl").hide();
		for(var _i = 0; _i < arguments.length; _i++){
			$("#pro-2-c").children("dl").eq(arguments[_i]).show();
		}
	}
}
if($("div").hasClass("pro-1-nr")){
	//需求和烦恼选项切换
	$(".pro-1-nr").eq(0).find("li").click(function(){		
		var _scrollStop = parseInt($("#pro-1")[0].offsetTop);
		timer = setInterval(function(){
			var _scrollNow  = parseInt(document.documentElement.scrollTop || document.body.scrollTop);
			iSpeed = (_scrollStop - _scrollNow) / 7;
			iSpeed = iSpeed > 0 ? Math.ceil(iSpeed) : Math.floor(iSpeed);
			if (Math.abs(_scrollStop - _scrollNow) < 1) {
				clearInterval(timer);
				window.scrollTo(0, _scrollStop);
			} else {
				window.scrollTo(0, _scrollNow + iSpeed);
			}
		},20);
		$(".pro-1-nr").eq(1).find("li").removeClass("pro-1-nrli");
		$(".pro-1-nr").eq(0).find("li").removeClass("pro-1-nrli").eq($(this).index()).addClass("pro-1-nrli");
	});
	$(".pro-1-nr").eq(1).find("li").click(function(){
		var _scrollStop = parseInt($("#pro-1")[0].offsetTop);
		timer = setInterval(function(){
			var _scrollNow  = parseInt(document.documentElement.scrollTop || document.body.scrollTop);
			iSpeed = (_scrollStop - _scrollNow) / 7;
			iSpeed = iSpeed > 0 ? Math.ceil(iSpeed) : Math.floor(iSpeed);
			if (Math.abs(_scrollStop - _scrollNow) < 1) {
				clearInterval(timer);
				window.scrollTo(0, _scrollStop);
			} else {
				window.scrollTo(0, _scrollNow + iSpeed);
			}
		},20);
		$(".pro-1-nr").eq(0).find("li").removeClass("pro-1-nrli");
		$(".pro-1-nr").eq(1).find("li").removeClass("pro-1-nrli").eq($(this).index()).addClass("pro-1-nrli");
	});
	//全部需求下拉
	$(".pro-1-nr").eq(0).find('s').toggle(function(){
		$(this).siblings("ul").animate({height:'70px'},300,function(){
			$(".pro-1-nr").eq(0).find('s').addClass("pro-1-nr-span2");
		});
	},function(){
		$(this).siblings("ul").animate({height:'34px'},300,function(){
			$(".pro-1-nr").eq(0).find('s').removeClass("pro-1-nr-span2");
		});
	});
	//全部烦恼下拉
	$(".pro-1-nr").eq(1).find('s').toggle(function(){
		$(this).siblings("ul").animate({height:'70px'},300,function(){
			$(".pro-1-nr").eq(1).find('s').addClass("pro-1-nr-span2");
		});
	},function(){
		$(this).siblings("ul").animate({height:'34px'},300,function(){
			$(".pro-1-nr").eq(1).find('s').removeClass("pro-1-nr-span2");
		});
	});
}


//项目页导航浮动
if(document.getElementById("cha-r-1-t")){
	function hasClass(ele,cls) {
		return ele.className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)'));
	}
	function addClass(ele,cls) {
		if (!this.hasClass(ele,cls)) ele.className += " "+cls;
	}
	function removeClass(ele,cls) {
		if (hasClass(ele,cls)) {
		var reg = new RegExp('(\\s|^)'+cls+'(\\s|$)');
			ele.className=ele.className.replace(reg,' ');
		}
	}
	$(function(){
		function posTop(obj) {
			var Top = 0;
			while (obj) {
				Top += obj.offsetTop;
				obj = obj.offsetParent;
			}
			return Top;
		}
		var _f = posTop(document.getElementById("cha-r-1-t"));
				
		$(window).bind('scroll', function(){
			var _u = document.documentElement.scrollTop || document.body.scrollTop;
			if(_u > _f){      	//菜单浮动
				
				if(_u > _f && posTop(document.getElementById("introduce")) < (_u + 60)){
					
					removeClass(document.getElementById("cha-r-1-t"),'cha-r-1-t-float');
					document.getElementById("floatHidden").style.display = 'none';
				}else{
					addClass(document.getElementById("cha-r-1-t"),'cha-r-1-t-float');
					document.getElementById("floatHidden").style.display = 'block';
				}
				
			}else{			//菜单不浮动
				removeClass(document.getElementById("cha-r-1-t"),'cha-r-1-t-float');
				document.getElementById("floatHidden").style.display = 'none';
			}
		});
		var _scrollValue = [];
		var _scrollli = document.getElementById("cha-r-1-t").getElementsByTagName("li");
		for (var _i = 0; _i < _scrollli.length; _i++)
		{
			_scrollValue.push(posTop(document.getElementById('anchor' + (_i + 1))));
		}
		for ( var _j = 0; _j < _scrollli.length; _j++){
			_scrollli[_j].index = _j;
			_scrollli[_j].onclick = function(){
				window.scrollTo(0, (_scrollValue[this.index]-50))
			};
		}
	});
}

//右侧项目切换
if(document.getElementById("acti-r-7-t")){
	$("#acti-r-7-t ul li").hover(function(){
		$("#acti-r-7-t ul li").removeClass("sd01").eq($(this).index()).addClass("sd01");
		$("#acti-r-7-c").children("div").hide().eq($(this).index()).show();
	});
}

//今日预约成功
$(function(){
	if($("div").hasClass('cha-l-4-c')){
		var _ul = $(".cha-l-4-c").children("ul");
		function autoPlay(){
			_ul.animate({marginTop:'-32px'},300,function(){
				$(this).children('li').eq(0).remove().appendTo($(this));
				$(this).css('margin-top','0px');
			});
		}
		var _autoPlay = setInterval(autoPlay,3000);
		$(".cha-l-4-c").hover(function(){
			clearInterval(_autoPlay);
		},function(){
			_autoPlay = setInterval(autoPlay,3000);
		});
	}
});

//项目文章页对比图切换
if($('div').hasClass('cha-r-1-c3')){
	$(".cha-r-1-c3").find('.cha-r-1-c3-t').find('li').hover(function(){
		$(".cha-r-1-c3").find('.cha-r-1-c3-t').find('li').removeClass('ss01').eq($(this).index()).addClass('ss01');
		$(".cha-r-1-c3").find('.cha-r-1-c3-c').find('dl').hide().eq($(this).index()).show();
	});
}

//微信弹出框
(function(){
	for(var _i = 0; _i < arguments.length; _i++){

		if(!document.getElementById(arguments[_i])){ continue;}
		document.getElementById(arguments[_i]).index = _i;
		document.getElementById(arguments[_i]).onclick = function (){
			
			createChat();
		}
	}
})('mchat', 'mchat1', 'mchat2', 'mchatTrouble1', 'mchatTrouble2', 'mchatTrouble3', 'mchatTrouble4');

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
	
	_div1.innerHTML = ['<div style="width:462px; padding-left:27px; line-height:40px;border-bottom:1px solid #eeeeee;padding-right:10px;font-size:14px; overflow:hidden;"><h3 style="color:#333;font-size:15px; display:inline; float:left;">扫描微信二维码到手机</h3><a href="javascript:void(0);" id="closewx" style="position:absolute; top:5px; right:7px"><img src="/images2013/closewx.png" /></a></div>',
	'<div style="width:468px; padding-left:27px;padding-top: 10px; overflow:hidden;">',
		'<ul>',
			'<li style="width:206px;display:inline; float:left; font-size:12px; line-height:24px; margin:5px 0px; position:relative;"><img src="/images2013/wx_02.jpg" /><div style="position:absolute; top:-17px; left:-23px;" class="qrcode"><img src="/images2013/wx_03.png" /></div></li>',
			'<li style="display:inline; float:left;width:251px; font-size:12px; line-height:24px; margin:5px 0px;"><h3 style="font-size:13px; color:#333">上海玫瑰医疗美容医院官方微信正式开通：</h3></li>'
			,'<li style="display:inline; float:left;width:251px; font-size:12px; line-height:24px;">1、任何有关求美的问题，都可以扫描二维码或者是搜索“上海玫瑰”直接与我们在线专家沟通交流；</li>',
			'<li style="display:inline; float:left;width:251px; font-size:12px; line-height:24px; ">2、您可以通过微信自带的扫描二维码功能，直接扫描左侧的二维码图像关注我们；</li>',
			'<li style="display:inline; float:left;width:251px; font-size:12px; line-height:24px; ">3、扫描二维码，可免专家挂号费、免费泊车、并可享受最新的整形优惠。</li>',
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

//案例页左侧收缩
if($("div").hasClass("case-l-1-t")){
	$(".case-l-1-t").click(function(){
		if($(this).siblings(".case-l-1-c").css("display") == "none"){
			$(this).siblings(".case-l-1-c").slideDown();
		}else{
			$(this).siblings(".case-l-1-c").slideUp();
		}
	});
	
}

//右侧底部切换效果
if(document.getElementById('acti-r-7-t')){
	$("#acti-r-7-t ul li").hover(function(){
		$("#acti-r-7-t ul li").removeClass("sd01").eq($(this).index()).addClass("sd01");
		$("#acti-r-7-c").children("div").hide().eq($(this).index()).show();
	});
}


//导航效果
if(document.getElementById("submenu")){
	var _submenu = $("#submenu").find('.submenu1');
	var _time = 100;

	if(!-[1,] && !window.XMLHttpRequest){
		
		$(".nav-l").hover(function(){
			$(".nav-submenu").css("height","420px").find('.submenu1').eq(0).animate({top:'0px'},_time,function(){
				_submenu.eq(1).css("top","0px").animate({top:'105px'},_time,function(){
					_submenu.eq(2).css("top","105px").animate({top:'210px'},_time,function(){
						_submenu.eq(3).css("top","210px").animate({top:'315px'},_time);
					})
				});
			
			});
			
			_submenu.hover(function(){
				_submenu.removeClass('submenu1-hover').eq($(this).index()).addClass('submenu1-hover');
				$(".nav-submenu-xl").show().children('div').hide().eq($(this).index()).show();
				
			});
			
		},function(){
			$(".nav-submenu").css("height","0px").find('.submenu1').stop().css("bottom","0px");
			$(".nav-submenu-xl").hide().children('div').hide();
			_submenu.removeClass('submenu1-hover');
		});
	}else{
		$(".nav-l").hover(function(){
			$(".nav-submenu").css("height","420px").find('.submenu1').eq(0).animate({bottom:'-105px'},_time,function(){
				_submenu.eq(1).css("bottom","-105px").animate({bottom:'-210px'},_time,function(){
					_submenu.eq(2).css("bottom","-210px").animate({bottom:'-315px'},_time,function(){
						_submenu.eq(3).css("bottom","-315px").animate({bottom:'-420px'},_time);
					})
				});
			
			});
			
			_submenu.hover(function(){
				_submenu.removeClass('submenu1-hover').eq($(this).index()).addClass('submenu1-hover');
				$(".nav-submenu-xl").show().children('div').hide().eq($(this).index()).show();
				
			});
			
		},function(){
			$(".nav-submenu").css("height","0px").find('.submenu1').stop().css("bottom","0px");
			$(".nav-submenu-xl").hide().children('div').hide();
			_submenu.removeClass('submenu1-hover');
		});
	}
}

//导航切换	
$(function(){
	if($("ul").hasClass("nav-ul")){
		var _nav = $(".nav-ul li a");
		_nav.wrapInner( '<span class="out"></span>' );
		_nav.each(function() {
			$( '<span class="over">' +  $(this).text() + '</span>' ).appendTo( this );
		});
		_nav.hover(function() {
			$(".out",	this).stop().animate({'top':	'43px'},	300); // move down - hide
			$(".over",	this).stop().animate({'top':	'0px'},		300); // move down - show
		}, function() {
			$(".out",	this).stop().animate({'top':	'0px'},		300); // move up - show
			$(".over",	this).stop().animate({'top':	'-43px'},	300); // move up - hide
		});	
		
		var _url = window.location.pathname;
		if(_url.indexOf('/2013/zhuanjiatuandui/') != -1){
			
			_nav.eq(2).unbind().find(".out").css("top","43px");
			_nav.eq(2).find(".over").css("top","0px");
		}else if(_url.indexOf('/2013/history.html') != -1){
			
			_nav.eq(1).unbind().find(".out").css("top","43px");
			_nav.eq(1).find(".over").css("top","0px");
		}else if(_url.indexOf('/2013/anlizhongxin/') != -1){
			_nav.eq(3).unbind().find(".out").css("top","43px");
			_nav.eq(3).find(".over").css("top","0px");
		}else if(_url.indexOf('/2013/vip_hyk.html') != -1 || _url.indexOf('/2013/vip_hyqy.html') != -1 || _url.indexOf('/2013/vip_hyhk.html') != -1 || _url.indexOf('/2013/huiyuanzhongxin/zhuyishixiang/') != -1){
			
			_nav.eq(4).unbind().find(".out").css("top","43px");
			_nav.eq(4).find(".over").css("top","0px");
		}else if(_url.indexOf('/2013/route.html') != -1){
			
			_nav.eq(5).unbind().find(".out").css("top","43px");
			_nav.eq(5).find(".over").css("top","0px");
		}
	}
});




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