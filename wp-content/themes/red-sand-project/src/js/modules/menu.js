var scrollContainers = require("modules/scrollContainers"),
	settings = require("modules/settings"),
	HTMLhistory = require("html5-history-api"),
	cart = require("modules/cart");


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
			    console.log('location.href ' + location.href)
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
			
			//menu.scrollListenMenus();
			
			
			var str = settings.page.current.toString();
			
			$('.menu-item a').each(function(){
				if(~str.indexOf($(this).data('url'))) {
					menu.setCurrentMenuItem($(this).data('page'));
				}
			});
		},
		
		homeLinkClick: function(e) {
			e.preventDefault();
			//scrollContainers.scrollHome();
			//menu.setCurrentMenuItem('home');
			scrollContainers.scrollTo('about');
			HTMLhistory.pushState(null, null, '/');
			cart.hideCart();
		},
		
		menuLinkClick: function(e){
			e.preventDefault();
			console.log('menuLinkClick')
			var $targ = $(e.currentTarget);
			var page = $targ.data('page');
			var url = $targ.data('url');
			
			settings.isScrolling = true;
			
			menu.setCurrentMenuItem(page);
			scrollContainers.scrollTo(page);
			
			console.log($targ.attr('href'));
			
			HTMLhistory.pushState(null, null, $targ.attr('href'));
			cart.hideCart();
		},
		
		setCurrentMenuItem: function(pageName) {
			
			//HTMLhistory.pushState(null, null, $('.menu-item a[data-page="'+ pageName +'"]').attr('href'));
			

			
			
			if(!$('.menu-item a[data-page="'+ pageName +'"]').hasClass('active')) {
				$('.menu-item a').removeClass('active');
				$('.menu-item a[data-page="'+ pageName +'"]').addClass('active');
				if(!settings.isScrolling){
					console.log('pushState')
					HTMLhistory.pushState(null, null, $('.menu-item a[data-page="'+ pageName +'"]').attr('href'));
				}
			}
			
			
		},
		
		scrollListenMenus: function(){
			
			$('#left-panel article').each(function(){
				$this = $(this);
				if ($('#left-panel .main').scrollTop() > $('#left-panel .main').scrollTop() + $this.position().top - $(window).height()/2) {
					//console.log($this)
					menu.currentArticle = $this.data('url')
					
				}
			})
			
			if(settings.page.current != menu.currentArticle) {
				settings.page.current = menu.currentArticle;
				HTMLhistory.pushState(null, null, settings.page.current);
				console.log(menu.currentArticle)
				
				$('.menu-item a').each(function(){
					if(~menu.currentArticle.indexOf($(this).data('url'))) {
						console.log('matches nav parent ' + $(this).data('page'))
						menu.setCurrentMenuItem($(this).data('page'));
					}
				});
			}
			
			
			
			
			
			//console.log(menu.currentArticle);
		},
		
		leftPanelScroll: function(){
			if (settings.isScrolling) return false;
			menu.scrollListenMenus();
		}
};
  