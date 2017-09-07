var scrollContainers = require("modules/scrollContainers"),
	settings = require("modules/settings"),
	HTMLhistory = require("html5-history-api");


var menu = module.exports = {
		$window: $( window ),
		currentArticle:'about',
		isScrolling: false,
		location: window.history.location || window.location,
 	   
		init: function(){
			console.log('%c [menu.init]', 'color:blue');
			$('.home-link').on('click', menu.homeLinkClick);
			$('.menu-item a').on('click', menu.menuLinkClick); 
			
			$('#left-panel .main').on('scroll', menu.leftPanelScroll);
			
			$(window).on('popstate', function(e) {

	          // here can cause data loading, etc.

	          // just post
			   //console.log(location)
				settings.isScrolling = true;
				
				if(location.href != '/'){
					$('.menu-item a').each(function(){
						if($(this).attr('href') == location.href) {
							var page = $(this).data('page');
							menu.setCurrentMenuItem(page);
							scrollContainers.scrollTo(page);
						}
					})
				} else {
					menu.setCurrentMenuItem('about');
					scrollContainers.scrollTo('about');
				}
				
			  //scrollContainers.scrollTo(location.href);
	          //alert("We returned to the page with a link: " + location.href);
	        });
		},
		
		homeLinkClick: function(e) {
			e.preventDefault();
			//scrollContainers.scrollHome();
			//menu.setCurrentMenuItem('home');
			scrollContainers.scrollTo('about');
			HTMLhistory.pushState(null, null, '/');
		},
		
		menuLinkClick: function(e){
			e.preventDefault();
			console.log('menuLinkClick')
			var $targ = $(e.currentTarget);
			var page = $targ.data('page');
			
			settings.isScrolling = true;
			
			menu.setCurrentMenuItem(page);
			scrollContainers.scrollTo(page);
			
			console.log($targ.attr('href'));
			
			//HTMLhistory.pushState(null, null, $targ.attr('href'));
		},
		
		setCurrentMenuItem: function(pageName) {
			$('.menu-item a').removeClass('active');
			$('.menu-item a[data-page="'+ pageName +'"]').addClass('active');
			HTMLhistory.pushState(null, null, $('.menu-item a[data-page="'+ pageName +'"]').attr('href'));
		},
		
		scrollListenMenus: function(){
			
			$('#left-panel article').each(function(){
				$this = $(this);
				if ($('#left-panel .main').scrollTop() > $('#left-panel .main').scrollTop() + $this.position().top - $(window).height()/2) {
					//console.log($this)
					menu.currentArticle = $this.data('page')
				}
			})
			
			$('.menu-item a').each(function(){
				if($(this).data('page') == menu.currentArticle) {
					menu.setCurrentMenuItem($(this).data('page'));
				}
			});
			
			//console.log(menu.currentArticle);
		},
		
		leftPanelScroll: function(){
			if (settings.isScrolling) return false;
			menu.scrollListenMenus();
		}
};
  