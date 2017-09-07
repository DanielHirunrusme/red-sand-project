var settings = require( "modules/settings" );
	
module.exports = function( el ) {
		var $el = $( el ),
		$window = $( window );
 
 
 	    init();
 
		function init(){
			console.log('%c [prints.init]', 'color:blue')
			setPrints();
			setPrintContainers();
			
			$('.print').on('mouseover', printButtonOver);
		}
		
		function printButtonOver(e){
			var index = $(e.currentTarget).closest('.page-inner-content').index();
			
			$('#right-panel article[data-page="prints"] .page-inner-content').removeClass('active');
			$('#right-panel article[data-page="prints"] .page-inner-content').eq(index).addClass('active');
			
		}
		
		function setPrints(){
			$('.print-thumbnail').each(function(){
				var bgImage = $(this).data('bg');
				var index = $(this).closest('.page-inner-content').index()
			
				$('#right-panel article[data-page="prints"]').find('.page-inner-content').eq(index).css('background-image', 'url('+ bgImage +')')
			})
		}
		
		function setPrintContainers(){
			
			$('#right-panel article[data-page="prints"] .page-inner-content').each(function(){
				$(this).css('width', $(window).width() - $('#left-panel').width());
			})
			
		}
		
};
  