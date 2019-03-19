<?php
/**
 * Add theme dashboard page
 */

/**
 * Get theme actions required
 *
 * @return array|mixed|void
 */
function awada_get_actions_required( ) {

    $actions = array();
    $front_page = get_option( 'page_on_front' );
    $actions['page_on_front'] = 'dismiss';
    $actions['page_template'] = 'dismiss';
    $actions['recommend_plugins'] = 'dismiss';
    if ( 'page' != get_option( 'show_on_front' ) ) {
        $front_page = 0;
    }
    if ( $front_page <= 0  ) {
        $actions['page_on_front'] = 'active';
        $actions['page_template'] = 'active';
    } else {
        if ( get_post_meta( $front_page, '_wp_page_template', true ) == 'home-page.php' ) {
            $actions['page_template'] = 'dismiss';
        } else {
            $actions['page_template'] = 'active';
        }
    }

    $recommend_plugins = get_theme_support( 'recommend-plugins' );
    if ( is_array( $recommend_plugins ) && isset( $recommend_plugins[0] ) ){
        $recommend_plugins = $recommend_plugins[0];
    } else {
        $recommend_plugins[] = array();
    }

    if ( ! empty( $recommend_plugins ) ) {

        foreach ( $recommend_plugins as $plugin_slug => $plugin_info ) {
            $plugin_info = wp_parse_args( $plugin_info, array(
                'name' => '',
                'active_filename' => '',
            ) );
            if ( $plugin_info['active_filename'] ) {
                $active_file_name = $plugin_info['active_filename'] ;
            } else {
                $active_file_name = $plugin_slug . '/' . $plugin_slug . '.php';
            }
            if ( ! is_plugin_active( $active_file_name ) ) {
                $actions['recommend_plugins'] = 'active';
            }
        }

    }

    $actions = apply_filters( 'awada_get_actions_required', $actions );
    $hide_by_click = get_option( 'awada_actions_dismiss' );
    if ( ! is_array( $hide_by_click ) ) {
        $hide_by_click = array();
    }

    $n_active  = $n_dismiss = 0;
    $number_notice = 0;
    foreach ( $actions as $k => $v ) {
        if ( ! isset( $hide_by_click[ $k ] ) ) {
            $hide_by_click[ $k ] = false;
        }

        if ( $v == 'active' ) {
            $n_active ++ ;
            $number_notice ++ ;
            if ( $hide_by_click[ $k ] ) {
                if ( $hide_by_click[ $k ] == 'hide' ) {
                    $number_notice -- ;
                }
            }
        } else if ( $v == 'dismiss' ) {
            $n_dismiss ++ ;
        }

    }

    $return = array(
        'actions' => $actions,
        'number_actions' => count( $actions ),
        'number_active' => $n_active,
        'number_dismiss' => $n_dismiss,
        'hide_by_click'  => $hide_by_click,
        'number_notice'  => $number_notice,
    );
    if ( $return['number_notice'] < 0 ) {
        $return['number_notice'] = 0;
    }

    return $return;
}

add_action('switch_theme', 'awada_reset_actions_required');
function awada_reset_actions_required () {
    delete_option('awada_actions_dismiss');
}


if ( ! function_exists( 'awada_admin_scripts' ) ) :
    /**
     * Enqueue scripts for admin page only: Theme info page
     */
    function awada_admin_scripts( $hook ) {
        if ( $hook === 'widgets.php' || $hook === 'appearance_page_ft_awada'  ) {
            wp_enqueue_style( 'awada-admin-css', get_template_directory_uri() . '/css/admin.css' );
            // Add recommend plugin css
            wp_enqueue_style( 'plugin-install' );
            wp_enqueue_script( 'plugin-install' );
            wp_enqueue_script( 'updates' );
            add_thickbox();
        }
    }
endif;
add_action( 'admin_enqueue_scripts', 'awada_admin_scripts' );

