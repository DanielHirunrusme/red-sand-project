jQuery(document).ready(function($){
  	console.log('%c [frontend-ajax.js init]', 'color:blue')
	
	$("form.cart button[type='submit']").click(function(e) {
		console.log('submitted')
		e.preventDefault();

		var product_id = $(this).closest('.product').data('product-id');
		var quantity = $(this).closest('.cart').find('input[name="quantity"]').val();
		//$('.cart-dropdown-inner').empty();
		
		console.log('product_id ' + product_id);
		console.log('quantity ' + quantity);
		
		$.ajax ({
                    url: frontend_ajax_object.ajaxurl,
                    type:'POST',
                    data:'action=my_wc_add_cart&product_id=' + product_id + '&quantity='+ quantity,
			
                    success:function(results) {
						//console.log(results)
						$('#cart').html(results); 
						$('body').addClass('cart');
						history.pushState(null, "cart", "/cart");
						var newCount = parseInt($('.cart-count').html(), 10) + parseInt(quantity, 10);
						
						$('.cart-count').html( newCount );
						$('.cart-link').removeClass('disabled');
                        //$('.cart-dropdown-inner').html(results);
                    }
               });
    });
	console.log( $("form.cart button[type='submit']") )
	
	
	
});