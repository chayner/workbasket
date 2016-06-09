<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     modifier
 * Name:     strip_tags
 * Purpose:  strip html tags from text
 * -------------------------------------------------------------
 */
function smarty_modifier_strip_fontface($string)
{
	$result = preg_replace('/<([^<]*?)face="?.*?"?>/i', '<\\1>', $string);
	$result1 = preg_replace('/<([^<]*?)size="?.*?"?>/i', '<\\1>', $result);
	$result2 = preg_replace('/<font\\s*?>(.*?)<\/font>/i', '\\1', $result1);
	return preg_replace('/<font\\s*?>(.*?)<\/font>/i', '\\1', $result2);
	
}

/* vim: set expandtab: */

?>
