<?php
/*
Plugin Name: Quran Shortcode
Plugin URI: http://www.islam.com.kw/DawahApps
Description: Quran Shortcode helps you insert any Quranic text in your post easily by searching for a specific word or choosing the number of the verse and the number of the surah.
Author: EDC Team (E-Da`wah Committee)
Version: 1.0
Author URI: http://www.islam.com.kw
Text Domain: quran-shortcode
Domain Path: /languages
*/

define ( 'QURAN_PLUGIN_URL', plugins_url ( '', __FILE__ ) );
define ( 'QURAN_PLUGIN_PATH', plugin_dir_path (__FILE__ ) );
$_language = get_bloginfo("language");
if($_language == 'ar'){
	include_once QURAN_PLUGIN_PATH.'languages/ar.php';
}else{
	include_once QURAN_PLUGIN_PATH.'languages/en.php';
}

include_once QURAN_PLUGIN_PATH.'fun.php';
include_once QURAN_PLUGIN_PATH.'button.php';
include_once QURAN_PLUGIN_PATH.'assets.php';
include_once QURAN_PLUGIN_PATH.'db.php';
include_once QURAN_PLUGIN_PATH.'option_page.php';
include_once QURAN_PLUGIN_PATH.'template.php';

// create table saoura
register_activation_hook(__FILE__, 'quran_create_soura_table');
// delete table soura
register_uninstall_hook(__FILE__,'quran_delete_soura_table');
register_deactivation_hook(__FILE__,'quran_delete_soura_table');

function my_enqueue($hook) {
	 
    if ( 'toplevel_page_edc_quran_shortcode_option_page' != $hook ) {
        return;
    }

    wp_enqueue_script( 'edc-quran-script-js', plugin_dir_url( __FILE__ ) . '/js/edc_quran.js', array('jquery'));
	
}
add_action( 'admin_enqueue_scripts', 'my_enqueue' );

?>