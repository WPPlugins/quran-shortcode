<?php
add_action ( 'admin_enqueue_scripts', 'admin_enqueue_scripts' );
add_action ( 'wp_enqueue_scripts', 'admin_enqueue_scripts' );
function admin_enqueue_scripts() {
	wp_enqueue_style ( 'quran_panel_shortcode', plugins_url ( 'css/quran_button.css', __FILE__ ) );
}
//add_action('init','load_quran_transl');
add_action( 'plugins_loaded', 'load_quran_transl' );
function load_quran_transl()
{

	 load_plugin_textdomain('quran', FALSE, basename( dirname( __FILE__ ) ) . '/languages');
}


?>