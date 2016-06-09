<?
$module=2;
include("../events/functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");


if ($action == "add") {
	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}

	$feedback = event_add($title, $body, $cost, $bdate, $btime, $url, $contact_name, $contact_email, $contact_phone, $loc_name, $loc_address, $loc_address2,  $image_id, $caption, $category, $section_s);

} elseif ($action == "edit") {
	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}
	
	if ($source_file) {
		$image_id = image_upload($source_file, $source_filename, $caption);
	} else {
		$image_id = $image;
	}
	
	$feedback = event_edit($id, $title, $body, $cost, $bdate, $btime, $url, $contact_name, $contact_email, $contact_phone, $loc_name, $loc_address, $loc_address2, $image_id, $caption, $category, $section_s);

} elseif ($action == "delete") {
	
	$feedback = event_delete($id);

} elseif ($action == "series_add") {

	$series_id = series_add($event_id, $fmonth, $fday, $fyear, $rectype, $recurring_period, $daily, serialize($dow), $month_or_week, $wom, $m_increment, $w_increment, $section_s);
	$add_events_result = add_series_events($title, $series_id);
	
	if ($new_cat_name && $category_p) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}
	
	if ($source_file) {
		$image_id = image_upload($source_file, $source_filename, $caption);
	} else {
		$image_id = $image;
	}
	
	$feedback = edit_series_events($series_id, $title, $body, $cost, $btime, $url, $contact_name, $contact_email, $contact_phone, $loc_name, $loc_address, $loc_address2,  $image_id, $caption, $category, $section_s, $title_p, $body_p, $cost_p, $btime_p, $url_p, $cname_p, $cemail_p, $cphone_p, $lname_p, $ladd_p, $ladd2_p, $image_p, $category_p);
	
} elseif ($action == "series_edit") {
	if ($structure_change) {
		$series_id = series_edit($series_id, $fmonth, $fday, $fyear, $rectype, $recurring_period, $daily, serialize($dow), $month_or_week, $wom, $m_increment, $w_increment, $section_s);
		$delete_events_result = delete_series_events($series_id);		
		$add_events_result = add_series_events($title, $series_id);
	}
	
	if ($new_cat_name && $category_p) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}

	if ($source_file) {
		$image_id = image_upload($source_file, $source_filename, $caption);
	} else {
		$image_id = $image;
	}

	$feedback = edit_series_events($series_id, $title, $body, $cost, $btime, $url, $contact_name, $contact_email, $contact_phone, $loc_name, $loc_address, $loc_address2,  $image_id, $caption, $category, $section_s, $title_p, $body_p, $cost_p, $btime_p, $url_p, $cname_p, $cemail_p, $cphone_p, $lname_p, $ladd_p, $ladd2_p, $image_p, $category_p);

} elseif ($action == "series_delete") {
	
	$feedback = series_delete($id);
}

header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");

?>