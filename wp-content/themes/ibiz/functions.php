<?php
add_action( 'wp_enqueue_scripts', 'iBiz_theme_setup_enqueue_styles' );
function iBiz_theme_setup_enqueue_styles() {
	$parent_style = 'awada'; // This is 'awada' for the Awada theme.
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array( 'bootstrap' ) );
    wp_enqueue_style( 'ibiz',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style, 'bootstrap' ),
        wp_get_theme()->get('Version')
    );

}

// Add child theme settings to options array - UPDATED 20180819
function iBiz_updateoption_child_settings() {

	// Set possible options names
	$name_options_parent  = 'awada_theme_options';
	
	// Get options values (theme options)
	$options_free = get_option( $name_options_parent );

	// Get child settinsg values
	$options_child_settings = get_option( 'ibiz_child_theme_option_updated' );
	// Only set child settings values if not already set 
	if ( $options_child_settings != 1 ) {
		$options_free['header_topbar_bg_color'] = '#f8504b';
		$options_free['copyright_section_bg_color'] = '#f8504b';
		$options_free['footer_text_color'] = '#f8504b';
		$options_free['nav_color'] = '#f8504b';
		$options_free['back_to_top'] = '#f8504b';
		$options_free['color_scheme'] = 'orange.css';

		// Add child settings to theme options array
		update_option( $name_options_parent, $options_free );

	}

	// Set the child settings flag
	update_option( 'ibiz_child_theme_option_updated', 1 );

}
add_action( 'init', 'iBiz_updateoption_child_settings', 999 );
