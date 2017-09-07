var settings = require( "modules/settings" ),
	scrollContainers = require("modules/scrollContainers"),
	cart = require("modules/cart"),
	menu = require("modules/menu");

	
module.exports = function( el ) {
		var $el = $( el ),
		$window = $( window ),
		resizeTimer;
 
 
 	    init();
 
		function init(){
			
			//barba.init();
			scrollContainers.init();
			cart.init();
			menu.init();
			
			$window.on('resize', winResize);
		}
		
		function animOff(){
			$('body').addClass('noTransition');
		}
		
		function animOn(){
			$('body').removeClass('noTransition');
		}
		
		function winResizeEnd(){
			animOn();
		}
		
		function winResize(){
			clearTimeout(resizeTimer);
			animOff();
			
			resizeTimer = setTimeout(function(){
				winResizeEnd();
			}, 300);
		} 
		
};
  