<?php
/**
* Plugin Name: Sales Count Product for WooCommerce
* Description: This plugin allows create Elegant Free Shipping Bar plugin.
* Version: 1.0
* Copyright: 2020
* Text Domain: sales-count-product-for-woocommerce
* Domain Path: /languages 
*/


if (!defined('ABSPATH')) {
	exit();
}
if (!defined('SCPFW_PLUGIN_NAME')) {
  define('SCPFW_PLUGIN_NAME', 'Sales Count Product for WooCommerce');
}
if (!defined('SCPFW_PLUGIN_VERSION')) {
  define('SCPFW_PLUGIN_VERSION', '2.0.0');
}
if (!defined('SCPFW_PLUGIN_FILE')) {
  define('SCPFW_PLUGIN_FILE', __FILE__);
}
if (!defined('SCPFW_PLUGIN_DIR')) {
  define('SCPFW_PLUGIN_DIR',plugins_url('', __FILE__));
}
if (!defined('SCPFW_BASE_NAME')) {
    define('SCPFW_BASE_NAME', plugin_basename(SCPFW_PLUGIN_FILE));
}
if (!defined('SCPFW_DOMAIN')) {
  define('SCPFW_DOMAIN', 'sales-count-product-for-woocommerce');
}

if (!class_exists('SCPFW')) {
	class SCPFW {
  	protected static $SCPFW_instance;

  	public static function SCPFW_instance() {
    	if (!isset(self::$SCPFW_instance)) {
      	self::$SCPFW_instance = new self();
      	self::$SCPFW_instance->init();
      	self::$SCPFW_instance->includes();
    	}
    	return self::$SCPFW_instance;
    }

    function __construct() {
    	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    	//check plugin activted or not
    	add_action('admin_init', array($this, 'SCPFW_check_plugin_state'));
  	}

  	function init() {	   
  		add_action( 'admin_notices', array($this, 'SCPFW_show_notice'));   	
    	add_action( 'admin_enqueue_scripts', array($this, 'SCPFW_load_admin_script_style'));
    	add_action( 'wp_enqueue_scripts',  array($this, 'SCPFW_load_script_style'));
  		add_filter( 'plugin_row_meta', array( $this, 'SCPFW_plugin_row_meta' ), 10, 2 );

    }		

    //Load all includes files
    function includes() {
      include_once('includes/scpfw_comman.php');
      include_once('includes/scpfw_backend.php');
    	include_once('includes/scpfw_kit.php');
      include_once('includes/scpfw_frontend.php');
    }

    function SCPFW_load_admin_script_style() {
    	  wp_enqueue_style( 'scpfw-backend-css', SCPFW_PLUGIN_DIR.'/assets/css/scpfw_backend_css.css', false, '1.0' );
        wp_enqueue_script( 'scpfw-backend-js', SCPFW_PLUGIN_DIR.'/assets/js/scpfw_backend_js.js', false, '1.0' );
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker-alpha', SCPFW_PLUGIN_DIR . '/assets/js/wp-color-picker-alpha.js', array( 'wp-color-picker' ), '1.0.0', true );
        $color_picker_strings = array(
            'clear'            => __( 'Clear', 'textdomain' ),
            'clearAriaLabel'   => __( 'Clear color', 'textdomain' ),
            'defaultString'    => __( 'Default', 'textdomain' ),
            'defaultAriaLabel' => __( 'Select default color', 'textdomain' ),
            'pick'             => __( 'Select Color', 'textdomain' ),
            'defaultLabel'     => __( 'Color value', 'textdomain' ),
        );
        wp_localize_script( 'wp-color-picker-alpha', 'wpColorPickerL10n', $color_picker_strings );
        wp_enqueue_script( 'wp-color-picker-alpha' );
    }


    function SCPFW_load_script_style() {
      wp_enqueue_style( 'scpfw-frontend-css', SCPFW_PLUGIN_DIR.'/assets/css/scpfw_frontend_css.css', false, '1.0' );
    }

    function SCPFW_show_notice() {
    	if ( get_transient( get_current_user_id() . 'wfcerror' ) ) {

    		deactivate_plugins( plugin_basename( __FILE__ ) );

    		delete_transient( get_current_user_id() . 'wfcerror' );

    		echo '<div class="error"><p> This plugin is deactivated because it require <a href="plugin-install.php?tab=search&s=woocommerce">WooCommerce</a> plugin installed and activated.</p></div>';
    	}
  	}

    function SCPFW_plugin_row_meta( $links, $file ) {
      if ( SCPFW_BASE_NAME === $file ) {
        $row_meta = array(
            'rating'    =>  '<a href="https://xthemeshop.com/sales-count-product-for-woocommerce/" target="_blank">Documentation</a> | <a href="https://xthemeshop.com/contact/" target="_blank">Support</a> | <a href="https://wordpress.org/support/plugin/sales-count-product-for-woocommerce/reviews/?filter=5" target="_blank"><img src="'.SCPFW_PLUGIN_DIR.'/images/star.png" class="scpfw_rating_div"></a>'
        );
        return array_merge( $links, $row_meta );
      }
      return (array) $links;
    }

    function SCPFW_check_plugin_state(){
  		if ( ! ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) ) {
    		set_transient( get_current_user_id() . 'wfcerror', 'message' );
  		}
  	}

	}
  	add_action('plugins_loaded', array('SCPFW', 'SCPFW_instance'));  	
}



add_action( 'plugins_loaded', 'SCPFW_load_textdomain' );
 
function SCPFW_load_textdomain() {
    load_plugin_textdomain( 'sales-count-product-for-woocommerce', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

function SCPFW_load_my_own_textdomain( $mofile, $domain ) {
    if ( 'sales-count-product-for-woocommerce' === $domain && false !== strpos( $mofile, WP_LANG_DIR . '/plugins/' ) ) {
        $locale = apply_filters( 'plugin_locale', determine_locale(), $domain );
        $mofile = WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) . '/languages/' . $domain . '-' . $locale . '.mo';
    }
    return $mofile;
}
add_filter( 'load_textdomain_mofile', 'SCPFW_load_my_own_textdomain', 10, 2 );
?>