<?php get_header(); ?>
<section class="post-wrapper-top section-shadow clearfix">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="col-lg-7 awada_pag_title">
					<h2><?php the_archive_title(); ?></h2>
				</div>
				<div class="col-lg-5 awada_pag_breadcrumb">
					<?php awada_breadcrumbs(); ?>
				</div>
			</div>
		</div>
	</div>
</section><!-- end post-wrapper-top -->
<section class="blog-wrapper">
	<div class="container">
		<div id="content" class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
			<div class="row">
			   <div class="blog-masonry">
			   <?php
				$i = 1;
				while (have_posts()):
                        the_post();
					if($i%2==0){
						$pos = 'last';
					} else {
						$pos = 'first';
					} ?>
					<div class="col-lg-6 <?php echo $pos; ?>">
						<div class="blog-carousel">
							<div class="content_entry">
								<?php $icon = "";
								$imageSize = 'awada_blog_grid_thumb';
								$img_class = array('class' => 'img-responsive');
								if (has_post_thumbnail()) {
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
									<span><i class="fa fa-user"></i><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php esc_attr(the_author()); ?></a></span>
								</div><!-- end blog-meta -->
							</div><!-- end portfolio_list -->
							<div class="blog-desc">
								<?php the_excerpt(); ?>
							</div><!-- end blog-desc -->
						</div><!-- end blog-carousel -->
						<div class="awada_blog_shadow"></div>
					</div><!-- end col-lg-4 -->
					<?php $i++; endwhile;
					wp_link_pages(); ?>
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