
function fadeIn(elem) {
	setOpacity(elem, 0)
	for ( var i = 0; i < 50; i++) {
		(function() {
			var pos = i * 2;				
			setTimeout(function() {
				setOpacity(elem, pos)
			}, i * 25);
		})(i);
	}
}
function fadeOut(elem) {
	for ( var i = 0; i <= 20; i++) {
		(function() {
			var pos = 100 - i * 5;
			setTimeout(function() {
				setOpacity(elem, pos)
			}, i * 25);
		})(i);
	}
}
// 设置透明度
function setOpacity(elem, level) {
	if (elem.filters) {
		elem.style.filter = "alpha(opacity=" + level + ")";
	} else {
		elem.style.opacity = level / 100;
	}
}
function toggle ( img_index ) {		
	var img_obj = D_T( "img_block", "img" );
	var small_icon = D_T( "small_icon", "li" );
	for ( var index = 0; index < img_obj.length; index++ ) {
		if ( index == img_index ) {
			fadeIn( img_obj[index] );
			img_obj[index].className = "show";
			small_icon[index].firstChild.style.background = "#f54545";
		} else {
			img_obj[index].className = "hide";
			small_icon[index].firstChild.style.background = "#ffac38";
		}
	}
	begin_index = img_index;
}

function loop () {
	if ( begin_index >= 4 ) {
		begin_index = -1;
	}
	begin_index++;
	toggle( begin_index );
}
var begin_index = -1;
var t;
window.onload = function () {
	t = setInterval( "loop()", 3000 );	
	D( "img_block" ).onmouseover = function () {			
		clearInterval( t );
	}
	D( "img_block" ).onmouseout = function () {
		t = setInterval( "loop()", 3000 );
	}	
}
