jQuery(document).ready(function($) {
	// nav menu animation
	$('#menu-icon').toggle(function(){
		$('header').animate({right: '25%'}, 500);
		$('#main-content').animate({right: '25%'}, 500);
		$('footer').animate({right: '25%'}, 500);
		setTimeout(function(){
			$('nav').css('z-index',1);
		}, 500);
		$(this).addClass('active-menu-icon');
	}, function(){
		$('nav').css('z-index',-1);
		$('header').animate({right: '0%'}, 500);
		$('#main-content').animate({right: '0%'}, 500);
		$('footer').animate({right: '0%'}, 500);
		$(this).removeClass('active-menu-icon');
	});
	// slideshow functionality
	if ( $('#slideshow')[0] ) {
		$('.thumb').click(function() {
			var target = $(this).attr('id');
			var num = target.substring(6);
			$('.thumb img').removeClass('active-thumb');
			$('.slide').hide();
			$('#slide-'+num).show();
			$('img',this).addClass('active-thumb');
		}); // click method end
	}
	// footer height
	$( window ).resize(function() {
		var docHeight = $(document).outerHeight();
		var headerHeight = $('header').outerHeight();
		var contentHeight = $('#main-content').outerHeight();
		$('footer').height(docHeight-headerHeight-contentHeight-40); //40 = footer padding
	}).resize();
});