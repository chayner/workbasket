<?
// downloads.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/functions.php");

$downloads = sql_query("select * from files order by title");

for ($i=0; $i<count($downloads); $i++) {	
	$downloads[$i]['extension'] = $mimetype->getExtension($downloads[$i]['filetype']);
	if ($downloads[$i]['filesize'] > 1000000) {
		$downloads[$i]['sizestring'] = round(($downloads[$i]['filesize'] / 1000000),2) ." mb";	
	} else {
		$downloads[$i]['sizestring'] = round(($downloads[$i]['filesize'] / 1000),2) ." kb";	
	}
}
//print_r($downloads);

$smarty->assign('downloads', $downloads);

$smarty->assign('id', $id);
$smarty->display('free.tpl.html');

mysql_close();
?>
