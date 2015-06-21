(function($){
	
	$(document).ready(function(){
		
		// could not be solved using css
		$('nav > ul > li > ul li ul').each(function(){
			$(this).parent().children('a').addClass('extendable');			
		});
				
	});
	
}(jQuery));