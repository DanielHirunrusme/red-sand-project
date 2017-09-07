var scrollContainers = require("modules/scrollContainers"),
	settings = require("modules/settings");


var menu = module.exports = {
		$window: $( window ),
		currentArticle:'about',
		isScrolling: false,
 	   
		init: function(){
			console.log('%c [menu.init]', 'color:blue');
			$('.home-link').on('click', menu.homeLinkClick);
			$('.menu-item a').on('click', menu.menuLinkClick); 
			
			$('#left-panel .main').on('scroll', menu.leftPanelScroll);
		},
		
		homeLinkClick: function(e) {
			e.preventDefault();
			//scrollContainers.scrollHome();
			//menu.setCurrentMenuItem('home');
			scrollContainers.scrollTo('about');
		},
		
		menuLinkClick: function(e){
			e.preventDefault();
			var $targ = $(e.currentTarget);
			var page = $targ.data('page');
			
			settings.isScrolling = true;
			
			menu.setCurrentMenuItem(page);
			scrollContainers.scrollTo(page);
		},
		
		setCurrentMenuItem: function(pageName) {
			$('.menu-item a').removeClass('active');
			$('.menu-item a[data-page="'+ pageName +'"]').addClass('active');
		},
		
		scrollListenMenus: function(){
			
			$('#left-panel article').each(function(){
				$this = $(this);
				if ($('#left-panel .main').scrollTop() > $('#left-panel .main').scrollTop() + $this.position().top - $(window).height()/2) {
					console.log($this)
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
  