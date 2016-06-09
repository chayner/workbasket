<? 

$rand_thumb = sql_query("select id from photos where category = 8 order by rand() limit 1");
$smarty->assign("rand_thumb", $rand_thumb[0]['id']);
 
//-------------------------------------------------------------------------------------------------//

//===============================================================//
// Events														 //
//===============================================================// 

$today=getdate(time());

$today_year=$today["year"];
$today_month=$today["mon"];

if (!$month)  {
	$currm=$today["mon"];
	$month = $currm;
} else {
	$currm = $month;
}

if (!$year) {
	$curry=$today["year"];
	$year = $curry;
} else {
	$curry=$year;
}

if ($currd==0) {
	$currd=$today["mday"];
}

$smarty->assign('month', $month);


$current_date = $month."/01/".$year; 
$smarty->assign('monthfill', $current_date);

//===============================================================//
// Upcoming Events												 //
//===============================================================// 

$start = "$today[month] $today[mday], $today[year]";
$upcoming = array();
$flag = 0;
for ($i=0; $i<7; $i++) {
	$curdate = date("Y-m-d", strtotime("$start +$i day"));
	$chk_date = sql_query("select id, title, btime, owner from events where bdate = '$curdate' $event_filter order by btime");
	if ($chk_date) {
		$upcoming[$flag] = $chk_date;
		$upcoming[$flag][date] = $curdate;
		$flag++;
	}
}
$smarty->assign('upcoming', $upcoming);

//=======================================================//
// Event URL Strings										
//=======================================================//

	if ($month == "1") {
		$prev_year = $year-1;
		$previous_url = "year=$prev_year&month=12";
		$next_url = "year=$year&month=2";
	} elseif ($month == "12") {
		$next_year = $year+1;
		$next_url = "year=$next_year&month=1";
		$previous_url = "year=$year&month=11";
	} else {
	 	$prev_month = $month-1;
		$next_month = $month+1;
		$previous_url = "year=$year&month=$prev_month";
		$next_url = "year=$year&month=$next_month";
	}
	
		
	$prev_month = $display_month-1;
	$next_month = $display_month+1;


$smarty->assign('nextmonth', "$PHP_SELF?$next_url$url_filler");
$smarty->assign('prevmonth', "$PHP_SELF?$previous_url$url_filler");
$smarty->assign('curmonth', "$PHP_SELF?$url_filler");


//===============================================================//
// Email Forms													 //
//===============================================================// 

function maillist_send($subject, $message, $to, $from) {
	/* headers */
	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	$headers .= "From: $from <$from>\n";
	$headers .= "To: ".$to."\n";
	
	$message=ereg_replace(10,"\n",$message);
	$message=stripslashes($message);
	$subject=stripslashes($subject);
	$finalmessage = "<html>
						<head>
						 <title>$subject</title>
						</head>
					 <body>$message</body></html>";


	if (mail("$from", "$subject", "$finalmessage", "$headers")) {
		$feedback = "Message successfully sent.";
	} else {
		$feedback = "There was an error with your message.";
	}
	
	return $feedback;
}
//===============================================================//
// Latest News													 //
//===============================================================//

$latestnews = sql_query("select * from news where deleted_p = 0 $cur_min_filter order by date desc limit 5");
$smarty->assign('latestnews', $latestnews);	


//===============================================================//
// Random Photos												 //
//===============================================================//

$rand_photo_query = sql_query("select id, caption, category, owner from photos where deleted_p=0 order by rand() limit 3");
$smarty->assign('rand_photos', $rand_photo_query);

// Public Functions


function pic_in_cat($cat) {
	global $module;

	// See if there are any images within that category
	$category_thumbs = db_query("select p.id as id, c.name as name from photos as p, categories as c where c.id = $cat and p.category = c.id and c.module='$module' order by rand() limit 1") or die(mysql_error());
	$number = db_numrows($category_thumbs);

	// If there is, display the image and the name of the category
	if ($number > 0) {
		list($id, $name) = db_fetch_array($category_thumbs);
		echo "<p>Found image in $name</p>";
		$flag = "1";
	// If not, search in one of the random children directories.
	} else {
		echo "<p>FLAG: $flag</p>";
		$children = db_query("select id from categories where parent = $cat and module='$module'");
		if (db_numrows($children) > 0) {		
			
			while(list($id) = db_fetch_array($children) && $flag == '0') {
				echo "<p>Testing $id (child of $cat)...</p>";
				pic_in_cat($id);
			}
		}
	}
}

function find_thumb($cat, $parent_id = "") {
	global $module;
	
	// See if there are any images within that category
	$category_thumb = sql_query("select * from photos where category = $cat order by rand() limit 1");
	
	// If there is, display the image and the name of the category
	if ($category_thumb) {
		return $category_thumb;
	// If not, search in one of the random children directories.
	} else {
			$parent_id = $cat;
			$children = db_query("select c.id from categories as c, photos as p where c.parent = $parent_id and p.category = c.id order by rand() limit 1");
			if (db_numrows($children) > 0) {		
				list($id) = db_fetch_array($children);
				find_thumb($id, $parent_id);
			} else {
				echo "No photos found.";
			}
			
	}
}

function insert_find_thumb($cat) {
	$catname = $cat[catname];
	return find_thumb($cat[cat], $catname, $cat[cat]);
}

function parent_trail($cat, $trail="") {
	global $module;
	
	// Find parent of category
	$parent_query = db_query("select id, name, parent from categories where module='$module' and id = $cat");
	list($id, $name, $parent) = db_fetch_array($parent_query);


	if ($parent == '0') {
		$trail = "<a href=photos.php?cat=$id>$name</a>".$trail;	
		echo $trail;
	} else {
		$trail = " > <a href=photos.php?cat=$id>$name</a>".$trail;	
		parent_trail($parent, $trail);
	}
}

function insert_parent_trail($cat) {
	return parent_trail($cat[id]);
}

$randnum = rand(1,7);
$smarty->assign('randnum', $randnum);

$upcoming = sql_query("select * from events where bdate >= now() order by bdate limit 3");
$smarty->assign('upcoming', $upcoming);
$smarty->register_modifier("sslash","stripslashes");
$smarty->register_modifier("aslash","addslashes");

?>