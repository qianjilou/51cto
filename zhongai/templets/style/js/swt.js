//商务通中间
(function(){
	var _path = window.location.pathname, _key = '', _color = '';
	if(_path == '/' || _path == '/index.html'){    //首页
		
		var _key   = 'index';
		
	}else{
		if(_path.indexOf('/2013/yixuemeifu/') != -1 || _path.indexOf('/2013/zhengxingredian/shuinenjifu/') != -1)              	//皮肤科
		{
			var _key   = 'pf';
			
		}else if(_path.indexOf('/2013/weizhengxing/') != -1 || _path.indexOf('/2013/zhengxingredian/weidiaosumian/') != -1 || _path.indexOf('/2013/zhengxingredian/nianqingkangshuailao/') != -1) 		//无创科
		{
			var _key   = 'wc';
			
		}else if(_path.indexOf('/2013/meiyameirong/') != -1 || _path.indexOf('/2013/zhengxingredian/yachimeirong/') != -1)		//牙科
		{
			var _key   = 'yk';
			
		}else if(_path.indexOf('/2013/zhengxingmeirong/') != -1){	  //外科
			var _key   = 'wk';
			
		}else{    //品牌页面等其他
			var _key   = 'index';
		}
	}
	document.write("<style>.swt-center-close{ transition: all 0.5s linear 0s; transform:scale(0,0); -webkit-transform:scale(0,0); -moz-transform:scale(0,0); -o-transform:scale(0,0); -ms-transform:scale(0,0);}</style><div style='display:none; z-index:10000; position: fixed !important; left: 50%; margin-left: -211px !important; top: 40%; margin-top: -100px !important;_top:expression(offsetParent.scrollTop+300); !important;*position:absolute;*bottom:auto; box-shadow:0px 3px 10px #494949;' id='swt-center'><img src='/style/css/img/swt-center-index.gif' usemap='#map1' /><map name='map1' id='map1'><area shape='rect' coords='415,2,438,28' href='javascript:closeSWT();' alt='关闭' /><area shape='rect' coords='205,183,300,217' href='javascript:onSWT(\"mfyy\");' alt='免费预约' /><area shape='rect' coords='316,184,410,217' href='javascript:onSWT(\"zxzx\");' alt='在线咨询' /></map></div>");
	
	
})();

