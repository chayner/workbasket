<? // Event Module

function event_add($title, $body, $cost, $bdate, $btime, $url, $contact_name, $contact_email, $contact_phone, $loc_name, $loc_address, $loc_address2, $image_id, $caption, $category, $owner) {
    //Confirm that all required variables are present
    if (!$title) {
        return "You must enter information in Title and Summary.";
    }
       	$newbtime = date('H:i:s',strtotime($btime));
		$newbdate = date('Y-m-d',strtotime($bdate));
		
	if ($url && strpos($url,"http") === false) {
			$url = "http://".$url;
		}
	
    $sql = "INSERT INTO events (id,
								title,
								body,
								cost,
								bdate,
								btime,
								url,
								contact_name,
								contact_email,
								contact_phone,
								loc_name,
								loc_address,
								loc_address2,
								image_id, 
								caption,
								category,
								owner,
								created_on)
                        VALUES ('$id',
								'$title',
								'$body',
								'$cost',
								'$newbdate',
								'$newbtime',
								'$url',
								'$contact_name',
								'$contact_email',
								'$contact_phone',
								'$loc_name',
								'$loc_address',
								'$loc_address2',
								'$image_id',
								'$caption',
								'$category',
								'$owner',
								now())";
    $result = db_query($sql) or die ("Event add error: ". mysql_error());
    if ($result == 1) {
         $result = "Event succesfully added.";
    }
    return $result;
}

function event_edit($id, $title, $body, $cost, $bdate, $btime, $url, $contact_name, $contact_email, $contact_phone, $loc_name, $loc_address, $loc_address2, $image_id, $caption, $category, $owner) {
    // Check to make sure all variables have been passed.
    if ($id) {
       // If valid, update user information according to user_id.
       	$newbtime = date('H:i:s',strtotime($btime));
		$newbdate = date('Y-m-d',strtotime($bdate));
	
	if ($url && strpos($url,"http") === false) {
			$url = "http://".$url;
		}
		
	   $sql = "update events set title='$title',
								 body='$body',
								 cost='$cost',
								 bdate='$newbdate',
								 btime='$newbtime',
								 url='$url',
								 contact_name='$contact_name',
								 contact_email='$contact_email',
								 contact_phone='$contact_phone',
								 loc_name='$loc_name',
								 loc_address='$loc_address',
								 loc_address2='$loc_address2',
								 image_id='$image_id',
								 caption='$caption',
								 category='$category',
								 owner='$owner',
								 created_on=now()
                         where id=$id";
       $result = db_query($sql) or die ("Events modify error: ". mysql_error());
       if ($result == 1) {
           $result = "Event successfully modified.";
       }
       return $result;

    } else {
        return "Error with modify.  Please try again.";
    }
}

