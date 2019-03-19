(function($) {
 "use strict"
	$("body").fitVids();

	jQuery(function(){
		jQuery("#P1").YTPlayer();
	});
	
	jQuery("#services").owlCarousel({
		items : 3,
		lazyLoad : true,
		navigation : false,
		pagination : true,
		autoPlay: true
    });
	
	// WOW
	new WOW(
		{ offset: 300 }
	).init();
			
	// DM Top
	jQuery(window).scroll(function(){
		if (jQuery(this).scrollTop() > 1) {
			jQuery('.awadatop').css({bottom:"25px"});
		} else {
			jQuery('.awadatop').css({bottom:"-100px"});
		}
	});
	jQuery('.awadatop').click(function(){
		jQuery('html, body').animate({scrollTop: '0px'}, 800);
		return false;
	});

// Pretty Photo for blog
$('a[data-gal]').each(function() {
	$(this).attr('rel', $(this).data('gal'));
});  	
$("a[data-gal^='prettyPhoto']").prettyPhoto({animationSpeed:'slow',slideshow:false,overlay_gallery: false,theme:'light_square',social_tools:false,deeplinking:false});

$(".awada-header-fixed").affix({
	offset: {
	  top: 50,
	  bottom: function () {
		return (this.bottom = $('#copyrights').outerHeight(true))
	  }
	}
});


/*====================================
    main slider
    ======================================*/
    $('.classic-main-wrapper').each(function () {
      var carousel = $(this),
          loop = carousel.data('loop'),
          items = carousel.data('items'),
          margin = carousel.data('margin'),
          stagePadding = carousel.data('stage-padding'),
          autoplay = carousel.data('autoplay'),
          autoplayTimeout = carousel.data('auto  play-timeout'),
          smartSpeed = carousel.data('smart-speed'),
          dots = carousel.data('dots'),
          nav = carousel.data('nav'),
          navSpeed = carousel.data('nav-speed'),
          rXsmall = carousel.data('r-x-small'),
          rXsmallNav = carousel.data('r-x-small-nav'),
          rXsmallDots = carousel.data('r-x-small-dots'),
          rXmedium = carousel.data('r-x-medium'),
          rXmediumNav = carousel.data('r-x-medium-nav'),
          rXmediumDots = carousel.data('r-x-medium-dots'),
          rSmall = carousel.data('r-small'),
          rSmallNav = carousel.data('r-small-nav'),
          rSmallDots = carousel.data('r-small-dots'),
          rMedium = carousel.data('r-medium'),
          rMediumNav = carousel.data('r-medium-nav'),
          rMediumDots = carousel.data('r-medium-dots'),
          rLarge = carousel.data('r-large'),
          rLargeNav = carousel.data('r-large-nav'),
          rLargeDots = carousel.data('r-large-dots'),
          center = carousel.data('center'),
          pauseonhover = carousel.data('pause-on-hover');

      carousel.owlCarousel({
          loop: (loop ? true : false),
          items: (items ? items : 1),
          lazyLoad: true,
          margin: (margin ? margin : 0),
          autoplay: (autoplay ? true : false),
          autoplayTimeout: (autoplayTimeout ? autoplayTimeout :4000),
          smartSpeed: (smartSpeed ? smartSpeed :600),
          dots: (dots ? true : false),
          nav: (nav ? true : false),
          navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"],
          navSpeed: (navSpeed ? true : false),
          autoplayHoverPause:(pauseonhover ? true : false),
          center: (center ? true : false),
          responsiveClass: true,
          responsive: {
              0: {
                  items: (rXsmall ? rXsmall : 1),
                  nav: (rXsmallNav ? true : false),
                  dots: (rXsmallDots ? true : false)
              },
              480: {
                  items: (rXmedium ? rXmedium : 1),
                  nav: (rXmediumNav ? true : false),
                  dots: (rXmediumDots ? true : false)
              },
              768: {
                  items: (rSmall ? rSmall : 1),
                  nav: (rSmallNav ? true : false),
                  dots: (rSmallDots ? true : false)
              },
              992: {
                  items: (rMedium ? rMedium : 1),
                  nav: (rMediumNav ? true : false),
                  dots: (rMediumDots ? true : false)
              },
              1199: {
                  items: (rLarge ? rLarge : 1),
                  nav: (rLargeNav ? true : false),
                  dots: (rLargeDots ? true : false)
              }
          }
      });

  });



/* Slider */
var Page = (function() {

	var $navArrows = $( '#nav-arrows' ),
		$nav = $( '#nav-dots > span' ),
		slitslider = $( '#slider' ).slitslider( {
			autoplay : true,
			speed : 1500,
			onBeforeChange : function( slide, pos ) {

				$nav.removeClass( 'nav-dot-current' );
				$nav.eq( pos ).addClass( 'nav-dot-current' );

			}
		} ),

		init = function() {

			initEvents();
			
		},
		initEvents = function() {

			// add navigation events
			$navArrows.children( ':last' ).on( 'click', function() {

				slitslider.next();
				return false;

			} );

			$navArrows.children( ':first' ).on( 'click', function() {
				
				slitslider.previous();
				return false;

			} );

			$nav.each( function( i ) {
			
				$( this ).on( 'click', function( event ) {
					
					var $dot = jQuery( this );
					
					if( !slitslider.isActive() ) {

						$nav.removeClass( 'nav-dot-current' );
						$dot.addClass( 'nav-dot-current' );
					
					}
					
					slitslider.jump( i + 1 );
					return false;
				
				} );
				
			} );

		};

		return { init : init };

})();

Page.init();

})(jQuery);