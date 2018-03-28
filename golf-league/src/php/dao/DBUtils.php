<?php
class DBUtils {
	
	public static function escapeData($data) {
		$temp = array();
				
		foreach($data as $item){
			array_push($temp, mysqli_real_escape_string($item));
		}
		
		return $temp;
	}
}
?>