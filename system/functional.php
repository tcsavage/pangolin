<?php namespace pangolin;

function compose(&$f, &$g)
{
	// Return the composed function
	return function() use($f,$g) {
		// Get the arguments passed into the new function
		$x = func_get_args();
		// Call the function to be composed with the arguments
		// and pass the result into the first function.
		return $f(call_user_func_array($g, $x));
	};
}

// Convenience wrapper for mapping
function map(&$data, &$f)
{
	return array_map($f, $data);
}

// Convenience wrapper for filtering arrays
function filter(&$data, &$f)
{
	return array_filter($data, $f);
}

// Convenience wrapper for reducing arrays
function fold(&$data, &$f)
{
	return array_reduce($data, $f);
}