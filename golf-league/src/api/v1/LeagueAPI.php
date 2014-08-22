<?php

require_once 'RestAPI.php';
class LeagueAPI extends RestAPI {
  protected $user;

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
  protected function example() {
    if ($this->method == 'GET') {
      return 'you did a get to figure out this example';
    } else {
      return 'method unavailable';
    }
  }
}

?>
