<?php
add_action('widgets_init', 'awada_footer_widget_contact');
function awada_footer_widget_contact()
{
    return register_widget('awada_footer_contact_widget');
}

class awada_footer_contact_widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'awada_footer_contact_widget', // Base ID
            __('Awada Footer Contact', 'awada'), // Name
            array('description' => __('Your contact details', 'awada'),) // Args
        );
    }

    public function widget($args, $instance)
    {
        $title = !empty($instance['title']) ? apply_filters('widget_title', $instance['title']) : 'Contact Us';
        $Contact_address = !empty($instance['Contact_address']) ? apply_filters('widget_title', $instance['Contact_address']) : '4031 Linda Lane
								Santa Monica, CA 90403';
        $Contact_phone_number = !empty($instance['Contact_phone_number']) ? apply_filters('widget_title', $instance['Contact_phone_number']) : '0664-3225569';
        $website_add = !empty($instance['website_add']) ? apply_filters('widget_title', $instance['website_add']) : 'www.example.org';
        $Contact_email_address = !empty($instance['Contact_email_address']) ? apply_filters('widget_title', $instance['Contact_email_address']) : 'youremail@gmail.com';

        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];

        ?>
        <address>
            <p><?php if ($Contact_address) { ?>
				<i class="fa fa-map-marker"></i> 
                <?php echo esc_attr($Contact_address);
                } else { ?> <i class="fa fa-map-marker"></i>
                <?php echo __('25, Lorem Lis Street', 'awada');
                } ?></p>
            <p><?php if ($Contact_phone_number) { ?><i class="fa fa-phone"></i> <a href="tel:<?php echo esc_attr($Contact_phone_number); ?>">
                <?php echo esc_attr($Contact_phone_number);
                } else { ?><i class="fa fa-phone"></i>
				<?php echo __('987-654-321', 'awada');
				} ?></a></p>
            <p><?php if ($Contact_email_address) { ?><i class="fa fa-envelope"></i> <a href="mailto:<?php if ($Contact_email_address) {
                    echo sanitize_email($Contact_email_address);
                } else {
                    echo __('mail@me.com', 'awada');
                } ?>">
                <?php echo sanitize_email($Contact_email_address);
                    } else { ?><i class="fa fa-envelope"></i>
                <?php echo __('myemail@gmail.com', 'awada');
				} ?></a></p>
            <p><?php if ($website_add) { ?> <i class="fa fa-globe"></i>
                <?php echo esc_attr($website_add);
                } else { ?> <i class="fa fa-globe"></i>
                <?php echo esc_attr('http://www.example.com');
                } ?></p>
        </address>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Contact Info', 'awada');
        }

        if (isset($instance['Contact_phone_number'])) {
            $Contact_phone_number = $instance['Contact_phone_number'];
        } else {
            $Contact_phone_number = __('0764-989879', 'awada');
        }

        if (isset($instance['Contact_email_address'])) {
            $Contact_email_address = $instance['Contact_email_address'];
        } else {
            $Contact_email_address = __('contact@me.com ', 'awada');
        }

        if (isset($instance['website_add'])) {
            $website_add = $instance['website_add'];
        } else {
            $website_add = __('http://www.example.com', 'awada');
        }

        if (isset($instance['Contact_address'])) {
            $Contact_address = $instance['Contact_address'];
        } else {
            $Contact_address = __('NewYork', 'awada');
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'awada'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p><label for="<?php echo esc_attr($this->get_field_id('Contact_phone_number')); ?>"><?php _e('Contact phone number:', 'awada'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('Contact_phone_number')); ?>" name="<?php echo esc_attr($this->get_field_name('Contact_phone_number')); ?>" type="text" value="<?php echo esc_attr($Contact_phone_number); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('Contact_email_address')); ?>"><?php _e('E-mail address:', 'awada'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('Contact_email_address')); ?>" name="<?php echo esc_attr($this->get_field_name('Contact_email_address')); ?>" type="text" value="<?php echo esc_attr($Contact_email_address); ?>"/>
        </p>
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('website_add')); ?>"><?php _e('Website :', 'awada'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('website_add')); ?>" name="<?php echo esc_attr($this->get_field_name('website_add')); ?>" type="text"
            value="<?php echo esc_attr($website_add); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('Contact_address')); ?>"><?php _e('Contact address:', 'awada'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('Contact_address')); ?>" name="<?php echo esc_attr($this->get_field_name('Contact_address')); ?>" type="text" value="<?php echo esc_attr($Contact_address); ?>"/>
        </p>

    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['Contact_address'] = (!empty($new_instance['Contact_address'])) ? strip_tags($new_instance['Contact_address']) : '';
        $instance['timings'] = (!empty($new_instance['timings'])) ? strip_tags($new_instance['timings']) : '';
        $instance['website_add'] = (!empty($new_instance['website_add'])) ? strip_tags($new_instance['website_add']) : '';
        $instance['Contact_phone_number'] = (!empty($new_instance['Contact_phone_number'])) ? strip_tags($new_instance['Contact_phone_number']) : '';
        $instance['Contact_email_address'] = (!empty($new_instance['Contact_email_address'])) ? strip_tags($new_instance['Contact_email_address']) : '';
        return $instance;
    }
}

?>