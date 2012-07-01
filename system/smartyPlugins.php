<?php

require_once("lib/pluralize.php");

// Smarty plugins.

function smarty_modifier_pluralize($string, $count = 0)
{
    return ($count == 1) ? $string : \pangolin\Inflect::pluralize($string);
}

function smarty_modifier_shrink($string, $size)
{
	return (strlen($string) > $size) ? substr($string, 0, $size) . "..." : $string;
}