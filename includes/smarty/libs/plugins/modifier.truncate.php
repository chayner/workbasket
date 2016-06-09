<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty truncate modifier plugin
 *
 * Type:     modifier<br>
 * Name:     truncate<br>
 * Purpose:  Truncate a string to a certain length if necessary,
 *           optionally splitting in the middle of a word, and
 *           appending the $etc string.
 * @link http://smarty.php.net/manual/en/language.modifier.truncate.php
 *          truncate (Smarty online manual)
 * @param string
 * @param integer
 * @param string
 * @param boolean
 * @return string
 */
		function strallpos($haystack, $needle, $offset=0, $count=NULL) {
		  if ($offset > strlen($haystack)) trigger_error("strallpos(): Offset not contained in string.", E_USER_WARNING);
		  $match = array();
		  for ($count=0; (($pos = strpos($haystack, $needle, $offset)) !== false); $count++) {
		   $match[] = $pos;
		   $offset = $pos + strlen($needle);
		  }
		  return $match;
		} 

function smarty_modifier_truncate($string, $length = 80, $etc = '...',
                                  $break_words = false)
{
    if ($length == 0)
        return '';


    if (strlen($string) > $length) {

		$string = substr($string, 0, $length);
		
		// Check for tags right before end
		$open_tags = strallpos($string, "<a");
		$close_tags = strallpos($string, "</a>");
		
		if (count($open_tags) > 0) {
			if (count($open_tags) > count($close_tags)) {
				$open_tag = array_pop($open_tags);
				$string = substr($string, 0, $open_tag);
			} else {
				$close_tag = array_pop($close_tags);
			} 
		}

		$string_end = strrpos($string, '.');
				
		if ($close_tag > $string_end) {
			$string = substr($string, 0, $close_tag+4);			
		} else {
			$string = substr($string, 0, $length);
		}
			
		return $string;
    } else
        return $string;
}

/* vim: set expandtab: */

?>
