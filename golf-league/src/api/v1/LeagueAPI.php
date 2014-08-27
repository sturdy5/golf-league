<?php

require_once 'RestAPI.php';
require_once 'requires.inc.php';

class LeagueAPI extends RestAPI {
  
  /**
   * Stores the default value of the per page attribute
   */
  public $DEFAULT_PER_PAGE = 50;
  
  /**
   * Stores the default value of the page number attribute
   */
  public $DEFAULT_PAGE = 1;
  
  protected $perPage;
  protected $page;

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
    
    // check to see if per page was specified
    if (array_key_exists("per_page", $this->request)) {
      $this->perPage = $this->request["per_page"];
    } else {
      $this->perPage = $this->DEFAULT_PER_PAGE;
    }
    
    // check to see if the page number was specified
    if (array_key_exists("page", $this->request)) {
      $this->page = $this->request["page"];
    } else {
      $this->page = $this->DEFAULT_PAGE;
    }
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
      $player = PlayerDAO::getPlayer($searchId);
      
      $topLevel = $this->getPagination(1, 1);
      $topLevel["players"] = array();
      array_push($topLevel["players"], $this->getPlayerJSON($player));
      
      return $topLevel;
    } else {
      return 'method not implemented yet';
    }
  }
  
  protected function getPlayerJSON($player) {
    $values = array();
    $values["id"] = $player->id;
    $values["first_name"] = $player->firstName;
    $values["last_name"] = $player->lastName;
    $values["full_time"] = $player->fulltime;
    $values["active"] = $player->active;
    $values["handicap"] = $player->handicap;
    $values["team_id"] = $player->teamId;
    
    return $values;
  }
  
  protected function getPagination($totalCount, $actualReturnedCount) {
    $values = array();
    $pageValues = array();
    $values["count"] = $totalCount;
    $pageValues["per_page"] = $this->perPage;
    $pageValues["page"] = $this->page;
    $pageValues["count"] = $actualReturnedCount;
    $values["page"] = $pageValues;
    
    return $values;
  }
}

?>
