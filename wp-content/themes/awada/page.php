<?php $awada_theme_options = awada_theme_options();
get_header();
get_template_part('breadcrumbs');
the_post(); ?>
<section class="blog-wrapper">
	<div class="container">
		<?php $page_layout = $awada_theme_options['page_layout'];
		$imageSize = $page_layout == "fullwidth" ? 'awada_blog_full_thumb' : 'awada_blog_sidebar_thumb';
		if ($page_layout == "leftsidebar") {
			get_sidebar();
			$float = 9;
		} elseif ((class_exists('WooCommerce') && (is_cart() || is_checkout())) || ($page_layout == "fullwidth")) {
			$page_layout = "fullwidth";
			$float = 12;
		} elseif ($page_layout == "rightsidebar") {
			$float = 9;
		} else {
			$page_layout = "rightsidebar";
			$float = 9;
		}
		?>
		<div id="content" class="col-lg-<?php echo $float; ?> col-md-<?php echo $float; ?> col-sm-12 col-xs-12">
			<div class="row">
			   <div class="blog-masonry page_desc">
					<div class="col-lg-12">
						<?php get_template_part('blog', 'content'); ?>
					</div><!-- end col-lg-4 -->
				</div><!-- end blog-masonry -->
				<div class="clearfix"></div>
				<?php comments_template('', true); ?>
				<hr>
			</div><!-- end row --> 
		</div><!-- end content -->
		<?php if ($page_layout == "rightsidebar") {
			get_sidebar();
		} ?>
	</div><!-- end container -->
</section><!--end white-wrapper -->
<?php get_footer(); ?>