<?php if(has_post_thumbnail() || get_the_content() || get_the_excerpt()){ ?>
<div id="post-<?php the_ID(); ?>" <?php post_class('blog-carousel'); ?>>
	<div class="content_entry">
		<?php $icon = "";
		global $imageSize;
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
	
	<?php if (!(class_exists('WooCommerce') && (is_cart() || is_checkout()))) { ?>
	<div class="blog-header">
		<h3><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php if(!is_page()){ ?>
		<div class="blog-meta">
			<span><i class="fa fa-calendar"></i><a href="<?php echo the_permalink(); ?>"><?php echo get_the_date(get_option('date_format'), get_the_ID()); ?></span>
			<span><i class="fa fa-comment"></i><?php comments_popup_link(__('No Comments', 'awada'), __('1 Comment', 'awada'), __('% Comments', 'awada')); ?> <?php edit_post_link(__('Edit', 'awada'), ' &#124; ', ''); ?></span>
			<span><i class="fa fa-user"></i> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php esc_attr(the_author()); ?></a></span>
		</div><!-- end blog-meta -->
		<?php } ?>
	</div><!-- end blog-header -->
	<?php } ?>
	<div class="blog-desc">
		<?php if(is_page() || is_singular() || is_home()) { the_content(); } else { the_excerpt(); } ?>
	</div><!-- end blog-desc -->
</div><!-- end blog-carousel -->
<?php if(!is_page()){ ?>
<div class="awada_blog_shadow_main"></div>
<?php } } ?>