<?php

/**
 * Takes a value and checks if it is a Closure or not, if it is it
 * will return the result of the closure, if not, it will simply return the
 * value.
 *
 * @param mixed $var The value to get
 * @return mixed
 */
function value($var)
{
	return ($var instanceof Closure) ? $var() : $var;
}

/**
 * A case-insensitive version of in_array.
 *
 * @param mixed $needle
 * @param array $haystack
 * @return bool
 */
function in_arrayi($needle, $haystack)
{
	return in_array(strtolower($needle), array_map('strtolower', $haystack));
}

/**
 * Encodes the given string.  This is just a wrapper function for Security::htmlentities()
 *
 * @param mixed $string The string to encode
 * @return string
 */
function e($string)
{
	return Core\Security::htmlEntities($string);
}

/**
 * A wrapper function for Lang::get()
 *
 * @param mixed $string The string to translate
 * @param array $params The parameters
 * @param string $default The default value, if not found
 * @return string
 */
function __($string, $params = array(), $default = null)
{
	return Core\Lang::get($string, $params, $default);
}