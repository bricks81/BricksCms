(function($){
	
	$(document).ready(function(){
		
		var fitrow = function(){
			
			var windowWidth = $(window).width();			
			if(windowWidth<768){
				var lookfor = 'xs';
			} else if(windowWidth<992){
				var lookfor = 'sm';
			} else if(windowWidth<1200){
				var lookfor = 'md';
			} else {
				var lookfor = 'lg';
			}
				
			$('.row-fit-height').each(function(){
				var row = $(this);
				var height = 0;
				$(this).children().each(function(){
					if($(this).height() > height){
						switch(lookfor){
							case 'lg':
								var has = 
									$(this).hasClass('col-lg-full-height')
									|| $(this).hasClass('col-md-full-height')
									|| $(this).hasClass('col-sm-full-height')
									|| $(this).hasClass('col-sx-full-height')
								break;
							case 'md':
								var has = 
									$(this).hasClass('col-md-full-height')
									|| $(this).hasClass('col-sm-full-height')
									|| $(this).hasClass('col-sx-full-height')
								break;
							case 'sm':
								var has = 
									$(this).hasClass('col-sm-full-height')
									|| $(this).hasClass('col-sx-full-height')
								break;
							case 'xs':
								var has = $(this).hasClass('col-sx-full-height')
								break;
						}
						if(has){
							height = $(this).height();
						}
					}
				});
				if(0==height){
					row.css({height:'auto'});
				} else {
					row.css({height:height});
				}
			});
		} 
		
		fitrow();		
		$(window).resize(fitrow);
		
		$('nav.nav > ul > li').hover(function(){
			$(this).children('ul').fadeIn(150);
		},function(){
			$(this).children('ul').fadeOut(150);
		});
		
		$('nav.nav > ul > li > ul > li').hover(function(){
			$(this).children('ul').fadeIn(150);
		},function(){
			$(this).children('ul').fadeOut(150);
		})
		
		var showSubMenu = function(){			
			$(this).parent().find('ul').slideDown();
		}
		
	});
	
}(jQuery));