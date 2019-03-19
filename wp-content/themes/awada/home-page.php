<?php 
/* Template Name: Home */
get_header();
get_template_part('home','slider'); 
$awada_theme_options = awada_theme_options();
foreach($awada_theme_options['home_sections'] as $section){
	get_template_part('home',$section);
}
get_footer(); ?>
