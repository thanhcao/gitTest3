<?php get_header(); ?>
<section class="post-wrapper-top section-shadow clearfix">
	<div class="container">
		<div class="col-lg-12">
			<h2><?php _e('Page Not Found', 'awada'); ?></h2>
			<ul class="breadcrumb pull-right">
				<li><a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Home', 'awada'); ?></a></li><i class="fa fa-chevron-circle-right breadcrumbs_space"></i>
				<li><?php _e('Page Not Found', 'awada'); ?></li>
			</ul>
		</div>
	</div>
</section>
<section class="white-wrapper padding-top">
	<div class="container">
		<div class="not_found text-center">
		<h1><?php _e('404!', 'awada'); ?></h1>
		<p class="lead"><?php _e('Look like something went wrong! The page you were looking for is not here. <br> Go <a href="<?php echo home_url(); ?>"> Home </a> or try a search.', 'awada'); ?></p>
			<div class="widget padding-top">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>