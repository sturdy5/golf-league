<?php
/*
 * Please add the following as required elements when including this file
*     - config.inc.php
*     - model/Player.php
*     - utils/ArrayUtils.php
*/

/**
 * This class is used to retrieve all of the information relating to
 * players.
 *
 * @author Jon Sturdevant
 */
class PlayerDAO {

	const GET_ALL_USERS_SQL = "select * from users order by fulltime desc, lastName asc";
	const GET_USER_BY_ID_SQL = "select * from users where id = %s";
	const GET_FULLTIME_USER_WITHOUT_A_TEAM_SQL = "select * from users where fulltime=1 order by lastName asc";
	const GET_SUBS_SQL = "select * from users where fulltime=0 and active=1 order by lastName asc, firstName asc";
	const GET_USER_BY_NAME_SQL = "select * from users where LOWER(firstName) = '%s' and LOWER(lastName) = '%s'";
	const ADD_ADMIN_USER_SQL = "update users set admin=1 where id = %s";
	const REMOVE_ADMIN_USER_SQL = "update users set admin=0 where id = %s";
	const DELETE_USER_SQL = "delete from users where id = %s";
	const UPDATE_USER_SQL = "update users set firstName = '%s', lastName = '%s', email = '%s', phoneNumber = '%s', handicap = %s, fulltime = %s, active = %s, usercontrolled = %s, admin = %s, user = '%s' where id = %s";
	const UPDATE_ACCOUNT_SQL = "update users set firstName = '%s', lastName = '%s', email = '%s', phoneNumber = '%s' where id = %s";
	const CHANGE_PASSWORD_SQL = "update users set password = '%s' where id = %s";
	const ADD_USER_BY_ADMIN_SQL = "insert into users (firstName, lastName, email, phoneNumber, fulltime, user, password, active, admin, usercontrolled) values ('%s', '%s', '%s', '%s', %s, 'temp', '%s', 1, 0, 0)";
	const ASSIGN_USER_HANDICAP_SQL = "update users set handicap = %s where id = %s";
	const UPDATE_HANDICAP_HISTORY_SQL = "insert into handicap_history (handicap, playerId, date) values (%s, %s, CURDATE())";
	const GET_LATEST_HANDICAP_SQL = "select * from handicap_history where playerId = %s order by date desc limit 0, 1";
	const GET_HANDICAP_HISTORY_SQL = "select * from handicap_history where playerId = %s order by date desc";
	const GET_PASSWORD_HINT_SQL = "select email, password_hint from users where user = '%s'";

	public static function getPlayer($id) {
		$query = sprintf(self::GET_USER_BY_ID_SQL, $id);

		$result = mysql_query($query) or die("Could not search the database for the desired user - $id");
		$row = mysql_fetch_array($result);
		$user = new Player();
		$user->id = $row["id"];
		$user->emailAddress = $row["email"];
		$user->firstName = $row["firstName"];
		$user->lastName = $row["lastName"];
		$user->phoneNumber = $row["phoneNumber"];
		$user->username = $row["user"];
		$fulltimeIndicator = $row["fulltime"];
		if ($fulltimeIndicator == 1) {
			$user->fulltime = true;
		} else {
			$user->fulltime = false;
		}
		$userControlledIndicator = $row["usercontrolled"];
		if ($userControlledIndicator == 1) {
			$user->usercontrolled = true;
		} else {
			$user->usercontrolled = false;
		}
		$adminIndicator = $row["admin"];
		if ($adminIndicator == 1) {
			$user->admin = true;
		} else {
			$user->admin = false;
		}
		$activeIndicator = $row["active"];
		if ($activeIndicator == 1) {
			$user->active = true;
		} else {
			$user->active = false;
		}

		$query = sprintf(self::GET_LATEST_HANDICAP_SQL, $id);
		$result = @mysql_query($query);
		if ($result) {
			$row = mysql_fetch_array($result);
			$user->handicap = $row["handicap"];
		}

		$user->handicapHistory = self::getHandicapHistory($id);
		if (count($user->handicapHistory) > 0) {
			$user->handicap = ArrayUtils::getAssociativeArrayByNumber($user->handicapHistory, 0);
		}

		$user->teamId = TeamDAO::getTeamIdByPlayerId($id);

		return $user;
	}

