<?php
function QurangetAya($keyword = '',$limit=null) {
	global $wpdb;
	if (! empty ( $keyword )) {
		$table = $wpdb->prefix . 'edc_quran';
		$results = $wpdb->get_results ( "SELECT * FROM $table WHERE `AyahArabic` LIKE '%$keyword%'", OBJECT ) or die ( mysql_error () );
		if(!empty($results) && !empty($limit)){
			foreach ($results as $key => $value) {
				$results[$key]->AyahArabic = get_aya_limit($value->ID,$value->SuraID,$limit);
			}
		}
		return $results;
	}
}
function get_aya_limit($id,$SuraID,$limit){
	global $wpdb;
	$result = '';
	$table = $wpdb->prefix . 'edc_quran';
	$results = $wpdb->get_results ( "SELECT * FROM $table WHERE `ID` >= '$id' AND `SuraID`='$SuraID' LIMIT $limit ", OBJECT ) or die ( mysql_error () );
	foreach ($results as $key => $value) {
		$result.=$value->AyahArabic.'<span class="admin_ecd_aya_aya_mark"><span class="admin_aya_number">'.$value->VerseID.'</span></span>';
		
	}
	return $result;
}
function quran_get_sora($id) {
	global $wpdb;
	$table = $wpdb->prefix . 'edc_suraames';
	return $wpdb->get_row ( "SELECT * FROM $table WHERE `ChapterID`=$id" );
}
function quran_get_aya($id,$sora) {
	global $wpdb;

	$table = $wpdb->prefix . 'edc_quran';
	$row = $wpdb->get_row ( "SELECT * FROM $table WHERE `VerseID`=$id AND `SuraID`=$sora" );
	return sprintf('%s <span class="ecd_aya_aya_mark"><span class="aya_number">%s</span></span>',$row->AyahText,$row->VerseID);
}
function quran_get_trans_aya($id,$sora,$trans=null) {
	global $wpdb;
	if(in_array($trans,array('en'))){
		$table = $wpdb->prefix . 'edc_'.$trans.'_quran';
		$row = $wpdb->get_row ( "SELECT * FROM $table WHERE `VerseID`=$id AND `SuraID`=$sora" );
		return sprintf('%s <span class="ecd_aya_aya_mark"><span class="aya_number">%s</span></span>',$row->AyahText,$row->VerseID);
	}
	return;
}
function quran_get_aya_after($id,$sora,$_limit =1) {
	global $wpdb;
	$result = null;
	$table = $wpdb->prefix . 'edc_quran';
	$results = $wpdb->get_results ("SELECT * FROM $table WHERE `VerseID`>=$id AND `SuraID`=$sora LIMIT $_limit");
	if(!empty($results) && is_array($results) && count($results) > 0){
		foreach ($results as $key => $value) {
			$result.=sprintf('%s <span class="ecd_aya_aya_mark"><span class="aya_number">%s</span></span>',$value->AyahText,$value->VerseID);
		}
	}
	return $result;
}
function quran_get_aya_trans_after($id,$sora,$_limit =1,$trans) {
	global $wpdb;
	$result = null;
	if(in_array($trans, array('en'))){
		$table = $wpdb->prefix . 'edc_'.$trans.'_quran';
		$results = $wpdb->get_results ("SELECT * FROM $table WHERE `VerseID`>=$id AND `SuraID`=$sora LIMIT $_limit");
		if(!empty($results) && is_array($results) && count($results) > 0){
			foreach ($results as $key => $value) {
				$result.=sprintf('%s <span class="ecd_aya_aya_mark"><span class="aya_number">%s</span></span>',$value->AyahText,$value->VerseID);
			}
		}
	}

	return $result;
}


?>