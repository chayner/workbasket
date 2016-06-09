<?
$module=8;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");


function insert_listChildren($parent) {
	list_children($parent[parent_id], $parent[cur_cat_mod], $parent[depth], $parent[owner]); 
}

if (!$cur_cat_mod) {
	$cur_cat_mod = 0;
}

$cur_cat_mod_query = sql_query("select * from modules where id=$cur_cat_mod");
$smarty->assign('cur_cat_mod', $cur_cat_mod);
$smarty->assign('cur_cat_mod_name', $cur_cat_mod_query[0][name]);
$smarty->assign('cur_cat_mod_path', $cur_cat_mod_query[0][path]);

// Find all global modules
$global_mods = sql_query("select id from modules where global_mod = 1");
$global_csv = "1";
foreach ($global_mods as $global_mod) {
		$global_csv .= ",".$global_mod['id'];
}
$global_array = explode(",",$global_csv);

if (in_array($cur_cat_mod,$global_array)) {
	$section_filter = "";
}

$cat_query = sql_query("select distinct id, ordervar, name from categories where id != 0 and module='$cur_cat_mod' $section_filter order by name desc");
$smarty->assign('cat', $cat_query);

$smarty->assign('module', $module);
$smarty->assign('from', $from);
$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./index.tpl.html');


mysql_close();
?>