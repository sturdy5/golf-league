<?php

class ConfigDAO {
	const GET_CONFIG_SQL = "select * from config";
	
	public static function getConfiguration() {
		$config = array();
		$configResult = @mysql_query(self::GET_CONFIG_SQL);
		if ($configResult) {
			$count = mysql_num_rows($configResult);
			for ($i = 0; $i < $count; $i++) {
				$row = mysql_fetch_assoc($configResult);
				$category = $row["category"];
				$name = $row["name"];
				$value = $row["value"];
				$variable = $row["variable"];
				if (!isset($config[$category])) {
					$config[$category] = array();
				}
				$config[$category][$variable] = array();
				$config[$category][$variable]["name"] = $name;
				$config[$category][$variable]["value"] = $value;
			}
		}
		return $config;
	}
}