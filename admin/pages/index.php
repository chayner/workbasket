<?
$module=19;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

if (!session_is_registered("expand") || !$expand) {
	session_register("expand");
}

// If p exists, change priority

if ($id && $p) {
	
	$page_info = sql_query("select * from pages where id=$id");
	$parent = $page_info[0]['parent'];
	$old_order = $page_info[0]['ordervar'];

	if ($p == "up") {
		$new_order = $old_order - 1;
	} elseif ($p == "down") {
		$new_order = $old_order + 1;
	}

	$page_swap = sql_query("select id from pages where ordervar = $new_order and parent = $parent");
	$swap_id = $page_swap[0]['id'];
	$change_order = db_query("update pages set ordervar = $new_order where id=$id");
	$change_order = db_query("update pages set ordervar = $old_order where id=$swap_id"); 
	
} elseif ($id && $show != "") {
	$change_disp = db_query("update pages set display_p = $show where id=$id") or die("Display problem: ".mysql_error());
	if ($change_disp) {
		$feedback == "Show / Hide changed.";
	}
} elseif ($id && $e != "") {
	$expand[$id] = $e;
}

$expand[0] = 1;

// Look for orphan files on the server in /pages 

$dirloc = $_SERVER['DOCUMENT_ROOT']."/pages/";
$directory = opendir($dirloc);

// ------------------------------------------------------------------------------------//
// Make array of all files in /pages directory
$filelist = array();

while (false !== ($file = readdir($directory))) {
	$file_ext = substr($file,strpos($file,".")+1);
	
	if ($file != "temp.html") {
		if ($file_ext == "html" || $file_ext == "htm") {
			array_push($filelist, $file);
			$i++;
		}
	}
}

// ------------------------------------------------------------------------------------//
// Make array of all files in db
$pages_query = db_query("select distinct id, filename from pages where id != 0 $section_filter order by ordervar desc, title desc");

$file_array = array();
$db_files = array();

while (list($id, $filename) = db_fetch_array($pages_query)) {
	array_push($file_array, array($id, $filename));
	array_push($db_files, $filename);
}

// ------------------------------------------------------------------------------------//
// Make array of orphan files
$orphan_files = array();
$i = 0;

foreach($filelist as $file) {
	
	if (!in_array($file, $db_files)) {
		$orphan_files[$i]['filename'] = $file;
		$i++; 
	}
}

// ------------------------------------------------------------------------------------//
// Make array of orphan db entries
$i = 0;
$orphan_db_files = array();
foreach($file_array as $entry) {
	if (!in_array($entry[1], $filelist)) {
		array_push($orphan_db_files, $entry[1]);
	}
}

global $orphan_db_files;

sort($orphan_files);

$smarty->assign('orphan_files', $orphan_files);
$smarty->assign('orphan_db_files', $orphan_db_files);

$pages_query = sql_query("select distinct id, filename, title from pages where id != 0 $section_filter order by ordervar desc, title desc");
$smarty->assign('pages', $pages_query);

$smarty->assign('module', $module);
$smarty->assign('from', $from);
$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./index.tpl.html');


mysql_close();
?>