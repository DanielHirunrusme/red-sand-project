var settings = require( "modules/settings" );
	
module.exports = function( el ) {
		var $el = $( el ),
	$window = $( window );
	
	
	var SelectedRegions = ["DZ","AR","AM","AU","AT","AZ","BY","BE","BR","BG","CA","CL","CO","HR","CY","CZ","DK","EG","EE","FI","FR","GE","DE","GH","GR","HU","IN","ID","IQ","IE","IL","IT","KZ","KR","LV","LY","LT","LU","MK","MY","MR","MX","MD","MA","NL","NZ","NO","PK","PS","PH","PL","PT","PR","RO","RU","SA","RS","SG","SK","SI","ZA","ES","LK","SE","CH","TH","TN","TR","UA","GB","US","UY","UZ"];
	
	var wrld = {
		  map: 'world_mill_en',
		  backgroundColor: 'transparent',
		  selectedRegions: SelectedRegions,
		  zoomOnScroll: false,
			regionStyle: {
		      initial: {
		        fill: '#f1a5a5'
		      },
			  hover: {
			  "fill-opacity": 0.8,
				fill: '#f1a5a5',
				cursor: 'default'
			  },
		      selected: {
		        fill: '#dd3333'
		       }
			 },
		    onRegionTipShow: function(e, el, code){
     	
		     	//console.log(rspData[code]);
				  	if (typeof rspData[code] != 'undefined')	{
						//if ( $q(document).width() > 1023 ) {
						//console.log('map mouseover: ' + el.nodeName );
						el.html(rspData[code]).fadeIn(250);
						el.css({border: 'solid 1px #c9292e'});
						el.css({display: 'block'});
						el.css({backgroundColor: '#fff'});
						el.css({color:'#c9292e'});
						el.css({zIndex:'10'});
						el.children().css({padding: '15px'});
						el.attr('id', code);
						//}
					} else {
						//console.log('mouseout');
						el.html(null);
						el.css({border: 'none'});
						el.children().css({padding: '0'});
					}
			 	}
		};
		
		var rspData = {"DZ":"<div class=\"infobox\"><strong>Algeria</strong><br />22 kits</div>","AR":"<div class=\"infobox\"><strong>Argentina</strong><br />4 kits</div>","AM":"<div class=\"infobox\"><strong>Armenia</strong><br />20 kits</div>","AU":"<div class=\"infobox\"><strong>Australia</strong><br />512 kits</div>","AT":"<div class=\"infobox\"><strong>Austria</strong><br />68 kits</div>","AZ":"<div class=\"infobox\"><strong>Azerbaijan</strong><br />50 kits</div>","BY":"<div class=\"infobox\"><strong>Belarus</strong><br />10 kits</div>","BE":"<div class=\"infobox\"><strong>Belgium</strong><br />30 kits</div>","BR":"<div class=\"infobox\"><strong>Brazil</strong><br />688 kits</div>","BG":"<div class=\"infobox\"><strong>Bulgaria</strong><br />22 kits</div>","CA":"<div class=\"infobox\"><strong>Canada</strong><br />2,845 kits</div>","CL":"<div class=\"infobox\"><strong>Chile</strong><br />30 kits</div>","CO":"<div class=\"infobox\"><strong>Colombia</strong><br />60 kits</div>","HR":"<div class=\"infobox\"><strong>Croatia</strong><br />12 kits</div>","CY":"<div class=\"infobox\"><strong>Cyprus</strong><br />44 kits</div>","CZ":"<div class=\"infobox\"><strong>Czech Rep.</strong><br />4 kits</div>","DK":"<div class=\"infobox\"><strong>Denmark</strong><br />295 kits</div>","EG":"<div class=\"infobox\"><strong>Egypt</strong><br />2 kits</div>","EE":"<div class=\"infobox\"><strong>Estonia</strong><br />28 kits</div>","FI":"<div class=\"infobox\"><strong>Finland</strong><br />4 kits</div>","FR":"<div class=\"infobox\"><strong>France</strong><br />74 kits</div>","GE":"<div class=\"infobox\"><strong>Georgia</strong><br />30 kits</div>","DE":"<div class=\"infobox\"><strong>Germany</strong><br />6,484 kits</div>","GH":"<div class=\"infobox\"><strong>Ghana</strong><br />10 kits</div>","GR":"<div class=\"infobox\"><strong>Greece</strong><br />86 kits</div>","HU":"<div class=\"infobox\"><strong>Hungary</strong><br />4 kits</div>","IN":"<div class=\"infobox\"><strong>India</strong><br />591 kits</div>","ID":"<div class=\"infobox\"><strong>Indonesia</strong><br />20 kits</div>","IQ":"<div class=\"infobox\"><strong>Iraq</strong><br />4 kits</div>","IE":"<div class=\"infobox\"><strong>Ireland</strong><br />67 kits</div>","IL":"<div class=\"infobox\"><strong>Israel</strong><br />22 kits</div>","IT":"<div class=\"infobox\"><strong>Italy</strong><br />206 kits</div>","KZ":"<div class=\"infobox\"><strong>Kazakhstan</strong><br />84 kits</div>","KR":"<div class=\"infobox\"><strong>Korea</strong><br />3 kits</div>","LV":"<div class=\"infobox\"><strong>Latvia</strong><br />24 kits</div>","LY":"<div class=\"infobox\"><strong>Libya</strong><br />2 kits</div>","LT":"<div class=\"infobox\"><strong>Lithuania</strong><br />34 kits</div>","LU":"<div class=\"infobox\"><strong>Luxembourg</strong><br />126 kits</div>","MK":"<div class=\"infobox\"><strong>Macedonia</strong><br />20 kits</div>","MY":"<div class=\"infobox\"><strong>Malaysia</strong><br />64 kits</div>","MR":"<div class=\"infobox\"><strong>Mauritania</strong><br />4 kits</div>","MX":"<div class=\"infobox\"><strong>Mexico</strong><br />96 kits</div>","MD":"<div class=\"infobox\"><strong>Moldova</strong><br />56 kits</div>","MA":"<div class=\"infobox\"><strong>Morocco</strong><br />290 kits</div>",
		"NL":"<div class=\"infobox\"><strong>Netherlands</strong><br />76 kits</div>","NZ":"<div class=\"infobox\"><strong>New Zealand</strong><br />556 kits</div>","NO":"<div class=\"infobox\"><strong>Norway</strong><br />60 kits</div>","PK":"<div class=\"infobox\"><strong>Pakistan</strong><br />126 kits</div>","PS":"<div class=\"infobox\"><strong>Palestine</strong><br />20 kits</div>","PH":"<div class=\"infobox\"><strong>Philippines</strong><br />92 kits</div>","PL":"<div class=\"infobox\"><strong>Poland</strong><br />186 kits</div>","PT":"<div class=\"infobox\"><strong>Portugal</strong><br />22 kits</div>","PR":"<div class=\"infobox\"><strong>Puerto Rico</strong><br />1,703 kits</div>","RO":"<div class=\"infobox\"><strong>Romania</strong><br />54 kits</div>","RU":"<div class=\"infobox\"><strong>Russia</strong><br />896 kits</div>","SA":"<div class=\"infobox\"><strong>Saudi Arabia</strong><br />10 kits</div>","RS":"<div class=\"infobox\"><strong>Serbia</strong><br />32 kits</div>","SG":"<div class=\"infobox\"><strong>Singapore</strong><br />208 kits</div>","SK":"<div class=\"infobox\"><strong>Slovakia</strong><br />2 kits</div>","SI":"<div class=\"infobox\"><strong>Slovenia</strong><br />530 kits</div>","ZA":"<div class=\"infobox\"><strong>South Africa</strong><br />180 kits</div>","ES":"<div class=\"infobox\"><strong>Spain</strong><br />113 kits</div>","LK":"<div class=\"infobox\"><strong>Sri Lanka</strong><br />20 kits</div>","SE":"<div class=\"infobox\"><strong>Sweden</strong><br />2 kits</div>","CH":"<div class=\"infobox\"><strong>Switzerland</strong><br />12 kits</div>","TH":"<div class=\"infobox\"><strong>Thailand</strong><br />10 kits</div>","TN":"<div class=\"infobox\"><strong>Tunisia</strong><br />85 kits</div>","TR":"<div class=\"infobox\"><strong>Turkey</strong><br />41 kits</div>","UA":"<div class=\"infobox\"><strong>Ukraine</strong><br />102 kits</div>","GB":"<div class=\"infobox\"><strong>United Kingdom</strong><br />1,010 kits</div>","US":"<div class=\"infobox\"><strong>United States</strong><br />197,721 kits</div>","UY":"<div class=\"infobox\"><strong>Uruguay</strong><br />80 kits</div>","UZ":"<div class=\"infobox\"><strong>Uzbekistan</strong><br />4 kits</div>",};
 	   
	   var $q = jQuery.noConflict();
 
 	    init();
 
		function init(){
			console.log('%c [map.init]', 'color:blue')
			setMap();
		}
		
		function setMap(){
			$el.vectorMap(wrld);
			$el.resize();
			var mapObj = $el.vectorMap('get', 'mapObject');
			
			
			
		}
		
		function dropHeadline() {
	
			$(".jvectormap-container").mouseover(function (event) {
				$("#overlay").delay(2000).fadeOut( 2000, function() {
					$("#overlay").remove();
				  });
			});

		};
		

		
};
  