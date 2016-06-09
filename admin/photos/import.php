<?
$module=4;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$dirloc = $_SERVER['DOCUMENT_ROOT']."/toimport/";
$directory = opendir($dirloc);

$filelist = array();
$i = 0;
while (false !== ($file = readdir($directory))) { 
	if ($file{0} != ".") {
		$needle = strrpos($file,".");
		$filelist[$i][filename] = substr($file,0,strrpos($file,"."));
		$i++;
	}
}

$smarty->assign('filelist',$filelist);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('cat', $cat);
$smarty->assign('action', "import");
$smarty->display('import.tpl.html');



mysql_close();
?>