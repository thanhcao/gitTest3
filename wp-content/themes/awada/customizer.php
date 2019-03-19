<?php
$banner_img = get_template_directory_uri() . '/images/banner.jpg';
function awada_customizer_preview_js()
{
    wp_enqueue_script('custom_css_preview', get_template_directory_uri() . '/js/customize-preview.js', array('customize-preview', 'jquery'));
}
add_action('customize_preview_init', 'awada_customizer_preview_js');
function awada_controls_enqueue_scripts($wp_customize)
{
    wp_enqueue_script('awada_customize_control', get_template_directory_uri() . '/js/customize_custom_control.js', array('jquery', 'customize-controls'));
}
add_action('customize_controls_enqueue_scripts', 'awada_controls_enqueue_scripts', 11);
/* Modifying existing controls */
add_action( 'customize_register', function( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'custom_logo' )->transport          = 'postMessage';
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '#alogo',
		'render_callback' => function(){
			bloginfo( 'name' );
		},
	) );
	
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => function(){
			bloginfo( 'description' );
		},
	) );
} );
function awada_render_footer_copyright(){
	$awada_theme_options = awada_theme_options();
	echo '<div class="footer_copy_text">
		<p><span id="copyright_text">'.esc_attr($awada_theme_options['footer_copyright']).'</span><span id="developed_by_text"> '.esc_attr($awada_theme_options['developed_by_text']).' </span><a id="copyright_link" href="'. esc_url($awada_theme_options['developed_by_link']).'"><span id="copyright_link_text">'.esc_attr($awada_theme_options['developed_by_link_text']).'</span></a></p>
	</div>';
}
function awada_partial_refresh_callout_btn(){
	$awada_theme_options = awada_theme_options();
	echo '<a id="callout_link" class="btn btn-dark btn-lg btn-shadow" href="'.$awada_theme_options['callout_btn_link'].'" target="_blank"><span class="intro_text">'.$awada_theme_options['callout_btn_text'].'</span></a>';
}
function awada_render_contact_email(){
	$awada_theme_options = awada_theme_options();
	$out = '<i class="fa fa-envelope"></i> <a href="mailto:'.$awada_theme_options['contact_email'].'">'.$awada_theme_options['contact_email'].'</a>';
	return $out;
}
function awada_render_contact_phone(){
	$awada_theme_options = awada_theme_options();
	$out = '<i class="fa fa-phone-square"></i> '.$awada_theme_options['contact_phone'];
	return $out;
}

/* Add Customizer Panel */
$awada_theme_options = awada_theme_options();
Kirki::add_config('awada_theme', array(
    'capability'  => 'edit_theme_options',
    'option_type' => 'option',
    'option_name' => 'awada_theme_options',
));
Kirki::add_panel('awada_option_panel', array(
    'priority'    => 10,
    'title'       => __('Awada Options', 'awada'),
    'description' => __('Here you can customize all your site contents', 'awada'),
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'header_topbar_bg_color',
    'label'             => __('Header Top Bar Background Color', 'awada'),
    'description'       => __('Change Top bar Background Color', 'awada'),
    'section'           => 'colors',
    'type'              => 'color',
    'priority'          => 9,
    'default'           => '',
    'transport'         =>'auto',
    'output'            => array(
        array(
            'element'  => '#sitetopbar',
            'property' => 'background',
        ),
        array(
            'element'  => '#sitetopbar',
            'property' => 'border-bottom',
        ),
    ),
));

Kirki::add_field('awada_theme', array(
    'settings'          => 'header_topbar_color',
    'label'             => __('Header Top Bar Text Color', 'awada'),
    'description'       => __('Change Top bar Font/Content Color', 'awada'),
    'section'           => 'colors',
    'type'              => 'color',
    'priority'          => 9,
    'default'           => '#fff',
    'sanitize_callback' => 'awada_sanitize_color',
    'output'            => array(
        array(
            'element'  => '#sitetopbar, #sitetopbar a',
            'property' => 'color',
        ),
    ),
    'transport'         => 'auto',
));

Kirki::add_field('awada_theme', array(
    'settings'          => 'header_background_color',
    'label'             => __('Header Background Color', 'awada'),
    'description'       => __('Change Header Background Color', 'awada'),
    'section'           => 'colors',
    'type'              => 'color',
    'priority'          => 9,
    'default'           => '#fff',
    'sanitize_callback' => 'awada_sanitize_color',
    'output'            => array(
        array(
            'element'  => '#awada-header, #awada-header .navbar',
            'property' => 'background',
        ),
		array(
            'element'  => '.arrow-up',
            'property' => 'border-bottom',
        ),
    ),
    'transport'         => 'auto',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'header_textcolor',
    'label'             => __('Header Text Color', 'awada'),
    'description'       => __('Change Header Text Color', 'awada'),
    'section'           => 'colors',
    'type'              => 'color',
    'priority'          => 9,
    'default'           => '#222222',
    'sanitize_callback' => 'awada_sanitize_color',
    'output'            => array(
        array(
            'element'  => '.navbar-default .navbar-brand, #awada-header .navbar-nav > li > a, .dropdown-menu > li > a,.site-title a, .site-description',
            'property' => 'color',
        ),
    ),
    'transport'         => 'auto',
));

Kirki::add_section('general_sec', array(
    'title'       => __('General Options', 'awada'),
    'description' => __('Here you can change basic settings of your site', 'awada'),
    'panel'       => 'awada_option_panel',
    'priority'    => 158,
    'capability'  => 'edit_theme_options',
));

