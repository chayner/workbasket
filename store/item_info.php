<? 
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include('functions.php');
	include($_SERVER['DOCUMENT_ROOT'].'/includes/functions.php');
	$smarty->assign('page', "store");

$smarty->display('../../templates/header.tpl.html');

global $module;
$module = 13;

if ($id) {
	$cur_merchandise_query = sql_query("select * from merchandise where id=$id limit 1");
	$smarty->assign('cur_merchandise',$cur_merchandise_query);
	$cat = $cur_merchandise_query[0][category];
}

if (!$cat) {
	$cat = 0;		
}

	$cat_filter = "and category = $cat";


	$parent_cat = sql_query("select * from categories where id = $cat and module=$module");
	$smarty->assign('parent_cat',$parent_cat);

	$children = sql_query("select * from categories where parent = $cat and module=$module order by name");
	$smarty->assign('children',$children);
	

$merchandise_query = sql_query("select * from merchandise where id=$id");
$smarty->assign('merchandise',$merchandise_query);
$smarty->assign('cat', $cat);
$smarty->display('item_info.tpl.html');

$smarty->display('../../templates/footer.tpl.html');

mysql_close();
?>