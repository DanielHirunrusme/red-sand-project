var mousewheel = require("jquery-mousewheel"),
	settings = require("modules/settings");

var scrollContainers = module.exports = {
		$window: $( window ),
		initTarget: false,
		$leftScrollPanel: $('#left-panel .main'),
		$rightScrollPanel: $('#right-panel .main'),
 	   
		init: function(){
			
			scrollContainers.sizeRightContainers();
			scrollContainers.setRightPanel();
			scrollContainers.setLine();
			
			console.log('scrollContainers init');
			
			$(window).on('mousewheel', function(e){
				
				scrollContainers.initTarget = e.target.offsetParent;
				if($(e.target).closest('section').attr('id')=='right-panel') {
					$('#right-panel .main').on( 'scroll', syncLeft);
					$('#right-panel .main').on('mousewheel', scrollContainers.mouseWheel);
				} else {
					$('#left-panel .main').on( 'scroll', syncRight);
				}
				$(window).off('mousewheel');
			})
			
			
			var $divs = $('#left-panel .main, #right-panel .main');
			var syncLeft = function(e){
				//menu.scrollListenMenus();
				scrollContainers.moveLine();
			    var $other = $('#left-panel .main'), other = $other.get(0);
			    var percentage = $('#right-panel .main').scrollLeft() / ($('#right-panel .main')[0].scrollWidth - $('#right-panel .main')[0].offsetWidth);
			    var percent = $(window).height()/$(window).width()
				other.scrollTop = percent * $('#right-panel .main').scrollLeft()
				//other.scrollTop = percentage * (other.scrollHeight - other.offsetHeight);
			    // Firefox workaround. Rebinding without delay isn't enough.
			    //setTimeout( function(){ $other.on('scroll', sync ); },10);
			}
			
			var syncRight = function(e){
				//menu.scrollListenMenus();
				scrollContainers.moveLine();
			    var $other = $('#right-panel .main'), other = $other.get(0);
				// - $(window).width() - $(window).height() + $('#left-panel').width()/2
			    var percentage = $('#left-panel .main').scrollTop() / ($('#left-panel .main')[0].scrollHeight - $('#left-panel .main')[0].offsetHeight );
			    var percent = $(window).width()/$(window).height()
				console.log(percent)
				other.scrollLeft = percent * $('#left-panel .main').scrollTop()
			    // Firefox workaround. Rebinding without delay isn't enough.
			    //setTimeout( function(){ $other.on('scroll', sync ); },10);
			}
			
			$('#right-panel').on('mouseover', function(){
				$('#right-panel .main').on( 'scroll', syncLeft);
				$('#right-panel .main').on('mousewheel', scrollContainers.mouseWheel);
			}).on('mouseout', function(){
				$('#right-panel .main').off( 'scroll', syncLeft);
				$('#right-panel .main').off('mousewheel', scrollContainers.mouseWheel);
			});
			
			$('#left-panel').on('mouseover', function(){
				$('#left-panel .main').on( 'scroll', syncRight);
			}).on('mouseout', function(){
				$('#left-panel .main').off( 'scroll', syncRight);
			});
			
			
			
			
			
			
		},
		
		mouseWheel: function(e) {
			
		
			
			$('#right-panel .main').scrollLeft( $('#right-panel .main').scrollLeft()-e.deltaY );
		},
		
		sizeRightContainers: function(){
			
			console.log( 'l-panel article count: ' + $('#left-panel article').length );
			console.log( 'r-panel article count: ' + $('#right-panel article').length );
			
			$('#left-panel .page-content').each(function(){
				
				$el = $(this);
				$container = $('#right-panel .page-content').eq( $el.index() );
				
				//if container height is larger than window, then size right panel proportionally
				if( $el.height() > $(window).height() ) {
					
					var percentage = $el.height()/$(window).height();
					console.log(percentage);
					$container.css('width', $(window).width() * percentage );
					
					
				}
				
			});
			
		},
		
		setRightPanel: function(){
			
			$('.inner-main').css('width', $('#right-panel article').length * $(window).width() );
			
			$('#right-panel article').each(function(){
				$el = $(this);
				if( $el.index() > 0 ) {
					$el.css('left', $('#right-panel article').eq($el.index()-1).width() + $('#right-panel article').eq($el.index()-1).position().left);
				}
				
			});
			
			
		},
		
		setLine: function(){
			
			//var h = $(window).height();
			var h = $(window).height();
			var w = Math.round( h * 2.6187 );
			
			$('.line-img').css('height', h).css('width', w);
			
		},
		
		moveLine: function(){
			
			console.log('moveline ')
			var x = -$('#right-panel .main').scrollLeft();
			console.log(x);
			
		    var percentage = $('#right-panel .main').scrollLeft() / ($('#right-panel .main')[0].scrollWidth - $('#right-panel .main')[0].offsetWidth);
		    x = -(percentage * ($('.line-img').width() - $('#right-panel .page-inner-content').width()) );
			
			$('.line-img').css({"-webkit-transform":"translate("+ x +"px, 0px)"});​
			
		},
		
		scrollHome: function(){
			scrollContainers.$leftScrollPanel.stop().animate({scrollTop:0}, 400);
			//scrollContainers.$rightScrollPanel.animate({scrollLeft:0}, 400);
		},
		
		scrollTo: function(pageName){
			var $targ = scrollContainers.$leftScrollPanel.find('article[data-page="'+ pageName +'"]')
			scrollContainers.$leftScrollPanel.stop().animate({scrollTop:scrollContainers.$leftScrollPanel.scrollTop() + $targ.position().top}, 400, function(){
				settings.isScrolling = false;
			});
		}
};
  