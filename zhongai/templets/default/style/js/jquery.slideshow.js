(function(){
	$.fn.slideshow=function(options){
		var defaults={
			autoPlay:false,  //自动切换
			speed:5000,     //图片切换间隔
			effect:'left',    //滑动方向。向左:left，向上:up,fade渐入渐出
			picCell:'ul li',
			listCell:'ol li',
			controlPrev: '#prev',
			controlNext: '#next',
			currentClass:'on'
			}
		var opt = $.extend(defaults, options); 
		this.each(function(){
			var obj=$(this),			   
				amount    = 0,
				time      = 800,
				fx        = opt.effect,
				list      = obj.find(opt.listCell),
				tag       = obj.find(opt.picCell),
				len       = tag.length,
				tagWidth  = tag.outerWidth(),
				tagHeight = tag.outerHeight(),
				boxWidth  = len*tagWidth,
				boxHeight = len*tagHeight;
					
			list.eq(0).addClass(opt.currentClass);
			list.bind('click',function(){
				i=list.index(this);
				$(this).addClass(opt.currentClass).siblings(opt.listCell).removeClass(opt.currentClass);	
				if(fx=='left'){
					tag.css('float','left').parent().css({'width':boxWidth,'position':'absolute'}).stop().animate({left:-i*tagWidth},time);
				}else if(fx=='up'){
					tag.parent().css({'height':boxHeight,'position':'absolute'}).stop().animate({top:-i*tagHeight},time);
				}else if(fx=='fade'){
					tag.css({'position':'absolute','left':0,'top':0});
					var j = i+1;
					if(j==len)j=0;
					tag.each(function(i){ $(this).fadeOut(time); });
					tag.eq(i).stop().fadeIn(time);
				}
				amount=i;
			})	
			
			if(opt.autoPlay==true){
				var timer = setInterval(starPlay,opt.speed);
				obj.hover(
					function(){clearInterval(timer);},
					function(){timer=setInterval(starPlay,opt.speed);
				})
			}
			$(opt.controlNext).click(function(){
				starPlay();	
			})
			$(opt.controlPrev).click(function(){
				starPlay('prev');	
			})
			
			function starPlay(control){		
				
				if(control=='prev'){
					amount--;
					if(amount < 0){amount = len-1;}
				}else{
					amount++;
					if(amount > len-1){amount = 0;}
				}
				if(opt.autoPlay==true){
					clearInterval(timer);
					list.eq(amount).trigger('click');
					timer=setInterval(starPlay,opt.speed);
				}else{
					list.eq(amount).trigger('click');
				}
			}	
		})
	}        
})(jQuery);