<?php

class ConfigDAO {
	const GET_CONFIG_SQL = "select * from config";
	const UPDATE_CONFIG_SQL = "update config set value = '%s' where variable = '%s' and category = '%s'";
	
	public static function getConfiguration() {
		$config = array();
		$configResult = @mysqli_query(self::GET_CONFIG_SQL);
		if ($configResult) {
			$count = mysqli_num_rows($configResult);
			for ($i = 0; $i < $count; $i++) {
				$row = mysqli_fetch_assoc($configResult);
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
	
	public static function saveConfiguration($configArray) {
		foreach($configArray as $categoryName => $category) {
			foreach($category as $valueName => $value) {
				$data = DBUtils::escapeData(array($value, $valueName, $categoryName));
				$query = vsprintf(self::UPDATE_CONFIG_SQL, $data);
				$result = @mysqli_query($query);
				if (!$result) {
					throw new Exception("Error saving configuration - " . mysqli_error());
				}
			}
		}
	}
}

?>