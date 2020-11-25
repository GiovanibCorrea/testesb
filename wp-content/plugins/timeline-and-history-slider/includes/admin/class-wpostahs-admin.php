<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Timeline and History slider
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpostahs_Admin {

	function __construct() {

		// Action to add admin menu
		add_action( 'admin_menu', array($this, 'wpostahs_register_menu'), 12 );

		// Admin init process
		add_action( 'admin_init', array($this, 'wpostahs_admin_init_process') );

		// Action to add custom column to Timeline listing
		add_filter("manage_wpostahs-slider-category_custom_column", array( $this, 'wpostahs_slider_category_columns'), 10, 3);

		// Action to add custom column data to Timeline listing
		add_filter("manage_edit-wpostahs-slider-category_columns", array( $this, 'wpostahs_slider_category_manage_columns') );
	}

	/**
	 * Function to add menu
	 * 
	 * @package Timeline and History slider
	 * @since 1.0.0
	 */
	function wpostahs_register_menu() {
		// Register plugin premium page
		add_submenu_page( 'edit.php?post_type='.WPOSTAHS_POST_TYPE, __('Upgrade to PRO -  Timeline and History slider', 'timeline-and-history-slider'), '<span style="color:#2ECC71">'.__('Upgrade to PRO', 'timeline-and-history-slider').'</span>', 'manage_options', 'wpostahs-premium', array($this, 'wpostahs_premium_page') );

		// Register plugin hire us page
		add_submenu_page( 'edit.php?post_type='.WPOSTAHS_POST_TYPE, __('Hire Us', 'timeline-and-history-slider'), '<span style="color:#2ECC71">'.__('Hire Us', 'timeline-and-history-slider').'</span>', 'manage_options', 'wpostahs-hireus', array($this, 'wpostahs_hireus_page') );
	}

	/**
	 * Getting Started Page Html
	 * 
	 * @package Timeline and History slider
	 * @since 1.0.0
	 */
	function wpostahs_premium_page() {
		include_once( WPOSTAHS_DIR . '/includes/admin/settings/premium.php' );
	}

	/**
	 * Hire Us Page Html
	 * 
	 * @package Timeline and History Slider
	 * @since 1.0.0
	 */
	function wpostahs_hireus_page() {		
		include_once( WPOSTAHS_DIR . '/includes/admin/settings/hire-us.php' );
	}

	/**
	 * Admin Prior Process
	 * 
	 * @package Timeline and History slider
	 * @since 1.0.0
	 */
	function wpostahs_admin_init_process() {
		// If plugin notice is dismissed
	    if( isset($_GET['message']) && $_GET['message'] == 'wpostahs-plugin-notice' ) {
	    	set_transient( 'wpostahs_install_notice', true, 604800 );
	    }
	}

	/**
	 * Add custom column to Timeline listing page
	 * 
	 * @package Timeline and History slider
	 * @since 1.0.0
	 */
	function wpostahs_slider_category_columns($ouput, $column_name, $tax_id) {
		if( $column_name == 'wpostahs_shortcode' ) {
			$ouput .= '[th-slider category="' . $tax_id. '"]';
		}
	    return $ouput;
	}

	/**
	 * Add custom column data to Timeline listing page
	 * 
	 * @package Timeline and History slider
	 * @since 1.0.0
	 */
	function wpostahs_slider_category_manage_columns($columns) {
	   $new_columns['wpostahs_shortcode'] = __( 'Timeline Shortcode', 'timeline-and-history-slider' );
		$columns = wpostahs_logo_add_array( $columns, $new_columns, 2 );
		return $columns;
	}
}

$wpostahs_Admin = new Wpostahs_Admin();