function event_delete($event_id) {
    // Check and see if the event exists.
    if ($event_id != "") {
       $result = db_query("select id
                             from events
                            where id=$event_id")
                           or die("Event check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return "Event does not exists.";
       }

       // If not, delete event from table.
       $sql = "DELETE FROM events
                     WHERE id=$event_id
                     LIMIT 1";
       $result = db_query($sql) or die ("Event delete error: ". mysql_error());
       if ($result == 1) {
           $result = "Event succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing event.";
    }
}

function series_add($event_id, $fmonth, $fday, $fyear, $rectype, $recurring_period, $daily, $dow, $month_or_week, $wom, $m_increment, $w_increment, $owner) {

	// Delete former event
	if ($event_id) {
		$sql = "delete from events where id=$event_id";
    	$result = db_query($sql) or die ("Series event delete error: ". mysql_error());
	}


	// Create a series entry in event_series
	    
    $sql = "INSERT INTO event_series (fmonth,
								fday,
								fyear,
								rectype,
								recurring_period,
								daily,
								dow,
								month_or_week,
								wom,
								m_increment,
								w_increment,
								owner,
								created_on)
                        VALUES ('$fmonth',
								'$fday',
								'$fyear',
								'$rectype',
								'$recurring_period',
								'$daily',
								'$dow',
								'$month_or_week',
								'$wom',
								'$m_increment',
								'$w_increment',
								'$owner',
								now())";
    $result = db_query($sql) or die ("Event add error: ". mysql_error());
	
	$series_query = sql_query("select id from event_series order by id desc limit 1");
	$new_series_id = $series_query[0][id];
	
	return $new_series_id;
}

function series_edit($id, $fmonth, $fday, $fyear, $rectype, $recurring_period, $daily, $dow, $month_or_week, $wom, $m_increment, $w_increment, $owner) {

	   $sql = "update event_series set fmonth='$fmonth',
								 	  fday='$fday',
								 fyear='$fyear',
								 rectype='$rectype',
								 recurring_period='$recurring_period',
								 daily='$daily',
								 dow='$dow',
								 month_or_week='$month_or_week',
								 wom='$wom',
								 m_increment='$m_increment',
								 w_increment='$w_increment',
								 owner='$owner',
								 created_on=now()
                         where id=$id";
       $result = db_query($sql) or die ("Events modify error: ". mysql_error());
		
		return $id;
}

function delete_series_events($series_id) {
	// delete the original event if it exists
	if ($series_id) {
		$sql = "delete from events where series_id=$series_id";
    	$result = db_query($sql) or die ("Series event delete error: ". mysql_error());
	}
}

function add_series_events($title, $series_id) {

	$series = sql_query("select * from event_series where id=$series_id limit 1");

	$series = $series[0];
	
	$nextd = $series[fday];
	$nextm = $series[fmonth];
	$nexty = $series[fyear];
	
	$rectype = $series[rectype];
	$recurring_period = $series[recurring_period];
	$daily = $series[daily];
	$dow = unserialize($series[dow]);
	$month_or_week = $series[month_or_week];
	$wom = $series[wom];
	$m_increment = $series[m_increment];
	$w_increment = $series[w_increment];
	

	// Create new event entries
	if ($rectype == "one_time") {
		$next_date = date('Y-m-d',mktime(0,0,0,$nextm,$nextd,$nexty));
			$sql = "INSERT INTO events (title, bdate, series_id) VALUES ('$title', '$next_date', $series_id)";
			$result = db_query($sql) or die ("One time insert error:  ".mysql_error());
	}
	
	elseif ($rectype == "yearly") {
		for ($i = 1; $i <= $recurring_period; $i++) 
		{
			$next_date = date('Y-m-d',mktime(0,0,0,$nextm,$nextd,$nexty));
			$sql = "INSERT INTO events (title, bdate, series_id) VALUES ('$title', '$next_date', $series_id)";
			$result = db_query($sql) or die ("Yearly insert error:  ".mysql_error());
			$nexty = $nexty + 1;
			
		}
	}
	
	elseif ($rectype == "monthly") {
		for ($i = 1; $i <= $recurring_period; $i++) 
		{
			$next_date = date('Y-m-d',mktime(0,0,0,$nextm,$nextd,$nexty));
			$sql = "INSERT INTO events (title, bdate, series_id) VALUES ('$title', '$next_date', $series_id)";
			$result = db_query($sql) or die ("Monthly insert error:  ".mysql_error());
			$nextm = $nextm + 1;
		}
	}
	elseif ($rectype == "daily") 
	{
	
		if ($daily == "all_days")
		{ 
			for ($i = 1; $i <= $recurring_period; $i++) 
			{
				$next_date = date('Y-m-d',mktime(0,0,0,$nextm,$nextd,$nexty));
				$sql = "INSERT INTO events (title, bdate, series_id) VALUES ('$title', '$next_date', $series_id)";
				$result = db_query($sql) or die ("Daily: all days insert error:  ".mysql_error());
				$nextd = $nextd + 1;
				
			}
		}
		elseif ($daily == "weekdays") 
		{
			$i = 1;
			while ($i <= $recurring_period)
			{
				$dayofweek = date('l', mktime(0,0,0,$nextm,$nextd,$nexty));
				
				if ($dayofweek != "Saturday" && $dayofweek != "Sunday")
				{	
					$next_date = date('Y-m-d',mktime(0,0,0,$nextm,$nextd,$nexty));
					$sql = "INSERT INTO events (title, bdate, series_id) VALUES ('$title', '$next_date', $series_id)";
					$result = db_query($sql) or die ("Daily: weekdays insert error:  ".mysql_error());
					$i++;
				}
				$nextd = $nextd + 1;
				
			}
		}
		elseif ($daily == "weekends") 
		{
			$i = 1;
			while ($i <= $recurring_period)
			{
				$dayofweek = date('l', mktime(0,0,0,$nextm,$nextd,$nexty));
				
				if ($dayofweek == "Saturday" || $dayofweek == "Sunday")
				{	
					$next_date = date('Y-m-d',mktime(0,0,0,$nextm,$nextd,$nexty));
					$sql = "INSERT INTO events (title, bdate, series_id) VALUES ('$title', '$next_date', $series_id)";
					$result = db_query($sql) or die ("Daily: Weekends insert error:  ".mysql_error());
					$i++;
				}
				$nextd = $nextd + 1;
				
			}
		}
	}
	elseif ($rectype == "weekly")
	{
		$i = 1;
		while ($i <= $recurring_period)
		{
			$dayofweek = date('w', mktime(0,0,0,$nextm,$nextd,$nexty));
			for ($j=0; $j < count($dow); $j++)
			{
				if ($dayofweek >= $dow[$j])
				{
					if ($dayofweek == $dow[$j])
					{	
						$next_date = date('Y-m-d',mktime(0,0,0,$nextm,$nextd,$nexty));
						$sql = "INSERT INTO events (title, bdate, series_id) VALUES ('$title', '$next_date', $series_id)";
						$result = db_query($sql) or die ("Daily: same days insert error:  ".mysql_error());
						$i++;
						break;
					}
				} else {
					break;
				}
			}
			
			$nextd = $nextd + 1;
			
		}
	}
	elseif ($rectype == "same_day") 
	{
		if ($month_or_week == "m")
		{
			$dayofweek = date('w', mktime(0,0,0,$nextm,$nextd,$nexty));
			$startofweek = (($wom * 7) - 6);
			
			if ($startofweek+6 < $nextd) {
				$nextm = $nextm + 1;
			}
			
			$i = 1;
			while ($i <= $recurring_period)
			{	
				$nextd = $startofweek; 
				for ($j=1; $j <= 7; $j++)
				{
					$testdate = date('l, F j, Y',mktime(0,0,0,$nextm,$nextd,$nexty));
					if (date('w', strtotime($testdate)) == $dayofweek) 
					{
						$next_date = date('Y-m-d',mktime(0,0,0,$nextm,$nextd,$nexty));
						$sql = "INSERT INTO events (title, bdate, series_id) VALUES ('$title', '$next_date', $series_id)";
						$result = db_query($sql) or die ("Same Day: monthly insert error:  ".mysql_error());
							
						$i++;
						break;
					}
					$nextd = $nextd + 1;
				}
				$nextm = $nextm + $m_increment;
				
			}
		}
		elseif ($month_or_week == "w")
		{
			for ($i = 1; $i <= $recurring_period; $i++) 
			{
				
				$next_date = date('Y-m-d',mktime(0,0,0,$nextm,$nextd,$nexty));
				$sql = "INSERT INTO events (title, bdate, series_id) VALUES ('$title', '$next_date', $series_id)";
				$result = db_query($sql) or die ("Same Day: weekly insert error:  ".mysql_error());
				
				$nextd = $nextd + (7 * $w_increment);
			}
		}
	}
	
	if ($result) {
		return true;
	}
}

function edit_series_events ($series_id, $title, $body, $cost, $btime, $url, $contact_name, $contact_email, $contact_phone, $loc_name, $loc_address, $loc_address2, $image_id, $caption, $category, $owner, $title_p, $body_p, $cost_p, $btime_p, $url_p, $cname_p, $cemail_p, $cphone_p, $lname_p, $ladd_p, $ladd2_p, $image_p, $category_p) {

       // If valid, update user information according to user_id.
       	$newbtime = date('H:i:s',strtotime($btime));
		
		if ($url && strpos($url,"http") === false) {
			$url = "http://".$url;
		}
		
		if ($title_p) {
			$title_fill = "title='$title',";
		}
		if ($btime_p) {
			$btime_fill = "btime='$newbtime',";
		}
		if ($body_p) {
			$body_fill = "body='$body',";
		}
		if ($cost_p) {
			$cost_fill = "cost='$cost',";
		}
		if ($cname_p) {
			$cname_fill = "contact_name='$contact_name',";
		}
		if ($url_p) {
			$url_fill = "url='$url',";
		}
		if ($cemail_p) {
			$cemail_fill = "contact_email='$contact_email',";
		}
		if ($cphone_p) {
			$cphone_fill = "contact_phone='$contact_phone',";
		}
		if ($lname_p) {
			$lname_fill = "loc_name='$loc_name',";
		}
		if ($ladd_p) {
			$ladd_fill = "loc_address='$loc_address',";
		}
		if ($ladd2_p) {
			$ladd2_fill = "loc_address2='$loc_address2',";
		}
		if ($image_p) {
			$image_fill = "image_id='$image_id',";
		}
		if ($category_p) {
			$cat_fill = "category='$category',";
		}
		
	   $sql = "update events set $title_fill 
	   							 $body_fill
								 $cost_fill
								 $btime_fill
								 $url_fill
								 $cname_fill
								 $cemail_fill
								 $cphone_fill
								 $lname_fill
								 $ladd_fill
								 $ladd2_fill
								 $image_fill
								 $cat_fill
								 owner='$owner',
								 created_on=now()
                         where series_id=$series_id";
       $result = db_query($sql) or die ("Events modify error: ". mysql_error());
       if ($result == 1) {
           $result = "Event successfully modified.";
       }
       return $result;
	   
}

function series_delete ($sid) {

	$delete_events = db_query("delete from events where series_id = '$sid'") or die ("Series Event delete error:  ".mysql_error());
	$delete_series = db_query("delete from event_series where id = '$sid'") or die ("Series delete error:  ".mysql_error());
	
	if ($delete_events && $delete_series) {
		return "Series successfully deleted.";
	} else {
		return "series not deleted.";
	}

}

	

?>