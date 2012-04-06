<?php

require_once("lib/pluralize.php");

// Smarty plugins.

function smarty_modifier_pluralize($string)
{
    return \pangolin\Inflect::pluralize($string);
}