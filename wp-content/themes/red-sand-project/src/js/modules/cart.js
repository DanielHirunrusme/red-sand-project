var settings = require("modules/settings"),
	HTMLhistory = require("html5-history-api");

var cart = module.exports = {
		$window: $( window ),
 	   
		init:function(){
			console.log('%c [cart.init]', 'color:blue');
			
			$('.cart-link').on('click', cart.toggleCart);
		},
		
		toggleCart:function(e){
			e.preventDefault();
			$('body').toggleClass('cart');
			if($('body').hasClass('cart')) {
				HTMLhistory.pushState(null, null, '/cart');
			}
			
		},
		
		hideCart:function(){
			
			if($('body').hasClass('cart')) {
				$('body').removeClass('cart');
			}
			
		}
};
  