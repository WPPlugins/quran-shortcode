<?php
add_action('admin_menu', 'edc_quran_shortcode_option_page');

function edc_quran_shortcode_option_page() {
 
	//create new top-level menu
	add_menu_page(quran_lang('plugin_title'),quran_lang('plugin_menu_title'), 'administrator','edc_quran_shortcode_option_page', 'edc_quran_shortcode_settings_page' , plugins_url('/quran_icon.png', __FILE__) );

	//call register settings function
	add_action( 'admin_init', 'register_edc_quran_shortcode_settings' );
}


function register_edc_quran_shortcode_settings() {
	//register our settings
	register_setting( 'edc-quran-shortcode-settings-group', 'edc_quran_shortcode_template' );
	register_setting( 'edc-quran-shortcode-settings-group', 'edc_quran_shortcode_template_custom' );
	
}

function edc_quran_shortcode_settings_page(){

?>

<div class="wrap">
	<h2><?php echo quran_lang('plugin_title') ?></h2>

	<form method="post" action="options.php">
		<?php settings_fields('edc-quran-shortcode-settings-group'); ?>
		<?php do_settings_sections('edc-quran-shortcode-settings-group'); ?>
		<?php $template = esc_attr(get_option('edc_quran_shortcode_template')); ?>
		<?php $custom = esc_attr(get_option('edc_quran_shortcode_template_custom')); ?>
		<h2><?php echo quran_lang('template') ?></h2>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php echo quran_lang('template') ?></th>
				<td>
					<select name="edc_quran_shortcode_template" id="edc_quran_shortcode_template">
						<option value="template1"  <?php if ($template == 'template1') {echo  'selected="selected"';} ?>><?php echo quran_lang('template1') ?></option>
						<option value="template2"  <?php if ($template == 'template2') {echo  'selected="selected"';} ?>><?php echo quran_lang('template2') ?></option>
						<option value="template3"  <?php if ($template == 'template3') {echo  'selected="selected"';} ?>><?php echo quran_lang('template3') ?></option>
						<option value="template4"  <?php if ($template == 'template4') {echo  'selected="selected"';} ?>><?php echo quran_lang('template4') ?></option>
						<option value="custom"  <?php if ($template == 'custom') {echo  'selected="selected"';} ?>><?php echo quran_lang('templatecustom') ?></option>
					</select>
					<br/>
				  <div id="template_select" class="<?php echo sample_template_select_class($template);?> "></div>
				  <div id="template_select_custom" <?php if($template != 'custom'){ echo 'class="hidden_custom"';}else{ echo 'class="show_custom"';} ?>>
				  		<textarea name="edc_quran_shortcode_template_custom"  id="template_custom" rows="5" cols="50"><?php echo $custom; ?></textarea>
				  		<ul>
						<li> {AyaText} : <?php echo quran_lang('aya_text') ?></li>
						<li> {Soura} :  <?php echo quran_lang('soura_name') ?></li>
						<li> {Trans} : <?php echo quran_lang('transaltion') ?> </li>
					</ul>
				  </div>

				</td>
			</tr>
	 
	
		</table>

		<?php submit_button(); ?>
	</form>
</div>
<?php
}
?>