<?php
namespace app\components;

/**
 * Utility class file
 *
 * Contains many function that most used
 */

class Utility
{
	public static function rupiah($nominal) {
		 $rupiah =  number_format($nominal,0, ",",".");
		 $rupiah = "Rp "  . $rupiah . ",00";
		 return $rupiah;
	}
}

?>