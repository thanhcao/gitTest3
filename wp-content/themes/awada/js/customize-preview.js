(function ($) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '#alogo' ).text( to );
		});
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});
	wp.customize('custom_logo', function (value) {
        value.bind(function (to) {
            $('.custom-logo').attr('src', to);
        });
    });
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
				// Add class for different logo styles if title and description are hidden.
				$( 'body' ).addClass( 'title-tagline-hidden' );
			} else {

				$( '.site-title, .site-description' ).css({
					clip: 'auto',
					position: 'relative'
				});
				$( '.site-title, .site-description' ).css({
					color: to
				});
				// Add class for different logo styles if title and description are visible.
				$( 'body' ).removeClass( 'title-tagline-hidden' );
			}
		});
	});

    wp.customize('awada_theme_options[logo_layout]', function (value) {
        value.bind(function (to) {
            $('#logo').css('float', to);
        });
    });
    /* layout option */
    wp.customize('awada_theme_options[footer_layout]', function (value) {
        value.bind(function (to) {
            var col = 12 / parseInt(to);
            $('#awada_footer_area > .home_footer').children().attr('class', 'col-sm-' + col);
        });
    });
	/* Slider Options */
	wp.customize('awada_theme_options[home_slider_enabled]', function (value) {
        value.bind(function (to) {
			if (!to) {
                $('#slider').hide();
            } else {
                $('#slider').show();
            }
        });
    });
    /* Service Options */
    wp.customize('awada_theme_options[home_service_title]', function (value) {
        value.bind(function (to) {
            $('h2#home_service_title').html('' + to);
        });
    });
	wp.customize('awada_theme_options[home_service_description]', function (value) {
        value.bind(function (to) {
            $('p#home_service_description').html('' + to);
        });
    });
    wp.customize('awada_theme_options[service_icon_1]', function (value) {
        value.bind(function (to) {
            $('#service_icon_1').attr('class', to);
        });
    });
    wp.customize('awada_theme_options[service_icon_2]', function (value) {
        value.bind(function (to) {
            $('#service_icon_2').attr('class', to);
        });
    });
    wp.customize('awada_theme_options[service_icon_3]', function (value) {
        value.bind(function (to) {
            $('#service_icon_3').attr('class', to);
        });
    });
    wp.customize('awada_theme_options[service_icon_4]', function (value) {
        value.bind(function (to) {
            $('#service_icon_4').attr('class', to);
        });
    });
    wp.customize('awada_theme_options[service_title_1]', function (value) {
        value.bind(function (to) {
            $('#service_title_1').html(to);
        });
    });
    wp.customize('awada_theme_options[service_title_2]', function (value) {
        value.bind(function (to) {
            $('#service_title_2').html(to);
        });
    });
    wp.customize('awada_theme_options[service_title_3]', function (value) {
        value.bind(function (to) {
            $('#service_title_3').html(to);
        });
    });
    wp.customize('awada_theme_options[service_title_4]', function (value) {
        value.bind(function (to) {
            $('#service_title_4').html(to);
        });
    });
    wp.customize('awada_theme_options[service_text_1]', function (value) {
        value.bind(function (to) {
            $('#service_description_1').html(to);
        });
    });
    wp.customize('awada_theme_options[service_text_2]', function (value) {
        value.bind(function (to) {
            $('#service_description_2').html(to);
        });
    });
    wp.customize('awada_theme_options[service_text_3]', function (value) {
        value.bind(function (to) {
            $('#service_description_3').html(to);
        });
    });
    wp.customize('awada_theme_options[service_text_4]', function (value) {
        value.bind(function (to) {
            $('#service_description_4').html(to);
        });
    });
    wp.customize('awada_theme_options[service_link_1]', function (value) {
        value.bind(function (to) {
            $('#service_link_1').attr('href', to);
        });
    });
    wp.customize('awada_theme_options[service_link_2]', function (value) {
        value.bind(function (to) {
            $('#service_link_2').attr('href', to);
        });
    });
    wp.customize('awada_theme_options[service_link_3]', function (value) {
        value.bind(function (to) {
            $('#service_link_3').attr('href', to);
        });
    });
    wp.customize('awada_theme_options[service_link_4]', function (value) {
        value.bind(function (to) {
            $('#service_link_4').attr('href', to);
        });
    });
    /* Portfolio Options */
    wp.customize('awada_theme_options[home_portfolio_title]', function (value) {
        value.bind(function (to) {
            $('#portfolio_heading').html(to);
        });
    });
    /* Blog Options */
    wp.customize('awada_theme_options[home_blog_title]', function (value) {
        value.bind(function (to) {
            $('#blog_heading').html(to);
        });
    });
	wp.customize('awada_theme_options[home_blog_description]', function (value) {
        value.bind(function (to) {
            $('#blog_description').html(to);
        });
    });
	
    /* Footer Callout */
    wp.customize('awada_theme_options[home_callout_title]', function (value) {
        value.bind(function (to) {
            $('#callout_title').html(to);
        });
    });
    wp.customize('awada_theme_options[home_callout_description]', function (value) {
        value.bind(function (to) {
            $('#callout_description').html(to);
        });
    });

    wp.customize('awada_theme_options[callout_btn_link]', function (value) {
        value.bind(function (to) {
            $('a#callout_link').attr('href', to);
        });
    });
    wp.customize('awada_theme_options[callout_btn_text]', function (value) {
        value.bind(function (to) {
            $('.intro_text').html(to);
        });
    });
	/* Header Contact and Social  */
    wp.customize('awada_theme_options[show_topbar]', function (value) {
        value.bind(function (to) {
            if (!to)
                $('#sitetopbar').hide();
            else
                $('#sitetopbar').show();
        });
    });
    wp.customize('awada_theme_options[contact_info_header]', function (value) {
        value.bind(function (to) {
            if (!to)
                $('#topbar-contact').hide();
            else
                $('#topbar-contact').show();
        });
    });
	wp.customize('awada_theme_options[contact_phone]', function (value) {
        value.bind(function (to) {
            $('.topbar-contact-phone').html(to);
        });
    });
	wp.customize('awada_theme_options[contact_email]', function (value) {
        value.bind(function (to) {
            $('.topbar-contact-email').html(to);
        });
    });
	wp.customize('awada_theme_options[social_media_header]', function (value) {
        value.bind(function (to) {
            if (!to)
                $('#topbar-social-links').hide();
            else
                $('#topbar-social-links').show();
        });
    });
	//footer widget menu
	wp.customize('awada_theme_options[show_footer_widget]', function (value) {
        value.bind(function (to) {
            if (!to)
                $('#awada_footer_area').hide();
            else
                $('#awada_footer_area').show();
        });
    });
	//footer menu
	wp.customize('awada_theme_options[footer_menu_enabled]', function (value) {
        value.bind(function (to) {
            if (!to)
                $('.footer-area-menu').hide();
            else
                $('.footer-area-menu').show();
        });
    });
	//Copyright
	wp.customize('awada_theme_options[copyright_text_enabled]', function (value) {
        value.bind(function (to) {
            if (!to)
                $('.footer_copy_text').hide();
            else
                $('.footer_copy_text').show();
        });
    });
	wp.customize('awada_theme_options[footer_copyright]', function (value) {
        value.bind(function (to) {
            $('#copyright_text').html(to);
        });
    });
	wp.customize('awada_theme_options[developed_by_text]', function (value) {
        value.bind(function (to) {
            $('#developed_by_text').html(to);
        });
    });
	wp.customize('awada_theme_options[developed_by_link]', function (value) {
        value.bind(function (to) {
            $('#copyright_link').attr('href', to);
        });
    });
	wp.customize('awada_theme_options[developed_by_link_text]', function (value) {
        value.bind(function (to) {
            $('#copyright_link_text').html(to);
        });
    });
})(jQuery);