<?php

/**
 * Formatear un numero decimal en formato de argentina (123.456,78)
 *
 */

if (! function_exists('dec')) {
	function dec($number)
	{
		$number = is_null($number) ? 0.0 : $number;

		return is_numeric($number) ? number_format($number, 2, ',', '.') : $number;
	}
}
