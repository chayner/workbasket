<?php
header('Content-Type: text/xml'); 
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
	<gallery>\n";

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");

$categories = sql_query("select * from categories where module=4 order by ordervar desc");

foreach ($categories as $cat) {
	$photos = sql_query("select id, caption from photos where category = ".$cat['id']." order by caption");
	if ($cat['ordervar']) {
		$date_str = strtotime($cat['ordervar']);
		$date_format = date("M j, Y", $date_str);
	}
	echo "<album id=\"".$cat['id']."\" title=\"".trim(strip_tags($cat['name'],'<b>'))."\" description=\"".trim($cat['description'])."\" lgPath=\"".$siteroot."/photos/\" tnPath=\"".$siteroot."/thumbs/\" tn=\"".$siteroot."/thumbs/".$photos[0]['id'].".jpg\" >\n";

$photo_cap = array();
$photo_sort = array();

foreach($photos as $photo) {
	$captions[$photo['id']] = $photo['caption'];
	$photo_sort[$photo['id']] = strip_tags($photo['caption']);	
}

asort($photo_sort);

foreach ($photo_sort as $key => $stripped_caption) {
	$caption = $captions[$key];
	$text = strip_tags($caption);
  $text = htmlspecialchars($text, ENT_QUOTES);
  $text = preg_replace('/&#0*39;/', '&apos;', $text);
	
	// $text = preg_replace('/&quot;/', '&apos;', $text);
	// 	$text = preg_replace('/&amp;quot;/', '&apos;', $text);
	echo "<img src=\"".$key.".jpg\" caption=\"".ltrim(str_replace("\r","",str_replace("\n","",strip_tags($text))))."\" photographer=\"Test\" />\n";
}
	echo "</album>\n";
}

echo "</gallery>";

?>