<?

$module=4;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

$smarty->clear_all_cache();

$cat_to_include = $cur_cat['id'];
if ($cur_cat['kids']) {
	$cat_to_include .= ",".$cur_cat['kids'];
}


$photos_query = sql_query("select p.* from photos as p left join categories as c on p.category=c.id where p.deleted_p=0 and p.category in (".$cat_to_include.") order by c.ordervar desc, caption"); 
$smarty->assign('photos', $photos_query);
$num_affected = 0;
foreach ($photos_query as $photo) {
	$src_image = $_SERVER['DOCUMENT_ROOT']."/photos/".$photo['id'].".jpg";
	if ($src_image) {
		$create_thumb = create_thumb($src_image, $photo['id']);
		if ($create_thumb) {
			//echo "<br><img src=/photos/".$photo['id']."_thumb.jpg> Thumb for photo ID ".$photo['id']." Created.";
			$num_affected++;
		} else {
			echo "<p>Error recreating $src_image</p>";
		}
	}
}
$feedback = "$num_affected thumbnails successfully rebuilt.<br><font size=2>(Refresh may be needed to see difference)</font>";
header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback&c=$cur_category");

?>