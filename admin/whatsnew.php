<?
$module=0;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

global $yesterday;
$yesterday = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")));
$smarty->assign('yesterday',$yesterday);
$alltables = sql_query("show table status") or die ("PROBLEM: ".mysql_error());
/*
echo "<pre>";
print_r($alltables);
echo "</pre>";
*/
$smarty->assign('tables',$alltables);

function insert_get_table_info($vars) {
	global $smarty, $yesterday;
	$table = $vars['table'];
	
	if (substr($table,-4) != "_seq" && $table != "permissions") {
		$table_info = sql_query("select created_on from $table where created_on > $yesterday order by created_on desc");
		
		//echo array_search("created_on",$table_info);
		echo "<pre>";
		print_r($table_info);
		echo "</pre>";
		$smarty->assign('table_info', $table_info);
	}
}

$smarty->display('whatsnew.tpl.html');

mysql_close();
?>