<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     modifier
 * Name:     strip_tags
 * Purpose:  strip html tags from text
 * -------------------------------------------------------------
 */
function smarty_modifier_strip_fonts($string, $leave_color = false)
{
    if ($leave_color)
		return preg_replace('/<(\/?)(font)[^>]*?color="?#?(\\d{6})"*?>(.*?)<\/\\2>/i', '<\\2 color="#\\3">\\4<\\2>', $string);
    else
		return preg_replace('/ ?<\/?font[^>]*?> ?/', '', $string);
}

/* vim: set expandtab: */

?>
