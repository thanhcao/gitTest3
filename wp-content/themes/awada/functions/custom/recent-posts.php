<?php
add_action('widgets_init', 'awada_recent_posts_widgets');
function awada_recent_posts_widgets()
{
    register_widget('awada_footer_recent_posts');
	register_widget('awadaArchieveWidget');
}

/**
 * Adds widget for recent Post in footer.
 */
class awada_footer_recent_posts extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'awada_footer_recent_posts', //ID
            __('Awada Recent Posts', 'awada'), // Name
            array('description' => __('Display Recent posts on your sites', 'awada'),) // Args
        );
    }

    public function widget($args, $instance)
    {
        $title = !empty($instance['title']) ? apply_filters('widget_title', $instance['title']) : __('Receent Posts', 'awada');
        $number_of_posts = !empty($instance['number_of_posts']) ? apply_filters('widget_title', $instance['number_of_posts']) : 5;
        $rmp_url = !empty($instance['rmp_url']) ? apply_filters('rmp_url', $instance['rmp_url']) : '#';

        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title']; ?>
        <?php $loop = new WP_Query(array('post_type' => 'post', 'showposts' => $number_of_posts, 'ignore_sticky_posts' => 1));
        if ($loop->have_posts()) : ?>
            <ul class="recent_posts_widget">
				<?php while ($loop->have_posts()) : $loop->the_post(); ?>
				<li>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('awada_recent_widget_thumb'); the_title(); ?></a>
					<a class="readmore" href="<?php the_permalink(); ?>"><?php echo get_the_date(get_option('date_format'), get_the_ID()); ?></a>
					<?php esc_attr(the_tags('Tags: ', ', ')); ?>
				</li>
				<?php endwhile; ?>
				<a href="<?php echo esc_url($rmp_url); ?>" class="btn btn-primary btn-lg btn-shadow" title=""><?php _e('Read More Posts', 'awada'); ?></a>
			</ul>
        <?php endif; ?>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        if (isset($instance['title']) && isset($instance['number_of_posts'])) {
            $title = $instance['title'];
            $number_of_posts = $instance['number_of_posts'];
        } else {
            $title = __('Recent Post', 'awada');
            $number_of_posts = 4;
        }
        $rmp_url = '';
        if (isset($instance['rmp_url']))
            $rmp_url = $instance['rmp_url'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'awada'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>"><?php _e('Number of pages to show:', 'awada'); ?></label>
            <input size="3" maxlength="2" id="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('number_of_posts')); ?>" type="text" value="<?php echo esc_attr($number_of_posts); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('rmp_url'); ?>"><?php _e('Read More Posts URL:', 'awada'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('rmp_url')); ?>" name="<?php echo esc_attr($this->get_field_name('rmp_url')); ?>" type="text" value="<?php echo $rmp_url != "" ? esc_url($rmp_url) : ''; ?>"/>
        </p>
    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['rmp_url'] = (!empty($new_instance['rmp_url'])) ? strip_tags($new_instance['rmp_url']) : '';
        $instance['number_of_posts'] = (!empty($new_instance['number_of_posts'])) ? strip_tags($new_instance['number_of_posts']) : '';
        return $instance;
    }

}

class awadaArchieveWidget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'awada_archieves',
            __('Awada Archieves', 'awada'),
            array('description' => __('Awada Archieves Widget', 'awada'))
        );
    }

    function widget($args, $instance)
    {
        extract($args);
        $title = !empty($instance['title']) ? apply_filters('widget_title', $instance['title']) : __('Archives', 'awada');
		
		echo $before_widget;
        if ($title != "") {
            echo $before_title . $title . $after_title;
        } else {
            echo $before_title . __('Archives', 'awada') . $after_title;
        } ?>
        <ul class="cat_list_widget"><?php
            $html = wp_get_archives(array(
                'echo' => false,
                'before' => '',
            ));
            echo $html; ?>
        </ul>
        <?php echo $after_widget;
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    function form($instance)
    {
        if (isset($instance['title'])) {
            $title = esc_attr($instance['title']);
        } else {
            $title = __('Archives', 'awada');
        }
        ?>
        <p>
            <label for='<?php echo $this->get_field_id('title'); ?>'><?php _e('Title:', 'awada'); ?></label>
            <input type="text" id='<?php echo $this->get_field_id("title"); ?>'
                   name='<?php echo $this->get_field_name("title"); ?>' value="<?php echo $title; ?>" class="widefat">
        </p><?php
    }
}
?>