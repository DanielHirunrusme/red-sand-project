var scrollContainers = require("modules/scrollContainers");

module.exports = function( el ) {
		var $el = $( el ),
		$lat = $el.find('.latitude'),
		$long = $el.find('.longitude'),
		$window = $( window ),
		startLat = 32.5344052,
		startLong = -117.12396100000001,
		endLat = 25.954885,
		endLong = -97.146377;
		
		init();
		
		function init(){
			$(scrollContainers.$rightScrollPanel).on('scroll', latLongScroll);
		}
		
		function latLongScroll(){
			var sc  = $(scrollContainers.$rightScrollPanel).scrollLeft()/( $(scrollContainers.$rightScrollPanel)[0].scrollWidth - $(window).width() );
			var lat_num = (startLat - (sc * (startLat-endLat))).toFixed(7);
			
			var long_num = (startLong - (sc * (startLong-endLong))).toFixed(7);
			
			$lat.text('+'+lat_num);
			$long.text(long_num);
		}
		

		
};
  