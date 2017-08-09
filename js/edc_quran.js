jQuery(document).ready(function($) {
jQuery('#edc_quran_shortcode_template').change(function(){
 	var $id = jQuery(this);
 	if($id.val() != 'custom'){
 		jQuery('#template_select_custom').removeClass('show_custom');
 		jQuery('#template_select_custom').fadeOut('slow');
 	}
 	switch ($id.val()){
 		case 'template1':
 			jQuery("#template_select").removeClass();
 			jQuery('#template_select').addClass('sample_temp1');
 			break;
 		case 'template2':
 		jQuery("#template_select").removeClass();
 			jQuery('#template_select').addClass('sample_temp2');
 			break;
 		case 'template3':
 		jQuery("#template_select").removeClass();
 			jQuery('#template_select').addClass('sample_temp3');
 			break;
 		case 'template4':
 			jQuery("#template_select").removeClass();
 			jQuery('#template_select').addClass('sample_temp4');
 			
 			break;
 		case 'custom':
 			jQuery("#template_select").removeClass();
 			jQuery('#template_select').addClass('sample_hidden');
 			jQuery('#template_select_custom').fadeIn('slow');
 			break;
 		default:
 			//jQuery('#template_select').hide('');
 		break;
 	}
 });
});
