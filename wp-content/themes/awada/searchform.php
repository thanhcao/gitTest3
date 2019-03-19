<form action="<?php echo esc_url(home_url('/')); ?>" autocomplete="off" role="search" method="get" class="newsletter_form search_form">
	<input type="text" class="form-control" placeholder="<?php esc_attr_e('Start Searching..', 'awada'); ?>" id="s" value="<?php echo get_search_query(); ?>" name="s">     
</form><!-- end search form -->