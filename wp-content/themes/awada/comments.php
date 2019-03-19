<div id="comments" class="padding-top"><?php 
if (have_comments()):
	if (post_password_required(get_the_ID())) { ?>
		<p class="nocomments"><?php _e('Please enter password to view or post a comments', 'awada'); ?></p>
		</div><?php
		return;
	}
	if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h3 class="screen-reader-text"><?php _e('Comment navigation', 'awada'); ?></h3>

			<div class="nav-previous">
				<?php previous_comments_link(__('&larr; Older Comments', 'awada')); ?>
			</div>
			<div class="nav-next">
				<?php next_comments_link(__('Newer Comments &rarr;', 'awada')); ?>
			</div>
		</nav><!-- #comment-nav-above --><?php
	endif; // Check for comment navigation.
	?>
	<h3><?php comments_popup_link(__('No Comments &#187;', 'awada'), __('Comment (1)', 'awada'), __('Comments (%)', 'awada')); ?></h3>
	<div class="comments_wrapper">
		<ul class="comment-list">
			<?php wp_list_comments('callback=awada_comments&style=li'); ?>
		</ul><!-- End .comment-list -->      
	</div><!-- comments wrapper -->
	<?php endif; ?>
	<div class="clearfix"></div>
	<?php if (comments_open()) {		?>	
	<div class="comments_form"><?php
			$fields = array(
				'author' => '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><input type="text" aria-required="true" class="form-control" value="" placeholder="' . esc_attr('Name (required)', 'awada') . '" name="author" id="author"></div>',
				'email' => '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><input type="text" aria-required="true" class="form-control" value="" placeholder="' . esc_attr('Email (required)', 'awada') . '" name="email" id="email"></div>',
				'website' => '<div class="clearfix"></div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><input type="text" class="form-control" value="" placeholder="' . esc_attr('Website', 'awada') . '" name="url" id="url"></div>',
			);
			function awada_comment_defaullt_fields($fields)
			{
				return $fields;
			}

			add_filter('awada_comment_form_default_fields', 'awada_comment_defaullt_fields');
			$comments_args = array(
				'fields' => apply_filters('awada_comment_form_default_fields', $fields),
				'label_submit' => __('Submit Message', 'awada'),
				'title_reply_to' =>  __('Leave a Reply to %s', 'awada'),
				'title_reply' => __("Leave a reply", 'awada'),
				 'comment_notes_after' => '', 
				'comment_field' => '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><textarea aria-required="true" rows="6" class="form-control" name="comment" placeholder="' . esc_attr('Comment...', 'awada') . '" id="comment"></textarea></div>',
				'class_submit' => 'btn btn-primary',
				'id_form'           => 'comments_form',
				'class_form'      => 'row',
			);
			comment_form($comments_args);
			?>
	</div><!-- end comments_Form -->
	<?php }	?>	
</div><!-- end comments -->