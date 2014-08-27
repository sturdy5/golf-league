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
  
  /**
   * The per page requested
   */
  protected $perPage;
  
  /**
   * The page number requested
   */
  protected $page;
  
  /**
   * stores the array of parameters that the functions can use
   */
  protected $parameters;

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
      // make sure the value passed in is numeric
      if (is_numeric($this->request["page"])) {
        $this->perPage = intval($this->request["per_page"]);
      }
    } else {
      $this->perPage = $this->DEFAULT_PER_PAGE;
    }
    
    // check to see if the page number was specified
    if (array_key_exists("page", $this->request)) {
      // make sure the value passed in is numeric
      if (is_numeric($this->request["page"])) {
        $this->page = intval($this->request["page"]);
      }
    } else {
      $this->page = $this->DEFAULT_PAGE;
    }
    
    // parse out the parameters
    $this->parseArguments($this->request);
  }
  
  /**
   * This function will take all of the request parameters and parse them to
   * take into account the following operations:
   *  - gt - the field is greater than this value
   *  - gte - the field is greater than or equal to this value
   *  - lt - the field is less than this value
   *  - lte - the field is less than or equal to this value
   *  - not - the field is not this value
   *  - all - the field is an array that contains all of these values (separated by |)
   *  - in - the field is a string that is one of these values (separated by |)
   *  - nin - the field is a string that is not one of these values (separated by |)
   *  - exists - the field is both present and non-null (supploy true or false)
   * 
   * All operators are applied by adding two underscores (__) after the field name. They cannot be combined.
   */
  protected function parseArguments($args) {
    foreach(array_keys($args) as $key) {
      // default operatio is equals (eq)
      $operation = "eq";
      // get the value to be used
      $value = $args[$key];
      // check to see if the value has any bars (|)
      // if there are bars then the values become a list
      if (strpos($value, "|") > 0) {
        $value = explode("|", $value);
      }
      
      // check to see if the key has any double underscores (__)
      // if there are underscores then the operation changes
      if (strpos($key, "__") > 0) {
        $splitArg = explode("__", $key);
        $operation = $splitArg[1];
        $key = $splitArg[0];
      }
      // now we have all of our data, let's put it in the protected array $parameters
      $this->parameters[$key] = array("operation"=>$operation, "value"=>$value);
    }
  }

  /**
   * Example of an endpoint
   */
  protected function example($args) {
    if ($this->method == 'GET') {
      $result = array("message" => "You did a GET to figure out this example", "args" => $this->parameters);
      return $result;
    } else {
      return 'method unavailable';
    }
  }
  
  protected function players($args) {
    $allPlayers = false;
    // if the all_players value was provided, then toggle the indicator
    if (array_key_exists("all_players", $this->parameters)) {
      $allPlayers = (strtolower($this->parameters["all_players"]["value"]) === "true");
    }
    // let's see if we can put together some criteria
    // start with the id. If the id exists then we can skip everything else
    if (array_key_exists("id", $this->parameters)) {
      $searchId = $this->parameters["id"]["value"];
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
