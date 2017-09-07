var settings = require( "modules/settings" ),
	scrollContainers = require("modules/scrollContainers");
	
module.exports = function( el ) {
		var $el = $( el ),
		$window = $( window );
 
 
 	    init();
 
		function init(){
			console.log('%c [prints.init]', 'color:blue')
			setPrints();
			setPrintContainers();
			
			$('.print').on('mouseover', printButtonOver).on('mouseout', printButtonOut).on('click', printButtonClick)
		}
		
		function printButtonOver(e){
			//var index = $(e.currentTarget).closest('.page-inner-content').index();
			
			//$('#right-panel article[data-page="prints"] .page-inner-content').removeClass('active');
			//$('#right-panel article[data-page="prints"] .page-inner-content').eq(index).addClass('active');
			
		}
		
		function printButtonOut(){
			//$('#right-panel article[data-page="prints"] .page-inner-content').removeClass('active');
		}
		
		function printButtonClick(e){
			var index = $(e.currentTarget).closest('.page-inner-content').index();
			
			$('#right-panel article[data-page="prints"] .page-inner-content').removeClass('active').off('click');
			$('#right-panel article[data-page="prints"] .page-inner-content').eq(index).addClass('active').on('click', printContainerClick);
			
			scrollContainers.scrollTo('prints');
			
			$('.close-button').on('click', closeClickPrint);
		}
		
		function printContainerClick(e) {
			var targ = $(e.currentTarget);
			
			$('body').toggleClass('print-full-bleed');
		}
		
		function closeClickPrint(){
			
			$('body').removeClass('print-full-bleed');
			$('.close-button').off('click', closeClickPrint);
			
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
  