Kirki::add_field( 'awada_theme', array(
    'type'        => 'preset',
    'settings'    => 'color_scheme',
    'label'       => __( 'Color Scheme', 'awada' ),
    'section'     => 'general_sec',
    'default'     => 'default.css',
    'priority'    => 10,
    'choices'     => array(
        'default.css' => array(
            'label'    => __('Default','awada'),
            'settings' => array(
                'awada_theme_options[header_topbar_bg_color]' => '#31a3dd',
            ),
        ),
		'green.css' => array(
            'label'    => __('Green','awada'),
            'settings' => array(
                'awada_theme_options[header_topbar_bg_color]' => '#33a568',
            ),
        ),
		'DonJuan.css' => array(
            'label'    => __('Coffee','awada'),
            'settings' => array(
                'awada_theme_options[header_topbar_bg_color]' => '#5C4B51',
            ),
        ),
        'orange.css' => array(
            'label'    => __('Orange','awada'),
            'settings' => array(
                'awada_theme_options[header_topbar_bg_color]' => '#f8504b',
            ),
        ),
        
    ),
) );
/* topbar Options */
Kirki::add_field('awada_theme', array(
    'settings'          => 'topbar_heading',
    'label'             => __('Topbar Options', 'awada'),
    'section'           => 'general_sec',
    'type'              => 'heading',
    'priority'          => 10,
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'show_topbar',
    'label'             => __('Show Top bar', 'awada'),
    'section'           => 'general_sec',
    'type'              => 'switch',
    'priority'          => 10,
    'default'           => $awada_theme_options['show_topbar'],
    'sanitize_callback' => 'awada_sanitize_checkbox',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'contact_info_header',
    'label'             => __('Header Contact Info', 'awada'),
    'description'       => __('Show/Hide contact info bar in header', 'awada'),
    'section'           => 'general_sec',
    'type'              => 'switch',
    'priority'          => 10,
    'default'           => $awada_theme_options['contact_info_header'],
    'sanitize_callback' => 'awada_sanitize_checkbox',
    'active_callback' => array(
        array(
            'setting'  => 'show_topbar',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'contact_email',
    'label'             => __('Contact Email Address', 'awada'),
    'section'           => 'general_sec',
    'type'              => 'text',
    'priority'          => 10,
    'transport'         => 'postMessage',
    'default'           => $awada_theme_options['contact_email'],
    'sanitize_callback' => 'sanitize_email',
    'partial_refresh' => array(
        'contact_email' => array(
            'selector'        => '.topbar-contact-email',
            'render_callback' => 'awada_render_contact_email',
        ),
    ),
    'active_callback' => array(
        array(
            'setting'  => 'show_topbar',
            'operator' => '==',
            'value'    => true,
        ),
        array(
            'setting'  => 'contact_info_header',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'contact_phone',
    'label'             => __('Phone Number', 'awada'),
    'section'           => 'general_sec',
    'type'              => 'text',
    'priority'          => 10,
    'transport'         => 'postMessage',
    'default'           => $awada_theme_options['contact_phone'],
    'sanitize_callback' => 'awada_sanitize_text',
    'partial_refresh' => array(
        'contact_phone' => array(
            'selector'        => '.topbar-contact-phone',
            'render_callback' => 'awada_render_contact_phone',
        )
    ),
    'active_callback' => array(
        array(
            'setting'  => 'show_topbar',
            'operator' => '==',
            'value'    => true,
        ),
        array(
            'setting'  => 'contact_info_header',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'social_media_heder',
    'label'             => __('Add Social Media Icons', 'awada'),
    'section'           => 'general_sec',
    'type'              => 'custom',
    'priority'          => 10,
    'default'           => sprintf(__('Create a new menu and then add the URL for each social profile to your menu as a custom link. %1$s Create Now %2$s', 'awada'), '<br><a class="button" href="javascript:wp.customize.control( \'nav_menu_locations[social]\' ).focus();">', '</a>'),
    'active_callback' => array(
        array(
            'setting'  => 'show_topbar',
            'operator' => '==',
            'value'    => true,
        ),
    ),
));
/* logo spacing */
Kirki::add_field('awada_theme', array(
    'settings'          => 'logo_top_spacing',
    'label'             => __('Logo Top Spacing', 'awada'),
    'section'           => 'title_tagline',
    'type'              => 'slider',
    'priority'          => 40,
    'default'           => 0,
    'choices'           => array(
        'max'  => 50,
        'min'  => -50,
        'step' => 1,
    ),
    'transport'         => 'auto',
    'output'            => array(
        array(
            'element'  => '#awada-header .dropmenu img',
            'property' => 'margin-top',
            'units'    => 'px',
        ),
		array(
            'element'  => '#awada-header .site-branding-text',
            'property' => 'margin-top',
            'units'    => 'px',
        ),
    ),
    'sanitize_callback' => 'awada_sanitize_number',
));

/* Typography */
Kirki::add_section('typography_sec', array(
    'title'       => __('Typography Section', 'awada'),
    'description' => __('Here you can change Font Style of your site', 'awada'),
    'panel'       => 'awada_option_panel',
    'priority'    => 160,
    'capability'  => 'edit_theme_options',
));

Kirki::add_field('awada_theme', array(
    'type'        => 'typography',
    'settings'    => 'logo_font',
    'label'       => __('Logo Font Style', 'awada'),
    'description' => __('Change logo font family and font style.', 'awada'),
    'section'     => 'typography_sec',
    'default'     => array(
        'font-style'  => array('bold', 'italic'),
        'font-family' => 'Eagle Lake',
		'font-size'   => '28px',
    ),
    'priority'    => 10,
    'choices'     => array(
        'font-style'  => true,
        'font-family' => true,
        'font-size'   => true,
        'line-height' => true,
        'font-weight' => true,
    ),
    
    'output'      => array(
        array(
            'element' => '#awada-header .site-branding-text h1, #awada-header .site-branding-text p.site-title',
        ),
    ),
));
Kirki::add_field('awada_theme', array(
    'type'        => 'typography',
    'settings'    => 'logo_sub_font',
    'label'       => __('Logo Subtitle/Description Font Style', 'awada'),
    'description' => __('Change logo Subtitle/Description font family and font style.', 'awada'),
    'section'     => 'typography_sec',
    'default'     => array(
        'font-style'  => array('bold', 'italic'),
        'font-family' => 'Eagle Lake',
		'font-size'   => '14px',
    ),
    'priority'    => 10,
    'choices'     => array(
        'font-style'  => true,
        'font-family' => true,
        'font-size'   => true,
        'line-height' => true,
        'font-weight' => true,
    ),
    
    'output'      => array(
        array(
            'element' => '#awada-header .site-branding-text p.site-description',
        ),
    ),
));
Kirki::add_field('awada_theme', array(
    'type'        => 'typography',
    'settings'    => 'menu_font',
    'label'       => __('Menu Font Style', 'awada'),
    'description' => __('Change Primary Menu font family and font style.', 'awada'),
    'section'     => 'typography_sec',
    'default'     => array(
        'font-style'  => array('bold', 'italic'),
        'font-family' => "Merriweather","Georgia", "serif",

    ),
    'priority'    => 10,
    'choices'     => array(
        'font-style'  => true,
        'font-family' => true,
        'font-size'   => true,
        'line-height' => true,
        'font-weight' => true,
    ),
    'output'      => array(
        array(
            'element' => '#awada-header .navbar-nav > li > a',
        ),
    ),
));

/* Full body typography */
Kirki::add_field('awada_theme', array(
    'type'        => 'typography',
    'settings'    => 'site_font',
    'label'       => __('Site Font Style', 'awada'),
    'description' => __('Change whole site font family and font style.', 'awada'),
    'section'     => 'typography_sec',
    'default'     => array(
        'font-style'  => array('bold', 'italic'),
        'font-family' => "Merriweather","Georgia", "serif",
    ),
    'priority'    => 10,
    'choices'     => array(
        'font-style'  => true,
        'font-family' => true,
    ),
    'output'      => array(
        array(
            'element' => 'body, h1, h2, h3, h4, h5, h6, p, em, blockquote',
        ),
    ),
));
/* Home title typography */
Kirki::add_field('awada_theme', array(
    'type'        => 'typography',
    'settings'    => 'site_title_font',
    'label'       => __('Home Sections Title Font', 'awada'),
    'description' => __('Change font style of home service, home portfolio, home blog', 'awada'),
    'section'     => 'typography_sec',
    'default'     => array(
        'font-style'  => array('bold', 'italic'),
        'font-family' => "Merriweather","Georgia", "serif",
    ),
    'priority'    => 10,
    'choices'     => array(
        'font-style'  => true,
        'font-family' => true,
        'font-size'   => true,
        'line-height' => true,
        'font-weight' => true,
    ),
    'output'      => array(
        array(
            'element' => '.main_title h2',
        ),
    ),
));
/* Layout section */
Kirki::add_section('layout_sec', array(
    'title'       => __('Layout Options', 'awada'),
    'description' => __('Here you can change Layout and basic design of your site', 'awada'),
    'panel'       => 'awada_option_panel',
    'priority'    => 160,
    'capability'  => 'edit_theme_options',
    'transport'   => 'postMessage',
));
Kirki::add_field('awada_theme', array(
    'type'              => 'toggle',
    'settings'          => 'headersticky',
    'label'             => __('Fixed Header', 'awada'),
    'description'       => __('Switch between fixed and static header', 'awada'),
    'section'           => 'layout_sec',
    'default'           => $awada_theme_options['headersticky'],
    'priority'          => 10,
    'sanitize_callback' => 'awada_sanitize_checkbox',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'site_layout',
    'label'             => __('Site Layout', 'awada'),
    'description'       => __('Change your site layout to full width or boxed size.', 'awada'),
    'section'           => 'layout_sec',
    'type'              => 'radio-image',
    'priority'          => 10,
    'default'           => '',
    'sanitize_callback' => 'awada_sanitize_text',
    'choices'           => array(
        ''           => get_template_directory_uri() . '/images/layout/1c.png',
        'boxed' => get_template_directory_uri() . '/images/layout/3cm.png',
    ),

));
Kirki::add_field('awada_theme', array(
    'settings'          => 'footer_layout',
    'label'             => __('Footer Layout', 'awada'),
    'description'       => __('Change footer into 2, 3 or 4 column', 'awada'),
    'section'           => 'layout_sec',
    'type'              => 'radio-image',
    'priority'          => 10,
    'default'           => $awada_theme_options['footer_layout'],
    'transport'         => 'postMessage',
    'choices'           => array(
        2 => get_template_directory_uri() . '/images/layout/footer-widgets-2.png',
        3 => get_template_directory_uri() . '/images/layout/footer-widgets-3.png',
        4 => get_template_directory_uri() . '/images/layout/footer-widgets-4.png',
    ),
    'sanitize_callback' => 'awada_sanitize_number',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'blog_layout',
    'label'             => __('Blog Post Layout', 'awada'),
    'description'       => __('Select Blog Layout', 'awada'),
    'help'              => __('With this option you can select blog left sidebar,right sidebar and full width', 'awada'),
    'section'           => 'layout_sec',
    'type'              => 'radio-image',
    'priority'          => 10,
    'default'           => $awada_theme_options['blog_layout'],
    'choices'           => array(
        'rightsidebar' => get_template_directory_uri() . '/images/layout/2cr.png',
        'leftsidebar'  => get_template_directory_uri() . '/images/layout/2cl.png',
        'fullwidth'  => get_template_directory_uri() . '/images/layout/1c.png',
    ),
    'sanitize_callback' => 'awada_sanitize_text',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'post_layout',
    'label'             => __('Single Post Layout', 'awada'),
    'description'       => __('Select Post Layout', 'awada'),
    'help'              => __('With this option you can select single post with left sidebar,right sidebar and full width', 'awada'),
    'section'           => 'layout_sec',
    'type'              => 'radio-image',
    'priority'          => 10,
    'default'           => $awada_theme_options['post_layout'],
    'choices'           => array(
        'leftsidebar' => get_template_directory_uri() . '/images/layout/2cl.png',
        'rightsidebar' => get_template_directory_uri() . '/images/layout/2cr.png',
        'fullwidth' => get_template_directory_uri() . '/images/layout/1c.png',
    ),
    'sanitize_callback' => 'awada_sanitize_text',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'page_layout',
    'label'             => __('Page Layout', 'awada'),
    'description'       => __('Select Page Layout', 'awada'),
    'help'              => __('With this option you can select page with left sidebar,right sidebar and full width', 'awada'),
    'section'           => 'layout_sec',
    'type'              => 'radio-image',
    'priority'          => 10,
    'default'           => $awada_theme_options['page_layout'],
    'choices'           => array(
        'leftsidebar' => get_template_directory_uri() . '/images/layout/2cl.png',
        'rightsidebar' => get_template_directory_uri() . '/images/layout/2cr.png',
        'fullwidth' => get_template_directory_uri() . '/images/layout/1c.png',
    ),
    'sanitize_callback' => 'awada_sanitize_text',
));
/* Slider */
Kirki::add_section('slider_sec', array(
    'title'       => __('Slider Options', 'awada'),
    'description' => __('Change slider text(s) and images', 'awada'),
    'panel'       => 'awada_option_panel',
    'priority'    => 160,
    'capability'  => 'edit_theme_options',
));

Kirki::add_field('awada_theme', array(
    'settings'          => 'home_slider_enabled',
    'label'             => __('Enable Home Slider', 'awada'),
    'section'           => 'slider_sec',
    'type'              => 'switch',
    'priority'          => 10,
    'default'           => 1,
	'transport'         => 'postMessage',
    'sanitize_callback' => 'awada_sanitize_checkbox',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'slider_style',
    'label'             => __('Home Slider Style', 'awada'),
    'section'           => 'slider_sec',
    'type'              => 'select',
    'priority'          => 10,
    'default'           => 2,
    'choices'           => array(
        1 => __('Slider Style One', 'awada'),
        2 => __('Slider Style Two', 'awada'),
        3 => __('Slider Using Plugin Shortcode', 'awada'),
    ),
    'sanitize_callback' => 'awada_sanitize_number',
));
$num = array(1 => 'One', 2 => 'Two', 3 => 'Three');
for ($i = 1; $i <= 3; $i++) {
    Kirki::add_field('awada_theme', array(
        'settings'          => 'slider_heading_' . $i,
        'label'             => sprintf(__('Slider %s', 'awada'), $num[$i]),
        'section'           => 'slider_sec',
        'type'              => 'heading',
        'priority'          => 10,
        'sanitize_callback' => 'awada_sanitize_text',
		'required'  => array(
            array(
                'setting'  => 'slider_style',
                'operator' => '!=',
                'value'    => 3,
            ),
        )
    ));
    Kirki::add_field('awada_theme', array(
        'settings'    => 'slider_img_' . $i,
        'label'       => sprintf(__('Slider %s Image', 'awada'), $num[$i]),
        'description' => __('Recommended image size is 1600x500px', 'awada'),
        'type'        => 'image',
        'section'     => 'slider_sec',
        'priority'    => 10,
        'default'     => get_template_directory_uri() . '/images/slider/s'.$i.'.jpg',
		'required'  => array(
            array(
                'setting'  => 'slider_style',
                'operator' => '!=',
                'value'    => 3,
            ),
        )
    ));
    Kirki::add_field('awada_theme', array(
        'settings'          => 'slider_title_' . $i,
        'label'             => sprintf(__('Slider %s Title', 'awada'), $num[$i]),
        'type'              => 'text',
        'default'           => $awada_theme_options['slider_title_' . $i],
        'section'           => 'slider_sec',
        'priority'          => 10,
        'sanitize_callback' => 'awada_sanitize_text',
		'required'  => array(
            array(
                'setting'  => 'slider_style',
                'operator' => '!=',
                'value'    => 3,
            ),
        )
    ));
    Kirki::add_field('awada_theme', array(
        'settings'          => 'slider_subtitle_' . $i,
        'label'             => sprintf(__('Slider %s Subitle', 'awada'), $num[$i]),
        'type'              => 'text',
        'default'           => $awada_theme_options['slider_subtitle_' . $i],
        'section'           => 'slider_sec',
        'priority'          => 10,
        'sanitize_callback' => 'awada_sanitize_text',
		'required'  => array(
            array(
                'setting'  => 'slider_style',
                'operator' => '!=',
                'value'    => 3,
            ),
        )
    ));
    Kirki::add_field('awada_theme', array(
        'type'     => 'radio-buttonset',
        'settings' => 'slider_post_page_' . $i,
        'label'    => __('Link this slide to a post or page', 'awada'),
        'section'  => 'slider_sec',
        'default'  => 'post',
        'priority' => 10,
        'choices'  => array(
            'post' => esc_attr__('Post', 'awada'),
            'page' => esc_attr__('Page', 'awada'),
        ),
		'required'  => array(
            array(
                'setting'  => 'slider_style',
                'operator' => '!=',
                'value'    => 3,
            ),
        )
    ));

    Kirki::add_field('awada_theme', array(
        'type'            => 'select',
        'settings'        => 'post_slider_' . $i,
        'label'           => __('Select a post', 'awada'),
        'section'         => 'slider_sec',
        'priority'        => 10,
        'choices'         => Kirki_Helper::get_posts(array('posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC', 'post_type' => 'post', 'post_status' => 'publish')),
        'required'  => array(
            array(
                'setting'  => 'slider_style',
                'operator' => '!=',
                'value'    => 3,
            ),
        ),
		'active_callback' => array(
            array(
                'setting'  => 'slider_post_page_' . $i,
                'operator' => '==',
                'value'    => 'post',
            ),
        ),
    ));
    Kirki::add_field('awada_theme', array(
        'settings'          => 'page_slider_' . $i,
        'label'             => __('Select a page', 'awada'),
        'type'              => 'dropdown-pages',
        'section'           => 'slider_sec',
        'priority'          => 10,
        'sanitize_callback' => 'awada_sanitize_number',
        'active_callback'   => array(
            array(
                'setting'  => 'slider_post_page_' . $i,
                'operator' => '==',
                'value'    => 'page',
            ),
        ),
		'required'  => array(
            array(
                'setting'  => 'slider_style',
                'operator' => '!=',
                'value'    => 3,
            ),
        )
    ));
    Kirki::add_field('awada_theme', array(
        'settings'          => 'slider_readmore_' . $i,
        'label'             => __('Read more button text', 'awada'),
        'type'              => 'text',
        'section'           => 'slider_sec',
        'priority'          => 10,
        'default'           => __('Read More', 'awada'),
        'sanitize_callback' => 'awada_sanitize_text',
        'active_callback'   => function () use ($i) {
            $awada_options = get_option('awada_theme_options');
            if (isset($awada_options['slider_post_page_' . $i]) && $awada_options['slider_post_page_' . $i] == 'post') {
                if (isset($awada_options['post_slider_' . $i]) && $awada_options['post_slider_' . $i] != 0) {return true;}
            } else {
                if (isset($awada_options['page_slider_' . $i]) && $awada_options['page_slider_' . $i] != 0) {return true;}
            }
            return false;
        },
		'required'  => array(
            array(
                'setting'  => 'slider_style',
                'operator' => '!=',
                'value'    => 3,
            ),
        )
    ));
}

Kirki::add_field('awada_theme', array(
    'settings'          => 'slider_plugin_heading',
    'label'             => __('Or Put Slider Plugin Shortcode here', 'awada'),
    'section'           => 'slider_sec',
    'type'              => 'heading',
    'priority'          => 10,
    'sanitize_callback' => 'awada_sanitize_text',
	'required'  => array(
		array(
			'setting'  => 'slider_style',
			'operator' => '==',
			'value'    => 3,
		),
	)
));
Kirki::add_field('awada_theme', array(
    'type'     => 'text',
    'settings' => 'home_slider_shortcode',
    'label'    => __('Plugin Shortcode', 'awada'),
    'section'  => 'slider_sec',
    'priority' => 10,
    'text'     => 'awada_sanitize_text',
	'required'  => array(
		array(
			'setting'  => 'slider_style',
			'operator' => '==',
			'value'    => 3,
		),
	)
));
/* Service Options */
Kirki::add_section('service_sec', array(
    'title'      => __('Service Options', 'awada'),
    'panel'      => 'awada_option_panel',
    'priority'   => 160,
    'capability' => 'edit_theme_options',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'home_service_title',
    'label'             => __('Home Service Heading', 'awada'),
    'section'           => 'service_sec',
    'type'              => 'text',
    'priority'          => 10,
    'transport'         => 'postMessage',
    'default'           => $awada_theme_options['home_service_title'],
    'sanitize_callback' => 'awada_sanitize_text',
	'partial_refresh' => array(
        'home_service_title' => array(
            'selector'            => '#home_service_title',
            'render_callback'     => function(){$awada_theme_options = awada_theme_options(); return $awada_theme_options['home_service_title'];}
        ),
    )
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'home_service_description',
    'label'             => __('Home Service Description', 'awada'),
    'section'           => 'service_sec',
    'type'              => 'textarea',
    'priority'          => 10,
    'transport'         => 'postMessage',
    'default'           => $awada_theme_options['home_service_description'],
    'sanitize_callback' => 'awada_sanitize_textarea',
	'partial_refresh' => array(
        'home_service_description' => array(
            'selector'            => '#home_service_description',
            'render_callback'     => function(){$awada_theme_options = awada_theme_options(); return $awada_theme_options['home_service_description'];}
        ),
    )
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'home_service_column',
    'label'             => __('Home Service Column', 'awada'),
    'section'           => 'service_sec',
    'type'              => 'select',
    'priority'          => 10,
    'default'           => 4,
    'choices'           => array(
        2 => __('Two Column', 'awada'),
        3 => __('Three Column', 'awada'),
        4 => __('Four Column', 'awada'),
    ),
    'sanitize_callback' => 'awada_sanitize_number',
));
for($i=1;$i<=4;$i++){
	$num = array(1=>'One', 2=>'Two', 3=>'Three',4=>'Four');
Kirki::add_field('awada_theme', array(
    'settings'          => 'service_icon_'.$i,
    'label'             => sprintf(__('Service %s Icon','awada'), $num[$i]),
    'section'           => 'service_sec',
    'type'              => 'fontawesome',
    'priority'          => 10,
    'transport'         => 'postMessage',
    'default'           => $awada_theme_options['service_icon_'.$i],
    'sanitize_callback' => 'awada_sanitize_text',
	'partial_refresh' => array(
        'service_icon_'.$i => array(
            'selector'            => '#service_box_'.$i,
            'render_callback'     => function() use($i){$awada_theme_options = awada_theme_options(); return $awada_theme_options['service_icon_'.$i];}
        ),
    )
	
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'service_title_'.$i,
    'label'             => sprintf(__('Service %s Title','awada'), $num[$i]),
    'section'           => 'service_sec',
    'type'              => 'text',
    'priority'          => 10,
    'transport'         => 'postMessage',
    'default'           => $awada_theme_options['service_title_'.$i],
    'sanitize_callback' => 'awada_sanitize_text',
	'partial_refresh' => array(
        'service_title_'.$i => array(
            'selector'            => '#service_title_'.$i,
            'render_callback'     => function() use($i){$awada_theme_options = awada_theme_options(); return $awada_theme_options['service_title_'.$i];}
        ),
    )
	
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'service_text_'.$i,
    'label'             => sprintf(__('Service %s Description','awada'), $num[$i]),
    'section'           => 'service_sec',
    'type'              => 'textarea',
    'priority'          => 10,
    'transport'         => 'postMessage',
    'default'           => $awada_theme_options['service_text_'.$i],
    'sanitize_callback' => 'awada_sanitize_textarea',
	'partial_refresh' => array(
        'service_text_'.$i => array(
            'selector'            => '#service_text_'.$i,
            'render_callback'     => function() use($i){$awada_theme_options = awada_theme_options(); return $awada_theme_options['service_text_'.$i];}
        ),
    )
	
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'service_link_'.$i,
    'label'             => sprintf(__('Service %s URL','awada'), $num[$i]),
    'section'           => 'service_sec',
    'type'              => 'text',
    'priority'          => 10,
    'transport'         => 'postMessage',
    'default'           => $awada_theme_options['service_link_'.$i],
    'sanitize_callback' => 'esc_url',
	'partial_refresh' => array(
        'service_link_'.$i => array(
            'selector'            => '#service_link_'.$i,
            'render_callback'     => function() use($i){$awada_theme_options = awada_theme_options(); return $awada_theme_options['service_link_'.$i];}
        ),
    )
	
));
}

/* Portfolio */
Kirki::add_section('portfolio_sec', array(
    'title'      => __('Portfolio Options', 'awada'),
    'panel'      => 'awada_option_panel',
    'priority'   => 160,
    'capability' => 'edit_theme_options',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'home_portfolio_title',
    'label'             => __('Portfolio Title', 'awada'),
    'section'           => 'portfolio_sec',
    'type'              => 'text',
    'priority'          => 10,
    'transport'         => 'postMessage',
    'default'           => $awada_theme_options['home_portfolio_title'],
    'sanitize_callback' => 'awada_sanitize_text',
    'partial_refresh' => array(
        'home_portfolio_title' => array(
            'selector'            => '#portfolio_heading',
            'render_callback'     => function(){$awada_theme_options = awada_theme_options(); return $awada_theme_options['home_portfolio_title'];}
        ),
    )
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'home_portfolio_subtitle',
    'label'             => __('Portfolio Subtitle', 'awada'),
    'section'           => 'portfolio_sec',
    'type'              => 'textarea',
    'priority'          => 10,
    'transport'         => 'postMessage',
    'default'           => $awada_theme_options['home_portfolio_subtitle'],
    'sanitize_callback' => 'awada_sanitize_textarea',
    'partial_refresh' => array(
        'home_portfolio_subtitle' => array(
            'selector'            => '#portfolio_sub_heading',
            'render_callback'     => function(){$awada_theme_options = awada_theme_options(); return $awada_theme_options['home_portfolio_subtitle'];}
        ),
    )
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'portfolio_post',
    'label'             => __('Select a post', 'awada'),
    'description'       => __('Select the post in which you have put shortcode.', 'awada'),
    'section'           => 'portfolio_sec',
    'type'              => 'select',
    'priority'          => 10,
    'choices'           => Kirki_Helper::get_posts(array('posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC', 'post_type' => 'post', 'post_status' => 'publish')),
    'sanitize_callback' => 'awada_sanitize_number',
));
/* Blog Options */
Kirki::add_section('blog_sec', array(
    'title'      => __('Blog Options', 'awada'),
    'panel'      => 'awada_option_panel',
    'priority'   => 160,
    'capability' => 'edit_theme_options',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'home_blog_title',
    'label'             => __('Home Blog Title', 'awada'),
    'section'           => 'blog_sec',
    'type'              => 'text',
    'priority'          => 10,
    'transport'         => 'postMessage',
    'default'           => $awada_theme_options['home_blog_title'],
    'sanitize_callback' => 'awada_sanitize_text',
	'partial_refresh' => array(
        'home_blog_title' => array(
            'selector'            => '#blog_heading',
            'render_callback'     => function(){$awada_theme_options = awada_theme_options(); return $awada_theme_options['home_blog_title'];}
        ),
    )
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'home_blog_description',
    'label'             => __('Home Blog Description', 'awada'),
    'section'           => 'blog_sec',
    'type'              => 'textarea',
    'priority'          => 10,
    'transport'         => 'postMessage',
    'default'           => $awada_theme_options['home_blog_description'],
    'sanitize_callback' => 'awada_sanitize_textarea',
	'partial_refresh' => array(
        'home_blog_description' => array(
            'selector'            => '#blog_description',
            'render_callback'     => function(){$awada_theme_options = awada_theme_options(); return $awada_theme_options['home_blog_description'];}
        ),
    )
));

Kirki::add_field('awada_theme', array(
    'settings'          => 'blog_post_count',
    'label'             => __('Blog Load More Posts', 'awada'),
    'description'       => __('Show Posts On Blog Home', 'awada'),
    'help'              => __('With this option you can show blog posts according your requirement', 'awada'),
    'section'           => 'blog_sec',
    'type'              => 'number',
    'priority'          => 10,
	'transport'         => 'postMessage',
    'default'           => 3,
    'choices'     => array(
        'min'  => 3,
        'max'  => 30,
        'step' => 1,
    ),
    'sanitize_callback' => 'awada_sanitize_number',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'home_post_cat',
    'label'             => __('Category', 'awada'),
    'description'       => __('Show Posts On Home Blog According to Selected Categories', 'awada'),
    'tooltip'              => __('With this option you can show blog posts according your requirement', 'awada'),
    'section'           => 'blog_sec',
    'type'              => 'select',
	'transport'         => 'postMessage',
    'priority'          => 10,
    'default'           => array(),
	'multiple'          => 1,
    'choices'           => Kirki_Helper::get_terms( array('taxonomy' => 'category') ),
    'sanitize_callback' => 'awada_sanitize_number',
));
Kirki::add_field('awada_theme', array(
    'settings'    => 'show_load_more_btn',
    'label'       => __('Show Load More Button.', 'awada'),
    'section'     => 'blog_sec',
    'type'        => 'switch',
    'priority'    => 10,
    'default'     => 1,
    'choices'     => array(
        'on'  => __('Yes','awada'),
        'off'  => __('No','awada'),
    ),
    'sanitize_callback'=>'awada_sanitize_checkbox'
));
Kirki::add_field('awada_theme', array(
    'settings'    => 'home_load_post_num',
    'label'       => __('Number of load more posts.', 'awada'),
    'description'        => __('Number of posts you want to load on "Load More" button click', 'awada'),
    'section'     => 'blog_sec',
    'type'        => 'number',
    'priority'    => 10,
    'default'     => 3,
    'choices'     => array(
        'min'  => 3,
        'max'  => 10,
        'step' => 1,
    ),
    'sanitize_callback'=>'awada_sanitize_number',
    'active_callback'=>array(
        array(
                'setting'  => 'show_load_more_btn',
                'operator' => '==',
                'value'    => true,
            ),
    )
));

Kirki::add_field('awada_theme', array(
    'settings'          => 'blog_string',
    'label'             => __('Strings Used in Home Blog section', 'awada'),
    'section'           => 'blog_sec',
    'type'              => 'heading',
    'priority'          => 10,
    'sanitize_callback' => 'awada_sanitize_text',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'blog_load_more_text',
    'label'             => __('Load More Text', 'awada'),
    'section'           => 'blog_sec',
    'type'              => 'text',
    'default'           =>$awada_theme_options['blog_load_more_text'],
    'priority'          => 10,
    'sanitize_callback' => 'awada_sanitize_text',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'blog_more_loading',
    'label'             => __('Loading Text', 'awada'),
    'section'           => 'blog_sec',
    'type'              => 'text',
    'default'           =>$awada_theme_options['blog_more_loading'],
    'priority'          => 10,
    'sanitize_callback' => 'awada_sanitize_text',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'blog_no_more_post',
    'label'             => __('No more post Text', 'awada'),
    'section'           => 'blog_sec',
    'type'              => 'text',
    'default'           =>$awada_theme_options['blog_no_more_post'],
    'priority'          => 10,
    'sanitize_callback' => 'awada_sanitize_text',
));
/* Footer Callout */
Kirki::add_section('callout_sec', array(
    'title'      => __('Callout Options', 'awada'),
    'panel'      => 'awada_option_panel',
    'priority'   => 160,
    'capability' => 'edit_theme_options',
));
Kirki::add_field('awada_theme', array(
    'settings' => 'callout_bg_image',
    'label' => __('Banner Background Image', 'awada'),
    'section' => 'callout_sec',
    'type' => 'image',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => $banner_img,
    'sanitize_callback' => 'esc_url_raw',
	'partial_refresh' => array(
		'callout_bg_image' => array(
			'selector'        => '#awada_video',
			'container_inclusive' => true,
			'render_callback' => function(){
				get_template_part('home-callout');
			}
		)
	),
));
Kirki::add_field('awada_theme', array(
    'settings' => 'callout_external_bg_video',
    'label' => __('Or, enter a YouTube URL:', 'awada'),
    'section' => 'callout_sec',
    'type' => 'text',
    'priority' => 10,
    'transport' => 'postMessage',
    'default' => esc_url('https://www.youtube.com/watch?v=jnLSYfObARA'),
    'sanitize_callback' => 'esc_url_raw',
	'partial_refresh' => array(
		'callout_external_bg_video' => array(
			'selector'        => '#awada_video',
			'container_inclusive' => true,
			'render_callback' => function(){
				get_template_part('home-callout');
			}
		)
	),
));
Kirki::add_field('awada_theme', array(
    'settings' => 'callout_bg_video_opt',
    'section' => 'callout_sec',
    'type' => 'custom',
    'priority' => 10,
    'default'     => '<div style="padding: 30px;background-color: #333; color: #fff; border-radius: 50px;">' . esc_html__( 'In Pro Version you can control auto play, audio, and video overlay effect like opacity, brightness, contrast, blur, sepia, gray scale etc.', 'awada' ) . '</div>',
    'sanitize_callback' => 'esc_url_raw',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'home_callout_title',
    'label'             => __('Callout Title', 'awada'),
    'section'           => 'callout_sec',
    'type'              => 'text',
    'priority'          => 10,
    'transport'         => 'postMessage',
    'default'           => $awada_theme_options['home_callout_title'],
    'sanitize_callback' => 'awada_sanitize_text',
	'partial_refresh' => array(
        'home_callout_title' => array(
            'selector'            => '#callout_title',
            'render_callback'     => function(){$awada_theme_options = awada_theme_options(); return $awada_theme_options['home_callout_title'];}
        ),
    )
));

Kirki::add_field('awada_theme', array(
    'settings'          => 'home_callout_description',
    'label'             => __('Show Footer Callout', 'awada'),
    'section'           => 'callout_sec',
    'type'              => 'textarea',
    'priority'          => 10,
    'transport'         => 'postMessage',
    'default'           => $awada_theme_options['home_callout_description'],
    'sanitize_callback' => 'awada_sanitize_textarea',
	'partial_refresh' => array(
        'home_callout_description' => array(
            'selector'            => '#callout_description',
            'render_callback'     => function(){$awada_theme_options = awada_theme_options(); return $awada_theme_options['home_callout_description'];}
        ),
    )
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'callout_btn_text',
    'label'             => __('Callout Button Text', 'awada'),
    'section'           => 'callout_sec',
    'type'              => 'text',
    'priority'          => 10,
    'transport'         => 'postMessage',
    'default'           => $awada_theme_options['callout_btn_text'],
    'sanitize_callback' => 'awada_sanitize_text',
	'partial_refresh' => array(
        'callout_btn_text' => array(
            'selector'            => '#callout_link',
            'render_callback'     => 'awada_partial_refresh_callout_btn'
        ),
    )
));

Kirki::add_field('awada_theme', array(
    'settings'          => 'callout_btn_link',
    'label'             => __('Callout Button URL', 'awada'),
    'section'           => 'callout_sec',
    'type'              => 'url',
    'priority'          => 10,
    'transport'         => 'postMessage',
    'default'           => $awada_theme_options['callout_btn_link'],
    'sanitize_callback' => 'esc_url',
	'partial_refresh' => array(
        'callout_btn_link' => array(
            'selector'            => '#callout_link',
			'container_inclusive' => true,
            'render_callback'     => 'awada_partial_refresh_callout_btn'
        ),
    )
));

/* footer options */
Kirki::add_section('footer_sec', array(
    'title'      => __('Footer & Copyright Options', 'awada'),
    'panel'      => 'awada_option_panel',
    'priority'   => 160,
    'capability' => 'edit_theme_options',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'copyright_text_enabled',
    'label'             => __('Enable Copyright Text', 'awada'),
    'section'           => 'footer_sec',
    'type'              => 'switch',
    'priority'          => 10,
    'default'           => 1,
	'transport'         => 'postMessage',
    'sanitize_callback' => 'awada_sanitize_checkbox',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'footer_menu_enabled',
    'label'             => __('Enable Footer Menu (Secondary Menu)', 'awada'),
    'section'           => 'footer_sec',
    'type'              => 'switch',
    'priority'          => 10,
    'default'           => 1,
	'transport'         => 'postMessage',
    'sanitize_callback' => 'awada_sanitize_checkbox',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'show_footer_widget',
    'label'             => __('Enable Footer Widget Section', 'awada'),
    'section'           => 'footer_sec',
    'type'              => 'switch',
    'priority'          => 10,
    'default'           => 1,
	'transport'         => 'postMessage',
    'sanitize_callback' => 'awada_sanitize_checkbox',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'footer_copyright',
    'label'             => __('Copyright Text', 'awada'),
    'section'           => 'footer_sec',
    'type'              => 'text',
    'priority'          => 10,
	'transport'         => 'postMessage',
    'default'           => $awada_theme_options['footer_copyright'],
    'sanitize_callback' => 'awada_sanitize_text',
	'partial_refresh' =>array(
		'footer_copyright' => array(
			'selector'        => '.footer_copy_text',
			'container_inclusive' => true,
			'render_callback' => 'awada_render_footer_copyright',
		)
	)
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'developed_by_text',
    'label'             => __('Developed by Text', 'awada'),
    'section'           => 'footer_sec',
    'type'              => 'text',
    'priority'          => 10,
	'transport'         => 'postMessage',
    'default'           => $awada_theme_options['developed_by_text'],
    'sanitize_callback' => 'awada_sanitize_text',
	'partial_refresh' =>array(
		'developed_by_text' => array(
			'selector'        => '.footer_copy_text',
			'container_inclusive' => true,
			'render_callback' => 'awada_render_footer_copyright',
		)
	)
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'developed_by_link_text',
    'label'             => __('Link Text', 'awada'),
    'section'           => 'footer_sec',
    'type'              => 'text',
    'priority'          => 10,
	'transport'         => 'postMessage',
    'default'           => $awada_theme_options['developed_by_link_text'],
    'sanitize_callback' => 'awada_sanitize_text',
	'partial_refresh' =>array(
		'developed_by_link_text' => array(
			'selector'        => '.footer_copy_text',
			'container_inclusive' => true,
			'render_callback' => 'awada_render_footer_copyright',
		)
	)
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'developed_by_link',
    'label'             => __('Developed by Link', 'awada'),
    'section'           => 'footer_sec',
    'type'              => 'url',
    'priority'          => 10,
	'transport'         => 'postMessage',
    'default'           => $awada_theme_options['developed_by_link'],
    'sanitize_callback' => 'esc_url',
	'partial_refresh' =>array(
		'developed_by_link' => array(
			'selector'        => '.footer_copy_text',
			'container_inclusive' => true,
			'render_callback' => 'awada_render_footer_copyright',
		)
	)
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'footer_background_color',
    'label'             => __('Footer Background Color', 'awada'),
    'description'       => __('Change Footer Background Color', 'awada'),
    'section'           => 'footer_sec',
    'type'              => 'color',
    'priority'          => 10,
    'default'           => '#121214',
    'sanitize_callback' => 'awada_sanitize_color',
    'output'            => array(
        array(
            'element'  => '#awada_footer_area',
            'property' => 'background',
        ),
    ),
    'transport'         => 'auto',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'footer_text_color',
    'label'             => __('Footer Text Color', 'awada'),
    'description'       => __('Change Footer Text Color', 'awada'),
    'section'           => 'footer_sec',
    'type'              => 'color',
    'priority'          => 10,
    'default'           => '',
    'sanitize_callback' => 'awada_sanitize_color',
    'output'            => array(
        array(
            'element'  => '#awada_footer_area li a, #awada_footer_area a',
            'property' => 'color',
        ),
    ),
    'transport'         => 'auto',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'copyright_section_bg_color',
    'label'             => __('Copyright Section Background Color', 'awada'),
    'description'       => __('Change Copyright Section Background Color', 'awada'),
    'section'           => 'footer_sec',
    'type'              => 'color',
    'priority'          => 10,
    'default'           => '',
    'sanitize_callback' => 'awada_sanitize_color',
    'output'            => array(
        array(
            'element'  => '#copyrights',
            'property' => 'background',
        ),
    ),
    'transport'         => 'auto',
));
Kirki::add_field('awada_theme', array(
    'settings'          => 'copyright_section_text_color',
    'label'             => __('Copyright Section Text Color', 'awada'),
    'description'       => __('Change Copyright Section Text Color', 'awada'),
    'section'           => 'footer_sec',
    'type'              => 'color',
    'priority'          => 10,
    'default'           => '#fff',
    'sanitize_callback' => 'awada_sanitize_color',
    'output'            => array(
        array(
            'element'  => '#copyrights, .footer-area-menu li a',
            'property' => 'color',
        ),
    ),
    'transport'         => 'auto',
));

/* Home Page Customizer */
Kirki::add_section('home_customize_section', array(
    'title'      => __('Home Page Reorder Sections', 'awada'),
    'panel'      => 'awada_option_panel',
    'priority'   => 160,
    'capability' => 'edit_theme_options',
));
Kirki::add_field( 'awada_theme', array(
    'type'        => 'sortable',
    'settings'    => 'home_sections',
    'label'       => __( 'Here You can reorder your homepage section', 'awada' ),
    'section'     => 'home_customize_section',
    'default'     => array(
        'service',
        'portfolio',
        'blog',
        'callout'
    ),
    'choices'     => array(
        'service' => esc_attr__( 'Service Section', 'awada' ),
        'portfolio' => esc_attr__( 'Portfolio Section', 'awada' ),
        'blog' => esc_attr__( 'Blog Section', 'awada' ),
        'callout' => esc_attr__( 'Callout Section', 'awada' ),
    ),
    'priority'    => 10,
) );
function awada_sanitize_text($input)
{
    return wp_kses_post(force_balance_tags($input));
}

function awada_sanitize_checkbox($checked)
{
    return ((isset($checked) && (true == $checked || 'on' == $checked)) ? true : false);
}

/**
 * Sanitize number options
 */
function awada_sanitize_number($value)
{
    if (is_array($value)) {
        foreach ($value as $key => $val) {
            $v[$key] = is_numeric($val) ? $val : intval($val);
        }
        return $v;
    } else {
        return (is_numeric($value)) ? $value : intval($value);
    }
}
function awada_sanitize_selected($value)
{
    if (isset($value[0]) && $value[0] == '') {
        return $value = '';
    } else {
        return wp_kses_post($value);
    }
}
function awada_sanitize_color($color)
{

    if ($color == "transparent") {
        return $color;
    }

    $named = json_decode('{"transparent":"transparent", "aliceblue":"#f0f8ff","antiquewhite":"#faebd7","aqua":"#00ffff","aquamarine":"#7fffd4","azure":"#f0ffff", "beige":"#f5f5dc","bisque":"#ffe4c4","black":"#000000","blanchedalmond":"#ffebcd","blue":"#0000ff","blueviolet":"#8a2be2","brown":"#a52a2a","burlywood":"#deb887", "cadetblue":"#5f9ea0","chartreuse":"#7fff00","chocolate":"#d2691e","coral":"#ff7f50","cornflowerblue":"#6495ed","cornsilk":"#fff8dc","crimson":"#dc143c","cyan":"#00ffff", "darkblue":"#00008b","darkcyan":"#008b8b","darkgoldenrod":"#b8860b","darkgray":"#a9a9a9","darkgreen":"#006400","darkkhaki":"#bdb76b","darkmagenta":"#8b008b","darkolivegreen":"#556b2f", "darkorange":"#ff8c00","darkorchid":"#9932cc","darkred":"#8b0000","darksalmon":"#e9967a","darkseagreen":"#8fbc8f","darkslateblue":"#483d8b","darkslategray":"#2f4f4f","darkturquoise":"#00ced1", "darkviolet":"#9400d3","deeppink":"#ff1493","deepskyblue":"#00bfff","dimgray":"#696969","dodgerblue":"#1e90ff", "firebrick":"#b22222","floralwhite":"#fffaf0","forestgreen":"#228b22","fuchsia":"#ff00ff", "gainsboro":"#dcdcdc","ghostwhite":"#f8f8ff","gold":"#ffd700","goldenrod":"#daa520","gray":"#808080","green":"#008000","greenyellow":"#adff2f", "honeydew":"#f0fff0","hotpink":"#ff69b4", "indianred ":"#cd5c5c","indigo ":"#4b0082","ivory":"#fffff0","khaki":"#f0e68c", "lavender":"#e6e6fa","lavenderblush":"#fff0f5","lawngreen":"#7cfc00","lemonchiffon":"#fffacd","lightblue":"#add8e6","lightcoral":"#f08080","lightcyan":"#e0ffff","lightgoldenrodyellow":"#fafad2", "lightgrey":"#d3d3d3","lightgreen":"#90ee90","lightpink":"#ffb6c1","lightsalmon":"#ffa07a","lightseagreen":"#20b2aa","lightskyblue":"#87cefa","lightslategray":"#778899","lightsteelblue":"#b0c4de", "lightyellow":"#ffffe0","lime":"#00ff00","limegreen":"#32cd32","linen":"#faf0e6", "magenta":"#ff00ff","maroon":"#800000","mediumaquamarine":"#66cdaa","mediumblue":"#0000cd","mediumorchid":"#ba55d3","mediumpurple":"#9370d8","mediumseagreen":"#3cb371","mediumslateblue":"#7b68ee", "mediumspringgreen":"#00fa9a","mediumturquoise":"#48d1cc","mediumvioletred":"#c71585","midnightblue":"#191970","mintcream":"#f5fffa","mistyrose":"#ffe4e1","moccasin":"#ffe4b5", "navajowhite":"#ffdead","navy":"#000080", "oldlace":"#fdf5e6","olive":"#808000","olivedrab":"#6b8e23","orange":"#ffa500","orangered":"#ff4500","orchid":"#da70d6", "palegoldenrod":"#eee8aa","palegreen":"#98fb98","paleturquoise":"#afeeee","palevioletred":"#d87093","papayawhip":"#ffefd5","peachpuff":"#ffdab9","peru":"#cd853f","pink":"#ffc0cb","plum":"#dda0dd","powderblue":"#b0e0e6","purple":"#800080", "red":"#ff0000","rosybrown":"#bc8f8f","royalblue":"#4169e1", "saddlebrown":"#8b4513","salmon":"#fa8072","sandybrown":"#f4a460","seagreen":"#2e8b57","seashell":"#fff5ee","sienna":"#a0522d","silver":"#c0c0c0","skyblue":"#87ceeb","slateblue":"#6a5acd","slategray":"#708090","snow":"#fffafa","springgreen":"#00ff7f","steelblue":"#4682b4", "tan":"#d2b48c","teal":"#008080","thistle":"#d8bfd8","tomato":"#ff6347","turquoise":"#40e0d0", "violet":"#ee82ee", "wheat":"#f5deb3","white":"#ffffff","whitesmoke":"#f5f5f5", "yellow":"#ffff00","yellowgreen":"#9acd32"}', true);

    if (isset($named[strtolower($color)])) {
        /* A color name was entered instead of a Hex Value, convert and send back */
        return $named[strtolower($color)];
    }

    $color = str_replace('#', '', $color);
    if (strlen($color) == 3) {
        $color = $color . $color;
    }
    if (preg_match('/^[a-f0-9]{6}$/i', $color)) {
        return '#' . $color;
    }
    //$this->error = $this->field;
    return false;
}

function awada_sanitize_textarea($value)
{
    return wp_kses_post(force_balance_tags($value));
}
function awada_customize_register_active( $wp_customize ) {
	$awada_theme_options = awada_theme_options();
	if ($awada_theme_options['site_layout'] != 'boxed') {
		$wp_customize->remove_section('background_image');
	}
	$wp_customize->remove_control('header_textcolor');
	wp_enqueue_style('customizercustom_css',get_template_directory_uri().'/css/customizer.css');
    
	$wp_customize->add_section( 'awada_pro' , array(
		'title'      	=> __( 'Upgrade to Awada Premium', 'awada' ),
		'priority'   	=> 999,
		'panel'=>'awada_option_panel',
	) );

	$wp_customize->add_setting( 'awada_pro', array(
		'default'    		=> null,
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Awada_Pro_Control( $wp_customize, 'awada_pro', array(
		'label'    => __( 'Awada Premium', 'awada' ),
		'section'  => 'awada_pro',
		'settings' => 'awada_pro',
		'priority' => 1,
	) ) );

    class Awada_Customize_Heading extends WP_Customize_Control
    {
        public $type = 'heading';

        public function render_content()
        {
            if (!empty($this->label)): ?>
                <h3 class="awada-accordion-section-title"><?php echo esc_html($this->label); ?></h3>
            <?php endif;

            if ($this->description) {?>
                <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php }
        }
    }
    // Register our custom control with Kirki
    add_filter('kirki/control_types', function ($controls) {
        $controls['heading'] = 'Awada_Customize_Heading';
        return $controls;
    });
}
add_action( 'customize_register', 'awada_customize_register_active' );

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Awada_Pro_Control' ) ) :
class Awada_Pro_Control extends WP_Customize_Control {

	/**
	* Render the content on the theme customizer page
	*/
	public function render_content() {
		?>
		<label style="overflow: hidden; zoom: 1;">
			<div class="col-md-2 col-sm-6 upsell-btn">					
					<a style="margin-bottom:20px;margin-left:20px;" href="http://www.webhuntinfotech.com/webhunt_theme/awada-premium/" target="blank" class="btn btn-success btn"><?php _e('Upgrade to Awada Premium','awada'); ?> </a>
			</div>
			<div class="col-md-4 col-sm-6">
				<img class="awada_img_responsive " src="<?php echo get_template_directory_uri() .'/images/Awada_Pro.png'?>">
			</div>			
			<div class="col-md-3 col-sm-6">
				<h3 style="margin-top:10px;margin-left: 20px;text-decoration:underline;color:#333;"><?php echo _e( 'awada Premium - Features','awada'); ?></h3>
					<ul style="padding-top:10px">
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Responsive Design','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Beautiful & Amazing Shortcodes','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('More than 25 Page Templates','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('2 Types of sliders','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('4 Types Service Sections','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Portfolio Sections','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Testimonial Sections','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('2 Types Our Features Sections','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Client Sections','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Team Sections','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Magical Fun Facts Style','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Pricing Tables','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('3 Types Footer Callouts','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('8 Different Types of Blog Templates','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('8 Types of Portfolio Templates','awada'); ?></li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Stylish Custom Widgets','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Redux Options Panel','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Unlimited Colors Scheme','awada'); ?></li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Patterns Background','awada'); ?>   </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('WPML Compatible','awada'); ?>   </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Woo-commerce Compatible','awada'); ?>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Portfolio layout with Isotope effect','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Coming Soon/Maintenance Mode Option','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Translation Ready','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Free Updates','awada'); ?> </li>
						<li class="upsell-awada"> <div class="dashicons dashicons-yes"></div> <?php _e('Quick Support','awada'); ?> </li>
					</ul>
			</div>
			<div class="col-md-2 col-sm-6 upsell-btn upsell-btn-bottom">					
					<a style="margin-bottom:20px;margin-left:20px;" href="http://www.webhuntinfotech.com/webhunt_theme/awada-premium/" target="blank" class="btn btn-success btn"><?php _e('Upgrade to Awada Premium','awada'); ?> </a>
			</div>
			
			<p>
				<?php
					printf( __( 'If you Like our Products , Please Rate us 5 star on %1$sWordPress.org%2$s.  We\'d really appreciate it! </br></br>  Thank You', 'awada' ), '<a target="" href="https://wordpress.org/support/view/theme-reviews/awada?filter=5">', '</a>' );
				?>
			</p>
		</label>
		<?php
	}
}
endif;
?>