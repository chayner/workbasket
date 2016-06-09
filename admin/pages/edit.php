<?
$module=19;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

$page = sql_query("select * from pages where id = $id limit 1");

$page_html = $_SERVER['DOCUMENT_ROOT']."/pages/".$page[0]['filename'];
	
if (file_exists($page_html)) {
	//echo "Yay.  ".$page.".html exists. And here it is:";
	$fullpage = file_get_contents($page_html);

	$title_start = strpos($fullpage,"<title>")+7;
	$title_end = strpos($fullpage,"</title>");
	$title_length = $title_end - $title_start;
	//echo "Title: $title_start to $title_end";
	
	$page_title = substr($fullpage,$title_start,$title_length);
	//echo "<br>$page_title";
	
	$page_explode = explode("<body",$fullpage);
	
	$end_bodytag = strpos($page_explode[1],">");
	$page_body = substr($page_explode[1],$end_bodytag+1);
	$page_end = strrpos($page_body,"</body>");
	$page_body = rtrim(substr(rtrim($page_body),0,$page_end));
	
	
	$page[0]['title'] = $page_title;
	$page[0]['body'] = $page_body;
}

$smarty->assign('page', $page);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('action', 'edit');
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./form.tpl.html');


mysql_close();
?>