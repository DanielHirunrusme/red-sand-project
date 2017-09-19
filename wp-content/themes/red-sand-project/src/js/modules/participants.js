var settings = require( "modules/settings" );
	
module.exports = function( el ) {
		var $el = $( el ),
		$window = $( window );
	
		
		init();
		
		function init(){
			$el.find('button').on('mouseover', staffOver).on('mouseout', staffOut);
		}
		
		function staffOver(e){
			console.log($(e.currentTarget).data('name'));
		}
		
		function staffOut(e){
			
		}
	
		

		
};
  