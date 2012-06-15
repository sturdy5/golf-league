<?php

class ArrayUtils {
	
	public static function getAssociativeArrayByNumber($array, $index) {
		$counter = -1;
		foreach ($array as $item) {
			$counter++;
			if ($counter == $index) {
				return $item;
			}
		}
		return FALSE;
	}
	
	public static function getAssociativeArrayKeyByNumber($array, $index) {
		$keysArray = array_keys($array);
		return $keysArray[$index];
	}
	
	public static function createDateRangeArray($strDateFrom,$strDateTo) {
		// takes two dates formatted as YYYY-MM-DD and creates an
		// inclusive array of the dates between the from and to dates.
	
		// could test validity of dates here but I'm already doing
		// that in the main script
	
		$aryRange=array();
	
		$iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
		$iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));
	
		if ($iDateTo>=$iDateFrom) {
			array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
	
			while ($iDateFrom<$iDateTo) {
				$iDateFrom+=86400; // add 24 hours
				array_push($aryRange,date('Y-m-d',$iDateFrom));
			}
		}
		return $aryRange;
	}
	
}

?>