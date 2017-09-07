var settings = require("modules/settings");

var cart = module.exports = {
		$window: $( window ),
 	   
		init:function(){
			console.log('%c [cart.init]', 'color:blue');
			
			$('.cart-link').on('click', cart.toggleCart);
		},
		
		toggleCart:function(e){
			e.preventDefault();
			$('body').toggleClass('cart-open');
		}
};
  