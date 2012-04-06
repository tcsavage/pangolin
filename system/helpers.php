<?php namespace pangolin;

function debugMsg($msg)
{
	global $warninglevel;
	if ($warninglevel >= 3)
	{
		echo("DEBUG: " . $msg . "\n");
	}
}