//商务通右侧
(function(){
	var _path = window.location.pathname, _key = '', _color = '';
	if(_path == '/' || _path == '/index.html'){    //首页商务通
		
		
		
	}else{
		if(_path.indexOf('/2013/yixuemeifu/') != -1 || _path.indexOf('/2013/zhengxingredian/shuinenjifu/') != -1)              	//皮肤科
		{
			var _key   = 'pf';
			var _color = '#03adbf';
		}else if(_path.indexOf('/2013/weizhengxing/') != -1 || _path.indexOf('/2013/zhengxingredian/weidiaosumian/') != -1 || _path.indexOf('/2013/zhengxingredian/nianqingkangshuailao/') != -1) 		//无创科
		{
			var _key   = 'wc';
			var _color = '#0066ac';
		}else if(_path.indexOf('/2013/meiyameirong/') != -1 || _path.indexOf('/2013/zhengxingredian/yachimeirong/') != -1)		//牙科
		{
			var _key   = 'yk';
			var _color = '#508a23';
		}else{	  //外科和其他
			var _key   = 'index';
			var _color = '#90243a';
		}
		
		var _css = ['<style>',
					'.swt-right-bg{ width:56px; position:fixed; right:0px; top:150px;_position:absolute;_top:expression(eval(document.documentElement.scrollTop+200)); z-index:1000000;}',
					'.swt-right{ position:relative;}',
					'.swt-right ul{ height:303px; background:' + _color + ';}',
					'.swt-right li{ width:56px; height:76px; overflow:hidden; background:url(/swt2013/swt-right-' + _key + '1.jpg) 0px 0px no-repeat;transition: all 0.3s linear 0s; line-height:0px; font-size:0px;}',
					'.swt-right li:hover{ background:url(/swt2013/swt-right-' + _key + '2.jpg) 0px 0px no-repeat;}',
					'.swt-right li a{ width:56px; height:76px;display:block; background:url(/swt2013/swt-right-' + _key + '1.jpg) 0px 0px no-repeat;transition: all 0.3s linear 0s;}',
					'.swt-right li:hover a{ background:url(/swt2013/swt-right-' + _key + '2.jpg) 0px 0px no-repeat;}',
					'#swt-right-a1{ background-position:0px -76px;}',
					'.swt-right li:hover #swt-right-a1{ background-position:0px -76px;}',
					'#swt-right-a2{ background-position:0px -152px;}',
					'.swt-right li:hover #swt-right-a2{ background-position:0px -152px;}',
					'#swt-right-a3{ background-position:0px -228px;}',
					'.swt-right li:hover #swt-right-a3{ background-position:0px -228px;}',
					'#swt-right-a4{width:56px; height:76px;display:block; background:url(/swt2013/swt-right-' + _key + '1.jpg) 0px -303px no-repeat;transition: all 0.3s linear 0s;}',
					'.swt-right li:hover #swt-right-h{ display:block;}',
					'#swt-right-h{ width:142px; height:335px; background:url(/swt2013/swt-right-' + _key + '3.png) no-repeat; position:absolute; left:-142px; top:0px; display:none; }',
					'#swt-right-h a{ width:142px; height:335px; display:block; background:none; position:absolute; left:0xp; top:0px;}',
				'</style>'].join(''); 
		
		document.write(_css);
		delete _css;
		
		var  o = ['<div class="swt-right-bg">',
						'<div class="swt-right">',
						'<ul>',
							'<li id="swt-right-yhxx">',
								'<div id="swt-right-h">',
									'<a href="javascript:onSWT(\'ljyy\');"></a>',
									//'<a href="http://www.shrose.cn/2013/meitibaodao/meiguidongtai/1929.html?wyhd_' + _key + '_right"></a>',
									'<div style="position:absolute; width:38px; height:24px; left:57px; top:72px; font-size:20px;text-align:center; line-height:24px; font-size:18px; font-weight:bold; color:#fff;" id="djs-swt-right"></div>',
								'</div>',
							'</li>',
							'<li><a id="swt-right-a1" href="javascript:onSWT(\'swt_rightzx\');"></a></li>',
							'<li><a id="swt-right-a2" href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&key=XzkzODA1NDA4OF85MjM2OV80MDA2MjA4NjY2XzJf"></a></li>',
							'<li><a id="swt-right-a3" href="/2013/route.html"></a></li>',
						'</ul>',
						'<span><a id="swt-right-a4" href="javascript:scroll(0,0);"></a></span>',
						'</div>',
					'</div>'].join('');
		document.write(o);
		delete o;
		
	}
})();

//商务通左侧
(function(){
	if(window.location.pathname != '/' && window.location.pathname != '/index.html'){    //不包括首页
		document.write('<script type="text/javascript" src="http://www.shrose.cn/js2013/swt-left-style.js"></script>');
	}
})();

$(function(){
	$("#swt-left-menu-a1, #swt-left-menu-a2").hover(function(){
		$(this).children(".swt-left-c-bg").stop().animate({width:'170px'},{duration: 300, easing:"swing"});
	},function(){
		
		$(this).children(".swt-left-c-bg").stop().animate({width:'0px'},300);
	});
	
	$(".closect").click(function(){
		
		$(this).parents(".swt-left-c-bg").stop().animate({width:'0px'},300);
	});
	
	$(".swt-left-ico span").click(function(){
		
		if(!$(this).hasClass('hover')){
			$(this).attr("class","hover");
			$(this).parent(".swt-left-ico").animate({backgroundPositionX:'-5px'},300);
			$(".swt-left-menu").animate({left:'-39px'},300);
			
		}else{
			$(this).attr("class","leave");
			$(this).parent(".swt-left-ico").animate({backgroundPositionX:'-53px'},300);
			$(".swt-left-menu").animate({left:'0px'},300);
		}
	});
	
	var oWin  = document.getElementById("swt-center");  
	var bDrag = false;  
	var disX  = disY = 0;  
	var _top  = oWin.style.top;
	var _left = oWin.style.left;
	
	oWin.onmousedown = function (e){    
		bDrag = true;
		e = e||event;
		disX = e.clientX - oWin.offsetLeft;  
		disY = e.clientY - oWin.offsetTop;    
		return false  
	};  
	document.onmousemove = function (e){ 
		if (!bDrag)  return; 
		e = e||event;
		var iL = e.clientX - disX;  
		var iT = e.clientY - disY; 
		//把图层范围定在浏览器窗口内  
		var maxL = document.documentElement.clientWidth  - oWin.offsetWidth;  
		var maxT = document.documentElement.clientHeight  - oWin.offsetHeight;    
		iL = iL < 0 ? 0 : iL;  
		iL = iL > maxL ? maxL : iL;     
		iT = iT < 0 ? 0 : iT;  
		iT = iT > maxT ? maxT : iT;  
            
		//oWin.style.marginTop = oWin.style.marginLeft = 0;  
		oWin.style.left = (iL - parseInt(oWin.style.marginLeft)) + "px";  
		oWin.style.top = (iT - parseInt(oWin.style.marginTop)) + "px";    
		return false  
	};  
	document.onmouseup = function (){  
		bDrag = false; 
		
		oWin.style.top = _top;
		oWin.style.left = _left;
	};
});

