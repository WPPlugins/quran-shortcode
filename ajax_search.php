<?php
include_once '../../../wp-load.php';
$searchrecord = $_GET['search_keyword'];
$aya_limit = $_GET['aya_limit'];
$ayats = QurangetAya($searchrecord,$aya_limit);

if (!empty($ayats)) {
	foreach ($ayats as $key => $value) {
		$aya = str_replace($searchrecord, '<strong class="searchfocus">' . $searchrecord . '</strong>', $value -> AyahArabic);
		echo sprintf('<li>
		<input type="hidden" name="limit[]" value="%s"  />
		<input type="hidden" name="sora[]" value="%s"  />
		<input type="hidden" name="aya[]" value="%s" />
		<input type="checkbox" id="for_' . $key . '" name="quran_aya[]" class="quran_aya" value="%s">
		<label class="aya_serach_ajax" for="for_' . $key . '" ><div class="admin_display_aya">%s</div></label>
		</li>',$aya_limit, $value -> SuraID, $value -> VerseID, $value -> AyahText, $aya);
	}
}
?>
