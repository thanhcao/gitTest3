<?php
/* General Options */
function awada_theme_options()
{
	$banner_img = get_template_directory_uri() . '/images/banner.jpg';
    $awada_theme_options = array(
        '_frontpage' => 1,
        'site_layout' => '',
		'color_scheme'=>'default.css',
        'logo_layout' => 'left',
		'blog_layout' => 'rightsidebar',
        'post_layout' => 'rightsidebar',
		'page_layout' => 'rightsidebar',
		// Topbar
        'show_topbar' => 1,
        'headersticky' => 0,
        'custom_css' => '',
		//Slider Settings:
        'home_slider_enabled' => 1,
		'slider_style' => 2,

        'slider_img_1'=>get_template_directory_uri().'/images/slider/s1.jpg',
        'slider_img_2'=>get_template_directory_uri().'/images/slider/s2.jpg',
        'slider_img_3'=>get_template_directory_uri().'/images/slider/s3.jpg',

        'slider_title_1'=>__('Lorem ipsum dolor','awada'),
        'slider_subtitle_1'=>__('Nulla quam sem vel id','awada'),
        'slider_readmore_1'=>__('Read More','awada'),

        'slider_title_2'=>__('Lorem ipsum dolor','awada'),
        'slider_subtitle_2'=>__('Nulla quam sem vel id','awada'),
        'slider_readmore_2'=>__('Read More','awada'),

        'slider_title_3'=>__('Lorem ipsum dolor','awada'),
        'slider_subtitle_3'=>__('Nulla quam sem vel id','awada'),
        'slider_readmore_3'=>__('Read More','awada'),

        'home_slider_shortcode'=>'',
		// Service
        'home_service_title' => __('Our <span>Services</span>', 'awada'),
		'home_service_description' => __('We provide best solution for your business', 'awada'),
        'home_service_column' => 4,
        'service_title_1' => __("Responsive", 'awada'),
        'service_icon_1' => "mobile",
        'service_text_1' => __("Lorem ipsum dolor sit amet, consectetur adipisicing elit ipsum lorem sit amet.", 'awada'),
		'service_link_1' => "#",

        'service_title_2' => __("Retina Ready", 'awada'),
        'service_icon_2' => "eye",
        'service_text_2' => __("Lorem ipsum dolor sit amet, consectetur adipisicing elit ipsum lorem sit amet.", 'awada'),
        'service_link_2' => "#",

        'service_title_3' => __("Multi Layout", 'awada'),
        'service_icon_3' => "code",
        'service_text_3' => __("Lorem ipsum dolor sit amet, consectetur adipisicing elit ipsum lorem sit amet", 'awada'),
        'service_link_3' => "#",

        'service_title_4' => __('Easy To Customize', 'awada'),
        'service_text_4' => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit ipsum lorem sit amet', 'awada'),
        'service_icon_4' => "wrench",
        'service_link_4' => "#",
		//Portfolio Settings:
        'home_portfolio_title' => __('Our <span>Portfolio</span>', 'awada'),
        'home_portfolio_subtitle' => __('Our Latest <strong>Work</strong>', 'awada'),
        'portfolio_post' => '',
        /* blog option */
		'home_blog_title' => __('Our <span>Recent Posts</span>', 'awada'),
		'home_blog_description' => __('Etiam sit amet orci eget eros faucibus tincidunt.', 'awada'),
        'blog_post_count' => 3,
		'home_post_cat' => array(),
        'show_load_more_btn'=>1,
        'home_load_post_num'=>3,
        'blog_no_more_post'       => __('No older posts found', 'awada'),
        'blog_more_loading'       => __('Loading', 'awada'),
        'blog_load_more_text'     => __('Load More', 'awada'),
		/* footer callout */
		'callout_bg_image' => $banner_img,
		'callout_external_bg_video'=>esc_url('https://www.youtube.com/watch?v=jnLSYfObARA'),
        'home_callout_title' => __('Best Wordpress Resposnive Theme Ever!', 'awada'),
        'home_callout_description' => __('There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour of this randomised words which don\'t look even slightly believable If you are going to use a passage of Lorem Ipsum.', 'awada'),
        'callout_btn_text' => __('Purchase Now', 'awada'),
        'callout_btn_link' => 'http://www.example.com',
        /* Social media icons */
        'contact_info_header' => 1,
        'social_media_header' => 1,
        'contact_phone' => '+9999-9999999',
        'contact_email' => 'example@gmail.com',
        'social_facebook_link' => '#',
        'social_twitter_link' => '#',
        'social_dribbble_link' => '#',
        'social_linkedin_link' => '#',
        'social_youtube_link' => '#',
        'social_google_plus_link' => '#',
        'social_skype_link' => '#',
		//Copyright Settings:
		'copyright_text_enabled' => 1,
		'footer_menu_enabled' => 1,
		'show_footer_widget' => 1,
        'footer_copyright' => __('Awada Theme', 'awada'),
        'developed_by_text' => __('Developed By', 'awada'),
        'developed_by_link_text' => __('Webhunt Infotech', 'awada'),
        'developed_by_link' => 'http://www.webhuntinfotech.com/',
        'footer_layout' => 4,
		'home_sections' => array('service', 'portfolio', 'blog', 'callout'),
    );
	//delete_option('awada_theme_options');
    return wp_parse_args(get_option('awada_theme_options', array()), $awada_theme_options);
}
?>