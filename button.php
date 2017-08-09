<?php
add_action ( 'init', 'quran_shortcode_button_init' );
function quran_shortcode_button_init() {
	if (! current_user_can ( 'edit_posts' ) && ! current_user_can ( 'edit_pages' ) && get_user_option ( 'rich_editing' ) == 'true')
		return;
	
	add_filter ( "mce_external_plugins", "quran_register_tinymce_plugin" );
	add_filter ( 'mce_buttons', 'quran_add_tinymce_button' );
}
function quran_register_tinymce_plugin($plugin_array) {
	global $_language;
	if($_language == 'ar'){
	$js_name = 'quran.js';
	}else{
		$js_name = 'quran_en.js';
	}
	$plugin_array ['quran_button'] = plugins_url ($js_name, __FILE__ );
	return $plugin_array;
}
function quran_add_tinymce_button($buttons) {
	$buttons [] = "quran_button";
	return $buttons;
}


?>