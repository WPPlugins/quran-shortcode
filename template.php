<?php
function fun_Quran($atts, $content) {
	$sora = '';
	$template = esc_attr(get_option('edc_quran_shortcode_template'));
	if (! empty ( $atts ['sora'] )) {
		$_sora = quran_get_sora ( $atts ['sora'] );
		$sora = $_sora->Name;
	}
	
	$aya = '';
	$get_after_aya = null;
	if(!empty($atts['after'])){
		$get_after_aya = $atts['after'];
	}
	
	if (! empty ( $atts ['aya'] )) {
		$aya = $atts ['aya'];
		$ayatext = quran_get_aya($aya,$_sora->ChapterID);
	}
	$trans = null;
	if (! empty ( $atts ['trans'] )) {
		$trans = $atts ['trans'];
	}
	
	
	if($get_after_aya){
			$quran_get_aya_after = quran_get_aya_after($aya,$_sora->ChapterID,$get_after_aya);
			$quran_get_aya_trans_after = quran_get_aya_trans_after($aya,$_sora->ChapterID,$get_after_aya,$trans);
			switch ($template) {
				case 'template1':
					return sprintf ( '<div class="quran-words">%s</div>', Quran_template ($quran_get_aya_after, $sora,$quran_get_aya_trans_after) );
					break;
				case 'template2':
					return sprintf ( '<div class="quran-words">%s</div>', Quran_template2 ($quran_get_aya_after, $sora, $quran_get_aya_trans_after) );
					break;	
				case 'template3':
					return sprintf ( '<div class="quran-words">%s</div>', Quran_template3 ($quran_get_aya_after, $sora,$quran_get_aya_trans_after ) );
					break;
				case 'template4':
					return sprintf ( '<div class="quran-words">%s</div>', Quran_template4 ($quran_get_aya_after, $sora,$quran_get_aya_trans_after ) );
					break;
				case 'custom':
					$_template = str_replace(array('{AyaText}','{Soura}','{Trans}'), array($quran_get_aya_after,$sora,$quran_get_aya_trans_after), get_option('edc_quran_shortcode_template_custom'));
					return sprintf ( '<div class="quran-words">%s</div>',$_template);
					break;
				default:
					return sprintf ( '<div class="quran-words">%s</div>', Quran_template ($quran_get_aya_after, $sora, $quran_get_aya_trans_after ) );
					break;
			}
	}else{
		$ayatext = quran_get_aya($aya,$_sora->ChapterID);
		$ayatrans = quran_get_trans_aya($aya,$_sora->ChapterID,$trans);
		switch ($template) {
				case 'template1':
					return sprintf ( '<div class="quran-words">%s</div>', Quran_template ($ayatext, $sora,$ayatrans ) );
					break;
				case 'template2':
					return sprintf ( '<div class="quran-words">%s</div>', Quran_template2 ($ayatext, $sora,$ayatrans ) );
					break;	
				case 'template3':
					return sprintf ( '<div class="quran-words">%s</div>', Quran_template3 ($ayatext, $sora,$ayatrans ) );
					break;
				case 'template4':
					return sprintf ( '<div class="quran-words">%s</div>', Quran_template4 ($ayatext, $sora,$ayatrans ) );
					break;
				case 'custom':
					$_template = str_replace(array('{AyaText}','{Soura}','{Trans}'), array($ayatext,$sora,$ayatrans), get_option('edc_quran_shortcode_template_custom'));
					return sprintf ( '<div class="quran-words">%s</div>',$_template);
					break;
				default:
					return sprintf ( '<div class="quran-words">%s</div>', Quran_template ($ayatext, $sora, $ayatrans ) );
					break;
			}		
	}
	
}
add_shortcode ( 'Quran', 'fun_Quran' );
function Quran_template($text = null, $sora,$ayatrans =null) {
	return sprintf ( '<table width="%s" border="0" class="aya_display" dir="ltr" cellpadding="0" cellspacing="0">
	<tr>
		<td class="quranboder_01"></td>
		<td class="quranboder_02"></td>
		<td class="quranboder_03"></td>
	</tr>
	<tr>
		<td class="quranboder_04"></td>
		<td class="quranboder_05"><div class="d_aya">%s<span class="quranboder_sora_text">%s<span></div>
		<div class="e_aya">%s</div>
		</td>
		<td class="quranboder_06"></td>
	</tr>
	<tr>
		<td class="quranboder_07"></td>
		<td class="quranboder_08"></td>
		<td class="quranboder_09"></td>
	</tr>
</table>','100%', $text, $sora,$ayatrans);
}
function Quran_template2($text = null, $sora,$ayatrans=null)
{
	return sprintf('<table width="%s" border="0" class="aya_display" dir="ltr" cellpadding="0" cellspacing="0">
			<tr>
				<td class="quranboder2_01"></td>
				<td class="quranboder2_02"></td>
				<td class="quranboder2_03"></td>
			</tr>
			<tr>
				<td class="quranboder2_04"></td>
				<td class="quranboder2_05"><div class="d_aya">%s<span class="quranboder_sora_text">%s<span></div>
				<div class="e_aya">%s</div></td>
				<td class="quranboder2_06"></td>
			</tr>
			<tr>
				<td class="quranboder2_07"></td>
				<td class="quranboder2_08"></td>
				<td class="quranboder2_09"></td>
			</tr>
		</table>','100%', $text, $sora,$ayatrans);
}
function Quran_template3($text = null, $sora,$ayatrans= null)
{
	return sprintf('<table width="%s" border="0" class="aya_display" dir="ltr" cellpadding="0" cellspacing="0">
			<tr>
				<td class="quranboder3_01"></td>
				<td class="quranboder3_02"></td>
				<td class="quranboder3_03"></td>
			</tr>
			<tr>
				<td class="quranboder3_04"></td>
				<td class="quranboder3_05"><div class="d_aya">%s<span class="quranboder_sora_text">%s<span></div>
				<div class="e_aya">%s</div></td>
				<td class="quranboder3_06"></td>
			</tr>
			<tr>
				<td class="quranboder3_07"></td>
				<td class="quranboder3_08"></td>
				<td class="quranboder3_09"></td>
			</tr>
		</table>','100%', $text, $sora,$ayatrans);
}
function Quran_template4($text = null, $sora,$ayatrans = null)
{
	return sprintf('<table width="%s" border="0" class="aya_display" dir="ltr" cellpadding="0" cellspacing="0">
			<tr>
				<td class="quranboder4_01"></td>
				<td class="quranboder4_02"></td>
				<td class="quranboder4_03"></td>
			</tr>
			<tr>
				<td class="quranboder4_04"></td>
				<td class="quranboder4_05"><div class="d_aya">%s<span class="quranboder_sora_text">%s<span></div>
				<div class="e_aya">%s</div></td>
				<td class="quranboder4_06"></td>
			</tr>
			<tr>
				<td class="quranboder4_07"></td>
				<td class="quranboder4_08"></td>
				<td class="quranboder4_09"></td>
			</tr>
		</table>','100%', $text, $sora,$ayatrans);
}
?>