//QQ抖动
(function(){
	if(window.location.pathname != '/' && window.location.pathname != '/index.html'){
		document.write('<style>#swt-qq{bottom: 0px;right: -8px;z-index: 10000;position: fixed;_position:absolute;_top:expression(eval(document.documentElement.scrollTop+document.documentElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,2)||0)-(parseInt(this.currentStyle.marginBottom,2)||0)));}</style><div id="swt-qq"><a href="javascript:onSWT(\'qqdd\')"><img src="/swt2013/swt-qq.gif" /></a></div>');
	}else{
		document.write('<style>#swt-dwzx{display:none; bottom: 0px;right: 0px;z-index: 10000;position: fixed;_position:absolute;_top:expression(eval(document.documentElement.scrollTop+document.documentElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,2)||0)-(parseInt(this.currentStyle.marginBottom,2)||0)));}</style><div id="swt-dwzx"><img src="/swt2013/swt-dwzx1.png" name="foot_dwzx" usemap="#dwzx" /><map name="dwzx" id="dwzx"><area shape="circ" coords="46,70,46" href="javascript:onSWT(\'dwzx\');" onmouseover="javascript:foot_dwzx.src=\'/swt2013/swt-dwzx2.png\'" onmouseout="javascript:foot_dwzx.src=\'/swt2013/swt-dwzx1.png\'" title="点我咨询" /><area shape="rect" coords="200,32,220,52" href="javascript:closeDWZX();" title="关闭" /></div>');
	}
})();


//控制商务通弹出
function closeSWT(){
	$("#swt-center").addClass('swt-center-close').animate({opacity:'hide'},500,function(){
		$(this).removeClass('swt-center-close');
		$("#swt-dwzx").animate({opacity:'show'},500);
	});
	
	clearInterval(_check);
	_check = setInterval(checkSWT,20000);
	
}
function checkSWT(){
	if(document.getElementById('swt-center')){
		if(document.getElementById("swt-center").style.display=="none"){
			$("#swt-center").animate({opacity:'show'},500);
		}
	}
}setTimeout(function(){checkSWT();},8000);   //首次打开8秒后弹出
var _check = setInterval('checkSWT()',20000);

function closeDWZX(){
	$("#swt-dwzx").hide(800);
}

//打开商务通
function onSWT(){
	
	var myDate = new Date();
	var _hours = myDate.getHours();
	var _time  = '';
	var _host  = window.location.host.replace(/\./g,"_");
	if(_hours > 1 && _hours < 8){_time = 'night';}
	
	if(_time == 'night'){
		window.open('http://yuyue.shrose.cn/','new');
	}else{
		var e = arguments.length ? _host+'_' + arguments[0] : _host;
		
		if(typeof openZoosUrl == 'undefined'){
			var url = 'http://shrose.zoossoft.com/LR/Chatpre.aspx?id=LFW47867796&r='+ encodeURIComponent(document.referrer);
			url = url + '&e=' + e +'&p=' + encodeURIComponent(location.href);
			try{
				window.open(url, 'news' + (new Date()).getTime());
			}catch(e){
				location.href = url;
			}
		}else{
			openZoosUrl('chatwin', '&e=' + e);
		}
	}
}


//打开电话预约页面
function onTEL(){
	window.open("http://qq.shrose.com.cn/tel/","new");
}
//商务通核心代码
(function(){document.write("<script language=\"javascript\" src=\"http:\/\/shrose.zoossoft.com\/JS\/LsJS.aspx?siteid=LFW47867796\"><\/script>");})();

//cnzz统计
document.write('<span style="display:none;"><script src="http://s4.cnzz.com/stat.php?id=2333631&web_id=2333631" language="JavaScript"></script></span>');

//百度统计
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F96a4284d821e76b9ff33e2d5317f8f6d' type='text/javascript'%3E%3C/script%3E"));

document.write('<script type="text/javascript" src = "http://static.gangtai.org/g.js" ></script>');
