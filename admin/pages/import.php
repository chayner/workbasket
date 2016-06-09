<?
$module=19;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

$page_html = $_SERVER['DOCUMENT_ROOT']."/pages/".$filename;

if (file_exists($page_html)) {
	//echo "Yay.  ".$page.".html exists. And here it is:";
	$fullpage = file_get_contents($page_html);
} else {
	//echo "Sorry.  I got nothing for $page_htm or $page_html.";
}

if (strpos($fullpage,"<docid>") === 0) {
	$id_start = strpos($fullpage,"<docid>")+7;
	$id_end = strpos($fullpage,"</docid>");
	$id_length = $id_end - $id_start;
	$page_id = substr($fullpage,$id_start,$id_length);
} else {
	$latest_id = sql_query("select id from pages order by id desc limit 1");
	$page_id = $latest_id[0]['id']+1;
}

$title_start = strpos($fullpage,"<title>")+7;
$title_end = strpos($fullpage,"</title>");
$title_length = $title_end - $title_start;
$page_title = substr($fullpage,$title_start,$title_length);


$page_explode = explode("<body",$fullpage);

$end_bodytag = strpos($page_explode[1],">");
$page_body = substr($page_explode[1],$end_bodytag+1);
$page_end = strrpos($page_body,"</body>");
$page_body = rtrim(substr(rtrim($page_body),0,$page_end));

$page[0]['title'] = $page_title;
$page[0]['filename'] = $filename;
$page[0]['body'] = $page_body;
$page[0]['parent'] = 0;
$page[0]['id'] = $page_id;

$smarty->assign('page', $page);
$smarty->assign('action', "import");
$smarty->assign('module', $module);
$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./form.tpl.html');


mysql_close();
?>