	public static function getPlayerByName($firstName, $lastName) {
		$data = DBUtils::escapeData(array(strtolower($firstName), strtolower($lastName)));
		$query = vsprintf(self::GET_USER_BY_NAME_SQL, $data);

		$result = @mysql_query($query);
		$row = mysql_fetch_array($result);
		$user = new Player();
		$user->id = $row["id"];
		$user->emailAddress = $row["email"];
		$user->firstName = $row["firstName"];
		$user->lastName = $row["lastName"];
		$user->phoneNumber = $row["phoneNumber"];
		$user->username = $row["user"];
		$fulltimeIndicator = $row["fulltime"];
		if ($fulltimeIndicator == 1) {
			$user->fulltime = true;
		} else {
			$user->fulltime = false;
		}
		$userControlledIndicator = $row["usercontrolled"];
		if ($userControlledIndicator == 1) {
			$user->usercontrolled = true;
		} else {
			$user->usercontrolled = false;
		}
		$adminIndicator = $row["admin"];
		if ($adminIndicator == 1) {
			$user->admin = true;
		} else {
			$user->admin = false;
		}
		$activeIndicator = $row["active"];
		if ($activeIndicator == 1) {
			$user->active = true;
		} else {
			$user->active = false;
		}

		if (null != $user->id) {
			$query = sprintf(self::GET_LATEST_HANDICAP_SQL, $user->id);
			$result = @mysql_query($query);
			if ($result) {
				$row = mysql_fetch_array($result);
				$user->handicap = $row["handicap"];
			}

			$user->handicapHistory = self::getHandicapHistory($user->id);
			if (count($user->handicapHistory) > 0) {
				$user->handicap = ArrayUtils::getAssociativeArrayByNumber($user->handicapHistory, 0);
			}

			$user->teamId = TeamDAO::getTeamIdByPlayerId($user->id);
		}

		return $user;
	}

	public static function getHandicapHistory($playerId) {
		$history = array();
		$query = vsprintf(self::GET_HANDICAP_HISTORY_SQL, array($playerId));
		$result = @mysql_query($query);
		if ($result) {
			while ($row = mysql_fetch_array($result)) {
				$history[$row["date"]] = $row["handicap"];
			}
		} else {
			throw new Exception("DB : " . mysql_error());
		}
		return $history;
	}

	public static function getAllPlayers() {
		$players = array();
		$result = mysql_query(self::GET_ALL_USERS_SQL) or die("Could not get all users from the database");
		// create a list of players from the results
		while($row = mysql_fetch_array($result)) {
			$user = new Player();
			$user->id = $row["id"];
			$user->emailAddress = $row["email"];
			$user->firstName = $row["firstName"];
			$user->lastName = $row["lastName"];
			$user->handicap = $row["handicap"];
			$user->phoneNumber = $row["phoneNumber"];
			$user->username = $row["user"];
			$fulltimeIndicator = $row["fulltime"];
			if ($fulltimeIndicator == 1) {
				$user->fulltime = true;
			} else {
				$user->fulltime = false;
			}
			$userControlledIndicator = $row["usercontrolled"];
			if ($userControlledIndicator == 1) {
				$user->usercontrolled = true;
			} else {
				$user->usercontrolled = false;
			}
			$adminIndicator = $row["admin"];
			if ($adminIndicator == 1) {
				$user->admin = true;
			} else {
				$user->admin = false;
			}
			$activeIndicator = $row["active"];
			if ($activeIndicator == 1) {
				$user->active = true;
			} else {
				$user->active = false;
			}

			array_push($players, $user);
		}

		foreach ($players as $user) {
			$user->handicapHistory = self::getHandicapHistory($user->id);
			if (count($user->handicapHistory) > 0) {
				$user->handicap = ArrayUtils::getAssociativeArrayByNumber($user->handicapHistory, 0);
			}
			$user->teamId = TeamDAO::getTeamIdByPlayerId($user->id);
		}

		return $players;
	}

	public static function getFulltimePlayersWithoutTeams() {
		$fulltimePlayers = self::getPlayers(self::GET_FULLTIME_USER_WITHOUT_A_TEAM_SQL);
		foreach ($fulltimePlayers as $key=>&$player) {
			if ($player->teamId != null) {
				unset($fulltimePlayers[$key]);
			}
		}
		return $fulltimePlayers;
	}

	public static function getSubs() {
		return self::getPlayers(self::GET_SUBS_SQL);
	}

	private static function getPlayers($query) {
		$players = array();
		$result = @mysql_query($query);
		if (!$result) {
			throw new Exception("DB : " . mysql_error());
		}
		// create a list of players from the results
		while ($row = mysql_fetch_array($result)) {
			$user = new Player();
			$user->id = $row["id"];
			$user->emailAddress = $row["email"];
			$user->firstName = $row["firstName"];
			$user->lastName = $row["lastName"];
			$user->handicap = $row["handicap"];
			$user->phoneNumber = $row["phoneNumber"];
			$user->username = $row["user"];
			$fulltimeIndicator = $row["fulltime"];
			if ($fulltimeIndicator == 1) {
				$user->fulltime = true;
			} else {
				$user->fulltime = false;
			}
			$userControlledIndicator = $row["usercontrolled"];
			if ($userControlledIndicator == 1) {
				$user->usercontrolled = true;
			} else {
				$user->usercontrolled = false;
			}
			$adminIndicator = $row["admin"];
			if ($adminIndicator == 1) {
				$user->admin = true;
			} else {
				$user->admin = false;
			}
			$activeIndicator = $row["active"];
			if ($activeIndicator == 1) {
				$user->active = true;
			} else {
				$user->active = false;
			}

			array_push($players, $user);
		}

		foreach ($players as $user) {
			$user->handicapHistory = self::getHandicapHistory($user->id);
			if (count($user->handicapHistory) > 0) {
				$user->handicap = ArrayUtils::getAssociativeArrayByNumber($user->handicapHistory, 0);
			}
			$user->teamId = TeamDAO::getTeamIdByPlayerId($user->id);
		}

		return $players;
	}

