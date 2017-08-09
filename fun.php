<?php
function quran_create_soura_table() {
 	global $wpdb;
	
	$table_name = $wpdb -> prefix . 'edc_quran';
	if($wpdb->get_var("show tables like '$table_name'") != $table_name) 
	{
		$sql = "CREATE TABLE `$table_name` (
			  `ID` int(11) NOT NULL AUTO_INCREMENT,
			  `DatabaseID` smallint(6) NOT NULL,
			  `SuraID` int(11) NOT NULL,
			  `VerseID` int(11) NOT NULL,
			  `AyahArabic` text CHARACTER SET utf8 NOT NULL,
			  `AyahText` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
			  PRIMARY KEY (`ID`)
		);";
 		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		// add option 
	
	}
	
	
	$table_name = $wpdb -> prefix . 'edc_suraames';
	if($wpdb->get_var("show tables like '$table_name'") != $table_name) 
	{
		$sql = "CREATE TABLE  `$table_name` (
			  `ChapterID` int(11) NOT NULL,
			  `Name` varchar(40) NOT NULL
			);";
 
		 require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		 dbDelta($sql);
		 quran_insert_into_soura();
		 quran_insert_into_aya();
	}
	
	
	
$table_name = $wpdb -> prefix . 'edc_en_quran';
	if($wpdb->get_var("show tables like '$table_name'") != $table_name) 
	{
		$sql = "CREATE TABLE  `$table_name` (
	`ID` INTEGER NOT NULL AUTO_INCREMENT,
	`DatabaseID` SMALLINT NOT NULL,
	`SuraID` INTEGER NOT NULL,
	`VerseID` INTEGER NOT NULL,
	`AyahText` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`ID`) );";
 
		 require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		 dbDelta($sql);
		 quran_insert_into_en_quran();
	}	
		
 		add_option('edc_quran_shortcode_template','template1');
		add_option('edc_quran_shortcode_template_custom','<div>{AyaText} {Soura}</div>'); 
		add_option('edc_quran_shortcode_version','1.0');
}
 
function quran_insert_into_en_quran(){
	global $wpdb;
	$table = $wpdb->prefix.'edc_en_quran';
	$sql_soura = quran_read_db_file('en_quran.txt');
	$_sql_soura = str_replace('{table}',$table, $sql_soura);
	$sql_soura = explode('expload;', $sql_soura);
	$sql_soura = array_filter($sql_soura);
	 
	if(is_array($sql_soura) & count($sql_soura) > 0){
		foreach ($sql_soura as $key => $value) {
			$_value = str_replace('{table}',$table, $value);
			$wpdb->query($_value);
		}
	} 
	
}
function quran_insert_into_soura(){
	global $wpdb;
	$table = $wpdb->prefix.'edc_suraames';
	$sql_soura = quran_read_db_file('soura.txt');
	$_sql_soura = str_replace('{table}',$table, $sql_soura);
	$wpdb->query($_sql_soura);
}
function quran_insert_into_aya(){
	global $wpdb;
	$table = $wpdb->prefix.'edc_quran';
	$sql_soura = quran_read_db_file('aya.txt');
	$sql_soura = explode(';', $sql_soura);
	$sql_soura = array_filter($sql_soura);
	
	if(is_array($sql_soura) & count($sql_soura) > 0){
		foreach ($sql_soura as $key => $value) {
			$_value = str_replace('{table}',$table, $value);
			$wpdb->query($_value);
		}
	}
	
}
function quran_delete_soura_table()
{
	global $wpdb;
	$table_name = $wpdb->prefix.'edc_suraames';
	$sql = "DROP TABLE ". $table_name;
	$wpdb->query($sql);
	
	$table_name = $wpdb->prefix.'edc_quran';
	$sql = "DROP TABLE ". $table_name;
	$wpdb->query($sql);
	$table_name = $wpdb->prefix.'edc_en_quran';
	$sql = "DROP TABLE ". $table_name;
	$wpdb->query($sql);	

	delete_option('edc_quran_shortcode_template');
	delete_option('edc_quran_shortcode_template_custom');
	delete_option('edc_quran_shortcode_version','1.0');
	
}

function quran_read_db_file($file){
	$path = QURAN_PLUGIN_PATH.'db_file/'.$file;
	if(file_exists($path)){
		return file_get_contents($path);
	}
}

function sample_template_select_class($template){
	switch ($template) {
		case 'template1':
			  return 'sample_temp1';
			break;
		case 'template2':
			  return 'sample_temp2';
			break;
		case 'template3':
			  return 'sample_temp3';
			break;
		case 'template4':
			  return 'sample_temp4';
			break;
		default:
			return '';
			break;
	}
}

function quran_lang($key='')
{
	global $quranlang;
	if(is_array($quranlang) && array_key_exists($key, $quranlang)){
		return $quranlang[$key];
	}
	return;
}

?>