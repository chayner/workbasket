<?

// index.php
$module = "links";

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/functions.php");

$blurb = sql_query("select * from features where id = 2");
$smarty->assign("blurb", $blurb);

$all_categories = sql_query("select distinct c.id as cat_id, c.name as category from links as l, categories as c where l.category = c.id order by c.name");
$smarty->assign('link_cats', $all_categories);

if ($cat) {
	$cat_filter = "and c.id = $cat";
}
$category_query = db_query("select distinct c.id as cat_id, c.name as category from links as l, categories as c where l.category = c.id and l.deleted_p=0 $cat_filter order by name") or die (mysql_error()); 


$link_array = array();
$i = 0;
	
while (list($cat_id, $category) = db_fetch_array($category_query)) {
	$link_array[$i] = sql_query("select * from links where category = '$cat_id' order by title");
	$link_array[$i][category] = $category;
	$i++;
}
$uncat_links = sql_query("select * from links where category = '0' order by title");
if ($uncat_links) {
	$link_array[$i] = $uncat_links;
	$link_array[$i][category] = "Misc Links";
	$i++;
}


$smarty->assign('link', $link_array);

$smarty->assign('id', $id);
$smarty->display('links.tpl.html');


mysql_close();
?>