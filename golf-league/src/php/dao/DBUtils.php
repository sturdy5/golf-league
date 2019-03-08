<?php
class DBUtils {

    private static $instance = null;
    private $link = null;

    private function __construct() {
        // database configuration
        $db_server = "107.180.51.10";
        $db_user = "bcbsscgl";
        $db_password = "hnTCZXEN2Ab6tb";
        $db_database = "bcbsscgl";

        // setup the database
        $this->link = mysqli_connect($db_server, $db_user, $db_password) or die ("Could not connect to the database");
        mysqli_select_db($this->link, $db_database) or die ("Could not select the database");
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new DBUtils();
        }
        return self::$instance;
    }

    public function query($query) {
        return @mysqli_query($this->link, $query);
    }

    public function getRowCount($result) {
        return mysqli_num_rows($result);
    }

    public function getRowAffectedCount() {
        return mysqli_affected_rows($this->link);
    }

    public function getRow($result) {
        return mysqli_fetch_assoc($result);
    }

    public function getError() {
        return mysqli_error($this->link);
    }

    public function getLastInsertId() {
        return mysqli_insert_id($this->link);
    }
    
    public function escapeData($data) {
        $temp = array();
                
        foreach($data as $item){
            array_push($temp, mysqli_real_escape_string($this->link, $item));
        }
        
        return $temp;
    }
}
?>
