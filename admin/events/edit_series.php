<?
$module=2;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");


$series_info = sql_query("select * from event_series where id = $id");
$smarty->assign('series',$series_info);

$old_dow = unserialize($series_info[0][dow]);

for ($i=0; $i < count($old_dow); $i++) {
	$day = $old_dow[$i];
	$dow[$day] = 1;
}

$smarty->assign('dow',$dow);

$event_info = sql_query("select * from events where series_id=$id");

global $event_info;


function check_field ($field) {
	global $id, $event_info;
	
	$test_field = $event_info[0][$field];
	$test_field = addslashes($test_field);
	$field_query = sql_query("select $field from events where series_id=$id and $field != '$test_field'");
	$test_field = stripslashes($test_field);
	if (!$field_query) {
		return $test_field;
	} else {
		return NULL;
	}
}






$events[0][title] = check_field ("title", $event_info);

$events[0][btime] = check_field ("btime", $event_info);

$events[0][body] = check_field ("body", $event_info);

$events[0][url] = check_field ("url", $event_info);

$events[0][cost] = check_field ("cost", $event_info);

$events[0][contact_name] = check_field ("contact_name", $event_info);

$events[0][contact_email] = check_field ("contact_email", $event_info);

$events[0][contact_phone] = check_field ("contact_phone", $event_info);

$events[0][loc_name] = check_field ("loc_name", $event_info);

$events[0][loc_address] = check_field ("loc_address", $event_info);

$events[0][loc_address2] = check_field ("loc_address2", $event_info);

$events[0][image_id] = check_field ("image_id", $event_info);

$events[0][category] = check_field ("category", $event_info);


$smarty->assign('events', $events);
$smarty->assign('series_id', $id);
$smarty->assign('edit_type', "series");
$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('action', "series_edit");
$smarty->display('series_form.tpl.html');



mysql_close();
?>