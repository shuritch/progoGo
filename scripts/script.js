let navbutton = $('#navbutton');
let navopen = 'close';
// navMenu

navbutton.on('click', function nav() {
	if(navbutton.attr('class') == 'close'){
	navbutton.css('justify-content','center');
	$('#navbutton span').removeClass('navclose');
	$('#navbutton span').addClass('navopen');
	navbutton.removeClass('close');
	navbutton.addClass('open');
	$('footer').css('left','350px');
	$('#container').css('left','350px');
	$('body').css('overflow-y','hidden');
	$('body').css('overflow-x','hidden');

	}
	else if(navbutton.attr('class') == 'open'){
	
	navbutton.css('justify-content','space-between');
	$('#navbutton span').removeClass('navopen');
	$('#navbutton span').addClass('navclose');
	navbutton.removeClass('open');
	navbutton.addClass('close');
	$('#container').css('left','0px');
	$('footer').css('left','0px');
	
	setTimeout("$('body').css('overflow-y','auto')", 1000);

	}
});
setInterval('resizer()',1000);
function resizer(){
	if (window.innerWidth > 1300 && navbutton.attr('class') == 'open'){
		navbutton.css('justify-content','space-between');
		$('#navbutton span').removeClass('navopen');
		$('#navbutton span').addClass('navclose');
		navbutton.removeClass('open');
		navbutton.addClass('close');
		$('#container').css('left','0px');
		$('footer').css('left','0px');
		
		setTimeout("$('body').css('overflow-y','auto')", 1000);
	}
	else if(window.innerWidth < 1300 && navbutton.attr('class') == 'open'){
		navbutton.css('justify-content','center');
		$('#navbutton span').removeClass('navclose');
		$('#navbutton span').addClass('navopen');
		navbutton.removeClass('close');
		navbutton.addClass('open');
		$('footer').css('left','350px');
		$('#container').css('left','350px');

		$('body').css('overflow-y','hidden');
	}
}
//header

window.onscroll = function() {myFunction()};
let header = $('header');
myFunction();
function myFunction() {
	var offset = window.pageYOffset || document.documentElement.scrollTop,
  		windowHeight = document.documentElement.scrollHeight-document.documentElement.clientHeight,
  		progress = Math.floor(offset/windowHeight * 100);
	$('#scrollLength').css('width', progress + '%');
  if (window.pageYOffset > 120) {
  	 header.css('position','fixed');
  	 header.css('top', '0');
  	 header.css('left', '0');
  	 

  }

   else {
   header.css('position','relative');
      
  }
   if (window.pageYOffset > 1500  && $('#navbar').height() > 2000) {
  	 $('#animalogosection').css('position','fixed');
  	

  }
  else {
   
       $('#animalogosection').css('position','relative');
  }
}
let object = 0;
$('.nav__item-link').on('click',function(){
	tp = $(this).attr('tp');
	if(tp != object){
	$('.nav__submenu').css('max-height', '0rem');
	$('#'+ tp).css('max-height', '15rem');
	object = tp;
}
else{
	$('.nav__submenu').css('max-height', '0rem');
	object = 0;
}
});


	$('#search2').on('click', () => {
		if(navbutton.attr('class') == 'close'){
	navbutton.css('justify-content','center');
	$('#navbutton span').removeClass('navclose');
	$('#navbutton span').addClass('navopen');
	navbutton.removeClass('close');
	navbutton.addClass('open');
	$('footer').css('left','350px');
	$('#container').css('left','350px');
	$('body').css('overflow-y','hidden');
	$('body').css('overflow-x','hidden');

	}
	else if(navbutton.attr('class') == 'open'){
	
	navbutton.css('justify-content','space-between');
	$('#navbutton span').removeClass('navopen');
	$('#navbutton span').addClass('navclose');
	navbutton.removeClass('open');
	navbutton.addClass('close');
	$('#container').css('left','0px');
	$('footer').css('left','0px');
	
	setTimeout("$('body').css('overflow-y','auto')", 1000);

	}
	});
	$('input').on('mouseenter', function(event) {
        $(this).attr('autocomplete', 'off')
});
$( document ).ready(function() {
	if($('#sec').html().trim() === ''){

		$('#sec').append('<div id="ifempty"></div>');
	}
});	

var $h2 = $('h2').filter(function() {
    return $(this).text() === "Реклама";    
});
var $a = $('a').filter(function() {
    return $(this).text() === "Forgot your password?";    
});
$a.remove();
$h2.remove();


