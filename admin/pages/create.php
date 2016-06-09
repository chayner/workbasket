<?
$module=19;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

if (!$id) {
	$feedback = "Please select an existing page entry.";
} else {
	$feedback = page_create($id);
}

header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
?>