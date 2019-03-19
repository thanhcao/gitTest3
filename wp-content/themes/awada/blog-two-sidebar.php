<?php /* Template Name: Blog Two Sidebar */
get_header();
get_template_part('breadcrumbs');
?>
<section class="blog-wrapper">
	<div class="container">
		<?php get_sidebar('secondary'); ?>
		<div id="content" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="row">
			 <div class="blog-masonry">
					<div class="col-lg-12">
						<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$args = array('post_type' => 'post', 'paged' => $paged);
						$wp_query = new WP_Query($args);
						while ($wp_query->have_posts()):
							$wp_query->the_post(); ?>
							<div class="blog-carousel">
								<div class="content_entry">
								<?php $icon = "";
								$imageSize = 'awada_blog_two_sidebar_thumb';
								$img_class = array('class' => 'img-responsive'); ?>
								<?php if (has_post_thumbnail()) {
										$icon = "fa fa-picture-o";
										$url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
										the_post_thumbnail($imageSize, $img_class); ?>
									<div class="magnifier">
										<div class="buttons">
											<a class="st" rel="bookmark" href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
											<a class="sf" data-gal="prettyPhoto[product-gallery]" href="<?php echo esc_url($url); ?>"><i class="fa fa-expand"></i></a>
										</div><!-- end buttons -->
									</div><!-- end magnifier -->
									<div class="post-type">
										<i class="<?php echo $icon; ?>"></i>
									</div><!-- end pull-right -->
									<?php } ?>
							</div><!-- end content_entry -->
							<div class="blog-header">
								<h3><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="blog-meta">
									<span><i class="fa fa-calendar"></i><?php echo get_the_date(get_option('date_format'), get_the_ID()); ?></span>
									<span><i class="fa fa-comment"></i><?php comments_popup_link(__('No Comments', 'awada'), __('1 Comment', 'awada'), __('% Comments', 'awada')); ?> <?php edit_post_link(__('Edit', 'awada'), ' &#124; ', ''); ?></span>
									<span><i class="fa fa-eye"></i><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php esc_attr(the_author()); ?></a></span>
								</div><!-- end blog-meta -->
							</div><!-- end blog-header -->
							<div class="blog-desc">
								<?php the_excerpt(); ?>
							</div><!-- end blog-desc -->
						</div><!-- end blog-carousel -->
						<?php endwhile;
						wp_link_pages(); ?>
					</div><!-- end col-lg-4 -->
				</div><!-- end blog-masonry -->
				<div class="clearfix"></div>
				<hr>
				<?php awada_pagination(); ?>
			</div><!-- end row --> 
		</div><!-- end content -->
		<?php get_sidebar(); ?>
	</div><!-- end container -->
</section><!--end white-wrapper -->
<?php get_footer(); ?>