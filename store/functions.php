<?
db_connect();
session_start();



//------------------------------------------//
//  Do not edit anything down here.			//
//------------------------------------------//

function item_in_cat($cat) {
	global $module;

	// See if there are any images within that category
	$category_thumbs = db_query("select m.id as id, c.name as name from merchandise as m, categories as c where c.id = $cat and m.category = c.id and c.module='$module' order by rand() limit 1") or die(mysql_error());
	$number = db_numrows($category_thumbs);

	// If there is, display the image and the name of the category
	if ($number > 0) {
		list($id, $name) = db_fetch_array($category_thumbs);
		echo "<p>Found items in $name</p>";
		$flag = "1";
	// If not, search in one of the random children directories.
	} else {
		$children = db_query("select id from categories where parent = $cat and module='$module'");
		if (db_numrows($children) > 0) {		
			
			while(list($id) = db_fetch_array($children) && !$flag) {
				echo "<p>Testing $id (child of $cat)...</p>";
				item_in_cat($id);
			}
		}
	}
}

function find_item($cat, $catname, $parent_id) {
	global $module;
	// See if there are any images within that category
	$category_thumbs = db_query("select m.id as id, m.name as name, c.name as caption from merchandise as m, categories as c where c.id = $cat and m.category = c.id and c.module='$module' order by rand() limit 1") or die(mysql_error());
	$number = db_numrows($category_thumbs);

	// If there is, display the image and the name of the category
	if ($number > 0) {
		list($id, $name, $caption) = db_fetch_array($category_thumbs);
		if ($caption) {
			$caption = "[ ".$caption." ]";
		}
		$caption = addslashes($caption);
		echo "<p class=leftbarcategory><a href=/store/index.php?cat=$parent_id><img src=\"/photos/merch_".$id.".jpg\" border=0 width=150></a><br><a href=/store/index.php?cat=$parent_id>$catname</a></p>";
	// If not, search in one of the random children directories.
	} else {
			$children = db_query("select c.id from categories as c, merchandise as m where c.parent = $cat and m.category = c.id order by rand() limit 1");
			if (db_numrows($children) > 0) {		
				list($id) = db_fetch_array($children);
				find_item($id, $catname, $parent_id);
			}
	}
}

function insert_find_item($cat) {
	$catname = $cat[catname];
	return find_item($cat[cat], $catname, $cat[cat]);
}

function store_trail($cat, $trail="") {
	global $module;
	
	// Find parent of category
	$parent_query = db_query("select id, name, parent from categories where module='$module' and id = $cat");
	list($id, $name, $parent) = db_fetch_array($parent_query);

	if ($parent == '0') {
		$trail = "<a href=index.php?cat=$id>$name</a>".$trail;	
		echo $trail;
	} else {
		$trail = " > <a href=index.php?cat=$id>$name</a>".$trail;	
		store_trail($parent, $trail);
	}
}

function insert_store_trail($cat) {
	return store_trail($cat[id]);
}

$smarty->register_modifier("sslash","stripslashes");
$smarty->register_modifier("aslash","addslashes");

