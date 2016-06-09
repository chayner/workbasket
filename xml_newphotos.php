<?
header('Content-Type: text/xml'); 
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<gallery>\n";

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");

$photos = sql_query("select id, caption from photos where category = 7 order by caption");
if ($cat['ordervar']) {
	$date_str = strtotime($cat['ordervar']);
	$date_format = date("M j, Y", $date_str);
}
echo "<album id=\"".$cat['id']."\" title=\"".trim(strip_tags($cat['name'],'<b>'))."\" description=\"".trim($cat['description'])."\" lgPath=\"".$siteroot."/photos/\" tnPath=\"".$siteroot."/thumbs/\" tn=\"".$siteroot."/thumbs/".$photos[0]['id'].".jpg\" >\n";

foreach ($photos as $photo) {
	$text = htmlspecialchars(strip_tags($photo['caption']), ENT_QUOTES);
	//$text = preg_replace('/&#0*39;/', '&apos;', $text);
	echo "<img src=\"".$photo['id'].".jpg\" caption=\"".ltrim(str_replace("\r","",str_replace("\n","",strip_tags($text))))."\" photographer=\"Test\" />\n";
}

echo "</album>\n";

echo "</gallery>";

?>