<?
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");

if (is_numeric($_SERVER['QUERY_STRING'])) {
	$id = $_SERVER['QUERY_STRING'];
}

$module = "files";

if ($id && $module) {
	$file_info = sql_query("select * from $module where id = $id");
	
	if ($file_info = $file_info[0]) {
		$new_dl = $file_info['downloads'] + 1;
		$update_db = db_query("update $module set downloads = $new_dl where id=$file_info[id]") or die ("Download update error: ".mysql_error());
		/*
		echo "<pre>";
		print_r($file_info);
		echo "</pre>";
		*/
		$fullpath = $_SERVER['DOCUMENT_ROOT']."/$module/".$file_info['filename'];
		//echo "$fullpath";
		header('Content-Description: File Transfer');
		header("Content-Type: ".$file_info['filetype']);
		header("Content-Length: ".$file_info['filesize']);
		
		if ($user_browser == "ie") {
			header("Content-Disposition: inline; filename=\"" . basename($file_info['filename']."\""));
		} else {
			header("Content-Disposition: attachment; filename=\"" . basename($file_info['filename']."\""));
		}
		readfile($fullpath);
		exit;
	} else {
		echo "File Not Found.";
	}
	
} else {
	echo "Incorrect ID.";
}

?>