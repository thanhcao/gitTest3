<?php $awada_theme_options = awada_theme_options(); ?>
<section id="home_blog" class="grey-wrapper section-shadow">
	<div class="container">
		<div class="main_title">
			<?php if ($awada_theme_options['home_blog_title'] != ""){ ?>
			<h2 id="blog_heading"><?php echo wp_kses_post($awada_theme_options['home_blog_title']); ?></h2>
			<hr>
			<?php } if ($awada_theme_options['home_blog_description'] != ""){ ?>
			<p id="blog_description" class="lead"><?php echo wp_kses_post($awada_theme_options['home_blog_description']); ?></p>
			<?php } ?>
		</div><!-- end general title -->
		<div id="home_blog" class="blog-masonry ajax_posts">
			<?php
			$post_id = ($awada_theme_options['portfolio_post'] == ''?'':$awada_theme_options['portfolio_post']);
			$portfolio_id = intval($post_id);
			$args = array('post_type' => 'post', 'posts_per_page' => $awada_theme_options['blog_post_count'], 'post__not_in' => array($portfolio_id));
			if(isset($awada_theme_options['home_post_cat']) && !empty($awada_theme_options['home_post_cat'])){
				$args['category__in']=$awada_theme_options['home_post_cat'];
			}
            query_posts($args);
			if (query_posts($args)) {
			while (have_posts()):the_post();?>
			<div class="col-lg-4 grid-item">
				<div id="post-<?php the_ID(); ?>" <?php post_class(' blog-carousel'); ?>>
					<div class="content_entry"><?php
						$img_class = array('class' => 'img-responsive'); ?>
						<?php if (has_post_thumbnail()) {
								$url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
								the_post_thumbnail('awada_blog_home_thumb', $img_class); ?>
							<div class="magnifier">
								<div class="buttons">
									<a class="st" rel="bookmark" href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
									<a class="sf" data-gal="prettyPhoto[product-gallery]" href="<?php echo esc_url($url); ?>"><i class="fa fa-expand"></i></a>
								</div><!-- end buttons -->
							</div><!-- end magnifier -->
							<?php } ?>
					</div><!-- end content_entry -->
					<div class="blog-header">
						<h3><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="blog-meta">
							<span><i class="fa fa-calendar"></i><?php echo get_the_date(get_option('date_format'), get_the_ID()); ?></span>
							<span><i class="fa fa-comment"></i><?php comments_popup_link(__('No Comments', 'awada'), __('1 Comment', 'awada'), __('% Comments', 'awada')); ?> <?php edit_post_link(__('Edit', 'awada'), ' &#124; ', ''); ?></span>
							<span><i class="fa fa-user"></i> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php esc_attr(the_author()); ?></a></span>
						</div><!-- end blog-meta -->
					</div><!-- end blog-header -->
					<div class="blog-desc">
						<?php the_excerpt(); ?>
					</div><!-- end blog-desc -->
				</div>
					<div class="awada_blog_shadow"></div>
			</div><!-- end blog-carousel -->
			<?php endwhile;
			} ?>
		</div><!-- end blog-masonry -->
	</div><!-- end container -->
	<?php if($awada_theme_options['show_load_more_btn']){?>
    <div class="buttons padding-top text-center post-btn2">
        <button id="more_posts" type="submit" class="btn btn-primary btn-lg append-button1 btn-shadow" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?php echo esc_attr($awada_theme_options['blog_more_loading']);?>"><?php echo esc_attr($awada_theme_options['blog_load_more_text']); ?></button>
    </div><?php 
} ?>
</section><!-- end white-wrapper -->