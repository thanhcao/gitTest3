<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="content-type" content="text/html; charset=<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<?php wp_head(); ?>
</head>
<?php $awada_theme_options = awada_theme_options();
$class = "";
if ($awada_theme_options['site_layout'] == 'boxed') {
    $class .= ' boxed ';
} 
?>
<body <?php body_class($class); ?>>
<?php if ($awada_theme_options['site_layout'] == 'boxed') { ?>
<div id="wrapper" class="container">
<?php } ?>
<?php if ($awada_theme_options['show_topbar']){ ?>
<div id="sitetopbar" class="clearfix">
	<div class="container">
		<?php if ($awada_theme_options['contact_info_header']) { ?>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="topbar-contact">
			<div class="topbar-contact">
				<?php if ($awada_theme_options['contact_phone']) { ?>
				<span class="topbar-contact-phone"><i class="fa fa-phone-square"></i> <?php echo esc_attr($awada_theme_options['contact_phone']); ?></span>
				<?php } if ($awada_theme_options['contact_email']) { ?>
				<span class="topbar-contact-email"><i class="fa fa-envelope"></i> <a href="mailto:<?php echo sanitize_email($awada_theme_options['contact_email']); ?>"><?php echo sanitize_email($awada_theme_options['contact_email']); ?></a></span>
				<?php } ?>
			</div><!-- end topbar-contact -->
		</div><!-- end columns -->
		<?php } if ($awada_theme_options['social_media_header'] && has_nav_menu('social')) { ?>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="topbar-social-links">
			<div class="topbar-social-links">
				<?php wp_nav_menu(array(
						'theme_location' => 'social',
						'menu_class' => 'nav navbar-nav top-social',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>' . awada_get_icon( array( 'icon' => 'chain' ) ),
						)); ?>
				
			</div><!-- end social icons -->
		</div><!-- end columns -->
		<?php } ?>
	</div><!-- end container -->
</div><!-- end topbar -->
<?php } ?>
<header id="awada-header" style="<?php if (get_header_image()) : ?> background: url('<?php header_image();?>'); <?php endif; ?>" class="navi_menu <?php if($awada_theme_options['headersticky']=='1'){ echo 'awada-header-fixed'; } ?>">
	<span id="header_shadow"></span>
	<div class="container">
		<nav class="navbar dropmenu navbar-default" <?php if(get_header_image()!=""){echo 'style="background:transparent";';};?>>
			<div class="navbar-header">
				<button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
					<?php if ( function_exists( 'the_custom_logo' )) {
						the_custom_logo();
					} ?>
				<div class="site-branding-text">
			<?php if ( is_front_page() ) : ?>
				<h1 class="site-title"><a id="alogo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title" id="logo_text_id"><a id="alogo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>

			<?php $description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; ?></p>
				<?php endif; ?>
		</div><!-- .site-branding-text -->					
			</div><!-- end navbar-header -->
			
			<div id="navbar-collapse-1" class="navbar-collapse collapse navbar-<?php echo is_rtl() ? 'right' :'left'; if ($awada_theme_options['logo_layout']=='right'){ echo 'style="float:right;"'; } ?>">
					<?php wp_nav_menu(array(
								'theme_location' => 'primary',
								'menu_class' => 'nav navbar-nav',
								'fallback_cb' => 'awada_fallback_page_menu',
								'walker' => new awada_nav_walker(),
                                )
                            ); ?>
							<!-- end navbar-nav -->
			</div><!-- #navbar-collapse-1 -->
		</nav><!-- end navbar dropmenu navbar-default -->
	</div><!-- end container -->
</header><!-- end awada header style -->