<?php

class PlayerDAOTest extends PHPUnit_Framework_TestCase {
  
  /**
   * 
   */
  public function testGetAPIFieldAssignment() {
    // test 1 - operation eq, value 1
    $operation = "eq";
    $value = 1;
    $result = PlayerDAO::getAPIFieldAssignment($operation, $value);
    $this->assertEquals(" = 1", $result);
  }
}

?>