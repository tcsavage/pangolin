<?php

require_once("lib/pluralize.php");

// Smarty plugins.

function smarty_modifier_pluralize($string, $count = 0)
{
    return ($count == 1) ? $string : \pangolin\Inflect::pluralize($string);
}