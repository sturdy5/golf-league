<?php

require_once 'RestAPI.php';
require_once 'requires.inc.php';

class LeagueAPI extends RestAPI {

  public function __construct($request, $origin) {
    parent::__construct($request);

    // TODO implement an api key verification mechanism

    if (!array_key_exists('apiKey', $this->request)) {
      // check to see if the key was posted in the header
      if (!array_key_exists('HTTP_X_APIKEY', $_SERVER)) {
        throw new Exception('No API Key provided');
      }
    } 
    // add an else here that validates the key
    // then add another else that runs if everything is ok that will get the user and assign it to $this->user
  }

  /**
   * Example of an endpoint
   */
  protected function example($args) {
    if ($this->method == 'GET') {
      $result = array("message" => "You did a GET to figure out this example", "args" => $args);
      return $result;
    } else {
      return 'method unavailable';
    }
  }
  
  protected function players($args) {
    $allPlayers = false;
    // if the all_players value was provided, then toggle the indicator
    if (array_key_exists("all_players", $this->request)) {
      $allPlayers = (strtolower($this->request["all_players"]) === "true");
    }
    // let's see if we can put together some criteria
    // start with the id. If the id exists then we can skip everything else
    if (array_key_exists("id", $this->request)) {
      $searchId = $this->request["id"];
      
    }
  }
}

?>
