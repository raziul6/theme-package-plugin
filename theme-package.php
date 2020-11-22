<?php
/* 
 * Plugin Name: Theme Pacakge
 * Author: Raziul
 * Author URI: raziul
 * Description: A Light weight and easy package for WP theme
 * Version: 1.0.0
 */
if (!defined('ABSPATH')) {
    exit; //Exit if accessed directly
}
//define
define('DUST_ACC_URL', WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)) . '/');
define('DUST_ACC_PATH', plugin_dir_path(__FILE__));

function dust_toolkit_get_portfolio_cat(){
    $arg = array(
        'taxonomy'  => 'portfolio_cat',
        'orderby'   => 'name',
        'order'     => 'ASC',
    );
    $args = get_categories($arg);
    $args_options = array(esc_html__('--Select Category--', 'theme-package') => '');
    if ($args) {
        foreach ($args as $args) {
            $args_options[$args->name] = $args->slug;
        }
    }
    return $args_options;
}


//Print short codes in widgets
add_filter('widget_text', 'do_shortcode');

//Custom Post
function dust_package_custom_post(){
    //Portfolio Custom Post
    register_post_type( 'portfolio', 
        array(
            'labels' => array(
                'name' => esc_html__( 'Portfolios', 'theme-package' ),
                'singular_name' => esc_html__( 'Portfolio', 'theme-package' ),
                'add_new_item' => esc_html__( 'Add New Portfolio', 'theme-package' ),
            ),
            'show_in_nav_menus' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'excerpt'),
            'menu_icon' => 'dashicons-format-gallery',
            'public' => true,   
        )
    ); 
}
add_action('init', 'dust_package_custom_post');

//Taxonomy Custom Post
function dust_custom_post_taxonomy(){
    register_taxonomy(
        'portfolio_cat',
        'portfolio',
        array(
            'hierarchical' => true,
            'label' => esc_html__('Portfolio Category', 'theme-package'),
            'query_var' => true,
            'show_admin_column'> true,
            'rewrite' => array(
                'slug' => 'gallery-category',
                'with_front' => true,
            )
        )
    );
  }

add_action('init', 'dust_custom_post_taxonomy');


//Shortcode depended on Visual Composer
include_once(ABSPATH . 'wp-admin/includes/plugin.php');

if (is_plugin_active('js_composer/js_composer.php')) {
    //Loading VC addons
    require_once(DUST_ACC_PATH . 'vc-addons/vc-plugins-load.php');

    //Theme Shortcode
    require_once(DUST_ACC_PATH . 'shortcodes/test-shortcode.php');
}

//Registering crazy package files
function dust_package_files(){
    
}

add_action('wp_enqueue_scripts', 'dust_package_files');

if ( ! function_exists( 'dust_text_domain' ) ) {
    //Loads plugin text domain so it can be used in translation
    function dust_text_domain() {
        load_plugin_textdomain( 'theme-package', false, DUST_ACC_PATH . '/languages' );
    }
    add_action( 'plugins_loaded', 'dust_text_domain' );
}


add_filter('the_content', 'dust_remove_empty_p', 20, 1);
    function dust_remove_empty_p($content){
        $content = force_balance_tags($content);
        return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
    }

add_filter('script_loader_tag', 'dust_clean_script_tag');
    function dust_clean_script_tag($input) {
        $input = str_replace( array( 'type="text/javascript"', "type='text/javascript'" ), '', $input );
        return $input;
    }

?>