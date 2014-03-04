<?php
/**
 * A model class that represents a player in the league
 * 
 * @author Jon Sturdevant
 */
class Player {
    
    public $id;
    public $firstName;
    public $lastName;
    public $phoneNumber;
    public $teamId;
    public $emailAddress;
    public $handicap;
    public $fulltime;
    public $usercontrolled;
    public $admin;
    public $active;
    public $password;
    public $newPassword;
    public $username;
    
    public $teeHistory = array();
    public $handicapHistory = array();
    
}

?>