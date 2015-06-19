(function($){
	
	$(document).ready(function(){
		
		var fitrow = function(){
			$('.row').each(function(){
				var row = $(this);
				var height = 0;
				$(this).children().each(function(){
					if($(this).height() > height){
						height = $(this).height();
					}
				});
				row.css({height:height});				
			});
		} 
		
		fitrow();		
		$(window).resize(fitrow);
		
	});
	
}(jQuery));