	/**
	 * Sends the password hint for the username
	 * @param string $username
	 * @throws Exception
	 */
	private static function sendPasswordHint($username) {
		$data = DBUtils::escapeData(array($username));
		$query = vsprintf(self::GET_PASSWORD_HINT_SQL, $data);
		$result = @mysql_query($query);
		if ($result) {
			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_array($result);
				$emailAddress = $row["email"];
				$passwordHint = $row["passwordHint"];
				$emailText = "You have requested that your Thursday Night Golf League password hint be emailed to you. Your password hint is \n\n $passwordHint \n\n If you are still unable to access your account with this hint, please contact an administrator at admin@bctngl.com. \n\n If you did not request this be sent to you, please contact a site administrator immediately at admin@bctngl.com";
				if (null != $emailAddress && null != $passwordHint) {
					if (!mail($emailAddress, "Thursday Night Golf League Password Hint", $emailText)) {
						throw new Exception("Email : Could not send the password hint for username $username to email address $emailAddress");
					}
				}
			} else {
				throw new Exception("Setup : Could not ssend the password hint for username $username because it doesn't exist");
			}
		} else {
			throw new Exception("DB : Could not send the password hint for username $username" . mysql_error());
		}
	}

	public static function editAccount($player) {
		$data = DBUtils::escapeData(array($player->firstName, $player->lastName, $player->emailAddress, $player->phoneNumber, $player->id));
		$query = vsprintf(self::UPDATE_ACCOUNT_SQL, $data);
		$result = @mysql_query($query);
		if (!$result) {
			throw new Exception("DB - Could not update the account information for id - $player->id : " . mysql_error());
		}
	}

	public static function updatePlayer($player) {
		$fulltime = "0";
		if ($player->fulltime) {
			$fulltime = "1";
		}
		$active = "0";
		if ($player->active) {
			$active = "1";
		}
		$usercontrolled = "0";
		if ($player->usercontrolled) {
			$usercontrolled = "1";
		}
		$admin = "0";
		if ($player->admin) {
			$admin = "1";
		}
		$data = DBUtils::escapeData(array($player->firstName, $player->lastName, $player->emailAddress, $player->phoneNumber, $player->handicap, $fulltime, $active, $usercontrolled, $admin, $player->username, $player->id));
		$query = vsprintf(self::UPDATE_USER_SQL, $data);
		$result = @mysql_query($query);
		if (!$result) {
			throw new Exception("DB - Could not update the account information for id - $player->id : " . mysql_error());
		}
	}

	public static function changePassword($id, $newPassword) {
		$data = DBUtils::escapeData(array(MD5($newPassword), $id));
		$query = vsprintf(self::CHANGE_PASSWORD_SQL, $data);
		$result = @mysql_query($query);
		if (!$result) {
			throw new Exception("DB - Could not update the password for id - $id : " . mysql_error());
		}
	}

	public static function makePlayerAdmin($id) {
		$data = DBUtils::escapeData(array($id));
		$query = vsprintf(self::ADD_ADMIN_USER_SQL, $data);
		$result = @mysql_query($query);
		if (!$result) {
			throw new Exception("DB - Could not make the player specified into an admin - $id : " . mysql_error());
		}
	}

	public static function removeAdmin($id) {
		$data = DBUtils::escapeData(array($id));
		$query = vsprintf(self::REMOVE_ADMIN_USER_SQL, $data);
		$result = @mysql_query($query);
		if (!$result) {
			throw new Exception("DB - Could not remove an administrator from the database : " . mysql_error());
		}
	}

	public static function addPlayerByAdmin($firstName, $lastName, $email, $phoneNumber, $fullTime) {
		$data = array($firstName, $lastName, $email, $phoneNumber, $fullTime, MD5("temp"));
		$data = DBUtils::escapeData($data);

		$query = vsprintf(self::ADD_USER_BY_ADMIN_SQL, $data);

		$result = @mysql_query($query);
		$playerId = "";
		if ($result) {
			$playerId = mysql_insert_id();
		} else {
			throw new Exception("DB : " . mysql_error());
		}

		return $playerId;
	}

	public static function assignPlayerHandicap($playerId, $handicap) {
		$data = DBUtils::escapeData(array($handicap, $playerId));
		$query = vsprintf(self::ASSIGN_USER_HANDICAP_SQL, $data);
		$result = @mysql_query($query);
		if (!$result) {
			throw new Exception("DB : " . mysql_error());
		}

		$query = vsprintf(self::UPDATE_HANDICAP_HISTORY_SQL, $data);
		$result = @mysql_query($query);
		if (!$result) {
			throw new Exception("DB : " . mysql_error());
		}
	}

	public static function removePlayer($playerId) {
		$data = DBUtils::escapeData(array($playerId));
		$query = vsprintf(self::DELETE_USER_SQL, $data);
		$result = @mysql_query($query);
		if (!$result) {
			echo("DB : " . mysql_error());
		}
	}
}

?>