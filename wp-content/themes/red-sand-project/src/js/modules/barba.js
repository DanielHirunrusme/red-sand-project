var barbajs = require( "barba.js" );


var barba = module.exports = {

init: function(){
	
	barbajs.Pjax.start();
	console.log('barba init')
	
	barbajs.Dispatcher.on('newPageReady', function(currentStatus, oldStatus, container) {
		barba.setBodyClass();
		barba.initModules();
	});
	
	var FadeTransition = barbajs.BaseTransition.extend({
	  start: function() {
	    /**
	     * This function is automatically called as soon the Transition starts
	     * this.newContainerLoading is a Promise for the loading of the new container
	     * (Barba.js also comes with an handy Promise polyfill!)
	     */

	    // As soon the loading is finished and the old page is faded out, let's fade the new page
	    Promise
	      .all([this.newContainerLoading, this.fadeOut()])
	      .then(this.fadeIn.bind(this));
	  },

	  fadeOut: function() {
	    /**
	     * this.oldContainer is the HTMLElement of the old Container
	     */

	    return $(this.oldContainer).animate({ opacity: 0 }).promise();
	  },

	  fadeIn: function() {
	    /**
	     * this.newContainer is the HTMLElement of the new Container
	     * At this stage newContainer is on the DOM (inside our #barba-container and with visibility: hidden)
	     * Please note, newContainer is available just after newContainerLoading is resolved!
	     */

	    var _this = this;
	    var $el = $(this.newContainer);

	    $(this.oldContainer).hide();

	    $el.css({
	      visibility : 'visible',
	      opacity : 0
	    });

	    $el.animate({ opacity: 1 }, 400, function() {
	      /**
	       * Do not forget to call .done() as soon your transition is finished!
	       * .done() will automatically remove from the DOM the old Container
	       */

	      _this.done();
	    });
	  }
	});

	/**
	 * Next step, you have to tell Barba to use the new Transition
	 */

	barbajs.Pjax.getTransition = function() {
	  /**
	   * Here you can use your own logic!
	   * For example you can use different Transition based on the current page or link...
	   */

	  return FadeTransition;
	};
	
},

setBodyClass: function(){
	var page_class = $('.page-template').last().data('template');
	
	$('body').removeClass().addClass(page_class);
},

initModules: function(){
    var modules = $('#barba-wrapper').find( "[data-module-init]" );

    for ( var i = 0; i < modules.length; i++ ) {
      var el = modules[ i ];
      var names = el.getAttribute( "data-module-init" ).split( " " );
      var Module;

      for ( var j = 0; j < names.length; j++ ) {
  	      try {
  	        Module = require( "modules/" + names[ j ] );
  	      } catch ( e ) {
  	        Module = false;
  	        console.log( names[ j ] + " module does not exist." );
  	      }

        // Initialize the module with the calling element
        if ( Module ) {
          new Module( el );
        }
      }
    }
   
}


	
};