add_action('admin_menu', 'awada_theme_info');
function awada_theme_info() {

    $actions = awada_get_actions_required();
    $number_count = $actions['number_notice'];

    if ( $number_count > 0 ){
        $update_label = sprintf( _n( '%1$s action required', '%1$s actions required', $number_count, 'awada' ), $number_count );
        $count = "<span class='update-plugins count-".esc_attr( $number_count )."' title='".esc_attr( $update_label )."'><span class='update-count'>" . number_format_i18n($number_count) . "</span></span>";
        $menu_title = sprintf( esc_html__('Awada Theme %s', 'awada'), $count );
    } else {
        $menu_title = esc_html__('Awada Theme', 'awada');
    }

    add_theme_page( esc_html__( 'Awada Dashboard', 'awada' ), $menu_title, 'edit_theme_options', 'ft_awada', 'awada_theme_info_page');
}


/**
 * Add admin notice when active theme, just show one timetruongsa@200811
 *
 * @return bool|null
 */
function awada_admin_notice() {
    if ( ! function_exists( 'awada_get_actions_required' ) ) {
        return false;
    }
    $actions = awada_get_actions_required();
    $number_action = $actions['number_notice'];

    if ( $number_action > 0 ) {
        $theme_data = wp_get_theme();
        ?>
        <div class="updated notice notice-success notice-alt is-dismissible">
            <p><?php printf( __( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our <a href="%2$s">Welcome page</a>', 'awada' ),  $theme_data->Name, admin_url( 'themes.php?page=ft_awada' )  ); ?></p>
        </div>
        <?php
    }
}


function awada_one_activation_admin_notice(){
    global $pagenow;
    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
        add_action( 'admin_notices', 'awada_admin_notice' );
    }
}


function awada_render_recommend_plugins( $recommend_plugins = array() ){
    foreach ( $recommend_plugins as $plugin_slug => $plugin_info ) {
        $plugin_info = wp_parse_args( $plugin_info, array(
            'name' => '',
            'active_filename' => '',
        ) );
        $plugin_name = $plugin_info['name'];
        $status = is_dir( WP_PLUGIN_DIR . '/' . $plugin_slug );
        $button_class = 'install-now button';
        if ( $plugin_info['active_filename'] ) {
            $active_file_name = $plugin_info['active_filename'] ;
        } else {
            $active_file_name = $plugin_slug . '/' . $plugin_slug . '.php';
        }

        if ( ! is_plugin_active( $active_file_name ) ) {
            $button_txt = esc_html__( 'Install Now', 'awada' );
            if ( ! $status ) {
                $install_url = wp_nonce_url(
                    add_query_arg(
                        array(
                            'action' => 'install-plugin',
                            'plugin' => $plugin_slug
                        ),
                        network_admin_url( 'update.php' )
                    ),
                    'install-plugin_'.$plugin_slug
                );

            } else {
                $install_url = add_query_arg(array(
                    'action' => 'activate',
                    'plugin' => rawurlencode( $active_file_name ),
                    'plugin_status' => 'all',
                    'paged' => '1',
                    '_wpnonce' => wp_create_nonce('activate-plugin_' . $active_file_name ),
                ), network_admin_url('plugins.php'));
                $button_class = 'activate-now button-primary';
                $button_txt = esc_html__( 'Active Now', 'awada' );
            }

            $detail_link = add_query_arg(
                array(
                    'tab' => 'plugin-information',
                    'plugin' => $plugin_slug,
                    'TB_iframe' => 'true',
                    'width' => '772',
                    'height' => '349',

                ),
                network_admin_url( 'plugin-install.php' )
            );

            echo '<div class="rcp">';
            echo '<h4 class="rcp-name">';
            echo esc_html( $plugin_name );
            echo '</h4>';
            echo '<p class="action-btn plugin-card-'.esc_attr( $plugin_slug ).'"><a href="'.esc_url( $install_url ).'" data-slug="'.esc_attr( $plugin_slug ).'" class="'.esc_attr( $button_class ).'">'.$button_txt.'</a></p>';
            echo '<a class="plugin-detail thickbox open-plugin-details-modal" href="'.esc_url( $detail_link ).'">'.esc_html__( 'Details', 'awada' ).'</a>';
            echo '</div>';
        }

    }
}

function awada_admin_dismiss_actions(){
    // Action for dismiss
    if ( isset( $_GET['awada_action_notice'] ) ) {
        $actions_dismiss =  get_option( 'awada_actions_dismiss' );
        if ( ! is_array( $actions_dismiss ) ) {
            $actions_dismiss = array();
        }
        $action_key = stripslashes( $_GET['awada_action_notice'] );
        if ( isset( $actions_dismiss[ $action_key ] ) &&  $actions_dismiss[ $action_key ] == 'hide' ){
            $actions_dismiss[ $action_key ] = 'show';
        } else {
            $actions_dismiss[ $action_key ] = 'hide';
        }
        update_option( 'awada_actions_dismiss', $actions_dismiss );
        $url = $_SERVER['REQUEST_URI'];
        $url = remove_query_arg( 'awada_action_notice', $url );
        wp_redirect( $url );
        die();
    }

}

add_action( 'admin_init', 'awada_admin_dismiss_actions' );


/* activation notice */
add_action( 'load-themes.php',  'awada_one_activation_admin_notice'  );

function awada_theme_info_page() {

    $theme_data = wp_get_theme('awada');

    if ( isset( $_GET['awada_action_dismiss'] ) ) {
        $actions_dismiss =  get_option( 'awada_actions_dismiss' );
        if ( ! is_array( $actions_dismiss ) ) {
            $actions_dismiss = array();
        }
        $actions_dismiss[ stripslashes( $_GET['awada_action_dismiss'] ) ] = 'dismiss';
        update_option( 'awada_actions_dismiss', $actions_dismiss );
    }

    // Check for current viewing tab
    $tab = null;
    if ( isset( $_GET['tab'] ) ) {
        $tab = $_GET['tab'];
    } else {
        $tab = null;
    }

    $actions_r = awada_get_actions_required();
    $number_action = $actions_r['number_notice'];
    $actions = $actions_r['actions'];

    $current_action_link =  admin_url( 'themes.php?page=ft_awada&tab=actions_required' );
    $recommend_plugins = get_theme_support( 'recommend-plugins' );
    if ( is_array( $recommend_plugins ) && isset( $recommend_plugins[0] ) ){
        $recommend_plugins = $recommend_plugins[0];
    } else {
        $recommend_plugins[] = array();
    }
    ?>
    <div class="wrap about-wrap theme_info_wrapper">
        <h1><?php printf(esc_html__('Welcome to %1$s - Version %2$s', 'awada'), $theme_data->Name, $theme_data->Version ); ?></h1>
        <div class="about-text"><?php esc_html_e( 'Awada theme is now installed and ready to use! We want to make sure you have the best experience using Awada theme and that is why we gathered here all the necessary information for you. We hope you will enjoy using Awada theme.', 'awada' ); ?></div>
        <a target="_blank" href="<?php echo esc_url('https://www.webhuntinfotech.com/'); ?>" class="webhuntthemes-badge wp-badge"><span>WebHunt Themes</span></a>
        <h2 class="nav-tab-wrapper">
            <a href="?page=ft_awada" class="nav-tab<?php echo is_null($tab) ? ' nav-tab-active' : null; ?>"><?php esc_html_e( 'awada', 'awada' ) ?></a>
            <a href="?page=ft_awada&tab=actions_required" class="nav-tab<?php echo $tab == 'actions_required' ? ' nav-tab-active' : null; ?>"><?php esc_html_e( 'Actions Required', 'awada' ); echo ( $number_action > 0 ) ? "<span class='theme-action-count'>{$number_action}</span>" : ''; ?></a>
            <a href="?page=ft_awada&tab=changelog-viewer" class="nav-tab<?php echo $tab == 'changelog-viewer' ? ' nav-tab-active' : null; ?>"><?php esc_html_e( 'Changelog', 'awada' ); ?></span></a>
            <?php do_action( 'awada_admin_more_tabs' ); ?>
        </h2>

        <?php if ( is_null( $tab ) ) { ?>
            <div class="theme_info info-tab-content">
                <div class="theme_info_column clearfix">
                    <div class="theme_info_left">

                        <div class="theme_link">
                            <h3><?php esc_html_e( 'Theme Customizer', 'awada' ); ?></h3>
                            <p class="about"><?php printf(esc_html__('%s supports the Theme Customizer for all theme settings. Click "Customize" to start customize your site.', 'awada'), $theme_data->Name); ?></p>
                            <p>
                                <a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary"><?php esc_html_e('Start Customize', 'awada'); ?></a>
                            </p>
                        </div>
                        <div class="theme_link">
                            <h3><?php esc_html_e( 'Create a child theme', 'awada' ); ?></h3>
                            <p><?php esc_html_e( 'If you want to make changes to the theme\'s files, those changes are likely to be overwritten when you next update the theme. In order to prevent that from happening, you need to create a child theme. For this, please follow the documentation below.', 'awada' ); ?></p>
                  <p><a href="http://demo.webhuntinfotech.com/blog/2016/01/11/how-to-create-a-child-theme/" class="button button-primary" target="_blank"><?php esc_html_e( 'View how to do this', 'awada' ); ?></a></p>
                            <?php do_action( 'awada_dashboard_theme_links' ); ?>
                        </div>
                        <div class="theme_link">
                            <h3><?php esc_html_e( 'Gallery in Blog Posts', 'awada' ); ?></h3>
                            <p><?php esc_html_e( 'If you want to use more than one images in your post or want to make gallery images in your post. This can be accomplished by following the documention below.', 'awada' ); ?></p>
                  <p><a href="http://demo.webhuntinfotech.com/blog/2016/01/11/add-gallery-posts-in-awada-or-kyma-theme/" class="button button-primary" target="_blank"><?php esc_html_e( 'View how to do this', 'awada' ); ?></a></p>
                        </div>
                        <div class="theme_link">
                            <h3><?php esc_html_e( 'Having Trouble, Need Support?', 'awada' ); ?></h3>
                            <p class="about"><?php printf(esc_html__('Support for %s WordPress theme is conducted through WordPress support ticket system.', 'awada'), $theme_data->Name); ?></p>
                            <p>
                                <a href="<?php echo esc_url('https://wordpress.org/support/theme/awada' ); ?>" target="_blank" class="button button-secondary"><?php echo sprintf( esc_html('Create a support ticket', 'awada'), $theme_data->Name); ?></a>
                            </p>
                        </div>
                    </div>

                    <div class="theme_info_right">
                        <img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="Theme Screenshot" />
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ( $tab == 'actions_required' ) { ?>
            <div class="action-required-tab info-tab-content">
                <?php if ( $actions_r['number_active']  > 0 ) { ?>
                    <?php $actions = wp_parse_args( $actions, array( 'page_on_front' => '', 'page_template' ) ) ?>

                    <?php if ( $actions['recommend_plugins'] == 'active' ) {  ?>
                        <div id="plugin-filter" class="recommend-plugins action-required">
                            <a  title="" class="dismiss" href="<?php echo add_query_arg( array( 'awada_action_notice' => 'recommend_plugins' ), $current_action_link ); ?>">
                                <?php if ( $actions_r['hide_by_click']['recommend_plugins'] == 'hide' ) { ?>
                                    <span class="dashicons dashicons-hidden"></span>
                                <?php } else { ?>
                                    <span class="dashicons  dashicons-visibility"></span>
                                <?php } ?>
                            </a>
                            <h3><?php esc_html_e( 'Recommend Plugins', 'awada' ); ?></h3>
                            <?php
                            awada_render_recommend_plugins( $recommend_plugins );
                            ?>
                        </div>
                    <?php } ?>


                    <?php if ( $actions['page_on_front'] == 'active' ) {  ?>
                        <div class="theme_link  action-required">
                            <a title="<?php  esc_attr_e( 'Dismiss', 'awada' ); ?>" class="dismiss" href="<?php echo add_query_arg( array( 'awada_action_notice' => 'page_on_front' ), $current_action_link ); ?>">
                                <?php if ( $actions_r['hide_by_click']['page_on_front'] == 'hide' ) { ?>
                                    <span class="dashicons dashicons-hidden"></span>
                                <?php } else { ?>
                                    <span class="dashicons  dashicons-visibility"></span>
                                <?php } ?>
                            </a>
                            <h3><?php esc_html_e( 'Switch "Front page displays" to "A static page"', 'awada' ); ?></h3>
                            <div class="about">
                                <p><?php _e( 'In order to Display Home page for your website, please go to Customize -&gt; Static Front Page and switch "Front page displays" to "A static page".', 'awada' ); ?></p>
                            </div>
                            <p>
                                <a  href="<?php echo admin_url('options-reading.php'); ?>" class="button"><?php esc_html_e('Setup front page displays', 'awada'); ?></a>
                            </p>
                        </div>
                    <?php } ?>

                    <?php if ( $actions['page_template'] == 'active' ) {  ?>
                        <div class="theme_link  action-required">
                            <a  title="<?php  esc_attr_e( 'Dismiss', 'awada' ); ?>" class="dismiss" href="<?php echo add_query_arg( array( 'awada_action_notice' => 'page_template' ), $current_action_link ); ?>">
                                <?php if ( $actions_r['hide_by_click']['page_template'] == 'hide' ) { ?>
                                    <span class="dashicons dashicons-hidden"></span>
                                <?php } else { ?>
                                    <span class="dashicons  dashicons-visibility"></span>
                                <?php } ?>
                            </a>
                            <h3><?php esc_html_e( 'Set your homepage page template to "Home".', 'awada' ); ?></h3>

                            <div class="about">
                                <p><?php esc_html_e( 'In order to change homepage section contents, you will need to set template "Home" for your homepage.', 'awada' ); ?></p>
                            </div>
                            <p>
                                <?php
                                $front_page = get_option( 'page_on_front' );
                                if ( $front_page <= 0  ) {
                                    ?>
                                    <a  href="<?php echo admin_url('options-reading.php'); ?>" class="button"><?php esc_html_e('Setup front page displays', 'awada'); ?></a>
                                    <?php

                                }

                                if ( $front_page > 0 && get_post_meta( $front_page, '_wp_page_template', true ) != 'home-page.php' ) {
                                    ?>
                                    <a href="<?php echo get_edit_post_link( $front_page ); ?>" class="button"><?php esc_html_e('Change homepage page template', 'awada'); ?></a>
                                    <?php
                                }
                                ?>
                            </p>
                        </div>
                    <?php } ?>
                    <?php do_action( 'awada_more_required_details', $actions ); ?>
                <?php  } else { ?>
                    <h3><?php  printf( __( 'Keep update with %s', 'awada' ) , $theme_data->Name ); ?></h3>
                    <p><?php _e( 'Hooray! There are no required actions for you right now.', 'awada' ); ?></p>
                <?php } ?>
            </div>
        <?php } ?>

        <?php if ( $tab == 'changelog-viewer' ) { ?>
            <div class="changelog-tab-content info-tab-content">
                <?php
                WP_Filesystem();
                global $wp_filesystem;
                $Awada_lite_changelog = $wp_filesystem->get_contents( get_template_directory().'/CHANGELOG.md' );
                $Awada_lite_changelog_lines = explode(PHP_EOL, $Awada_lite_changelog);
                foreach($Awada_lite_changelog_lines as $Awada_lite_changelog_line){
                    if(substr( $Awada_lite_changelog_line, 0, 3 ) === "###"){
                        echo '<h3>'.substr($Awada_lite_changelog_line,3).'</h3>';
                    }else if(substr( $Awada_lite_changelog_line, 0, 2 ) === "##"){
                        echo '<h4>'.substr($Awada_lite_changelog_line,3).'</h4>';
                    } else {
                        echo $Awada_lite_changelog_line,'<br/>';
                    }
                }

                ?>
            </div>
        <?php } ?>

        <?php do_action( 'awada_more_tabs_details', $actions ); ?>

    </div> <!-- END .theme_info -->
    <script type="text/javascript">
        jQuery(  document).ready( function( $ ){
            $( 'body').addClass( 'about-php' );

            $( '.copy-settings-form').on( 'submit', function(){
                var c = confirm( '<?php echo esc_attr_e( 'Are you sure want to copy ?', 'awada' ); ?>' );
                if ( ! c ) {
                    return false;
                }
            } );
        } );
    </script>
    <?php
}
