<?php
class HandicapDAO {

	const GET_COURSE_HANDICAP_SQL = "SELECT course_handicap, date FROM handicap_history where playerId = %s and course = %s order by date desc limit 0, 1";
	const USGA_STANDARD_COURSE_RATING = 113;

	public function calculateHandicap($playerId, $matchId, $handicapMethod = HandicapMethod::USGA) {

		$handicap = null;
		switch ($handicapMethod) {
			case HandicapMethod::USGA:
				$handicap = self::calculateUSGA($playerId, $matchId);
				break;
			default:
				throw new Exception("Unknown Handicap Method");
				break;
		}

		return $handicap;
	}

	private function calculateUSGA($playerId, $matchId) {
		/*
		 * rules for USGA handicap:
		* 	1. Convert original gross score to adjusted gross score
		* 	2. Calculate differential handicap for each score
		* 	3. Select lowest handicap differentials
		*  4. Average lowest handicap differentials
		*  5. Multiply average handicap differentials by 96%
		*  6. Arrive at handicap index by truncating the numbers to the right of the tenths
		*  7. Calculate course handicap (for the next use)
		*/

		$match = ScheduleDAO::getMatchById($matchId);
		$course = CourseDAO::getCourseById($match->course);
		$courseId = $match->course;
		$holes = CourseDAO::getHolesPerSide($courseId, $match->side);
		$matchDate = $match->date;
		$seasonId = ScheduleDAO::getSeasonByDate($matchDate);
		$player = PlayerDAO::getPlayer($playerId);
		$teeId = PlayerDAO::getPlayerTee($playerId, $seasonId);
		$tee = CourseDAO::getTeeById($teeId);
		$scores = ScoreDAO::getScoresByMatchIdAndPlayer($matchId, $playerId);

		/*
		 * 1. Convert original gross score to adjusted gross score
		*
		*   In order to do this, we first need to find the course handicap for the
		*   player. Then use the following table to adjust the score per hole.
		*
		*   Course Handicap      Maximum Score
		*   ---------------      -------------
		*   9 or less            double bogey
		*   10 to 19             7
		*   20 to 29             8
		*   30 to 39             9
		*   40 and above         10
		*/
		// get the latest course handicap
		$courseHandicap = self::getLatestCourseHandicap($playerId, $courseId);
		
		echo "Course Handicap: $courseHandicap <br/>";
		
		$maximumScore = 10;
		if ($courseHandicap < 40) {
			$maximumScore = 9;
		}
		if ($courseHandicap < 30) {
			$maximumScore = 8;
		}
		if ($courseHandicap < 20) {
			$maximumScore = 7;
		}
		if ($courseHandicap < 10) {
			$maximumScore = -1;
		}

		echo "Maximum Score: $maximumScore <br/>";
		
		$adjustedGrossScore = 0;
		$totalScore = 0;
		foreach ($holes as $hole) {
			$holeValue = "";
			if (isset($scores->scores[$hole->number])) {
				$holeValue = $scores->scores[$hole->number];
				$totalScore += $holeValue;
				if (is_numeric($holeValue)) {
					$doubleBogey = $hole->par + 2;
					if ($maximumScore > 0) {
						if ($holeValue <= $maximumScore) {
					    	$adjustedGrossScore += $holeValue;
						} else {
							echo "Hole: $hole->number - score: $holeValue - adjusted score: $maximumScore <br/>";
							$adjustedGrossScore += $maximumScore;
						}
					} else {
						if ($holeValue <= $doubleBogey) {
							$adjustedGrossScore += $holeValue;
						} else {
							echo "Hole: $hole->number - score: $holeValue - adjusted score: $doubleBogey <br/>";
							$adjustedGrossScore += $doubleBogey;
						}
					}
				}
			}
		}
		
		echo "Total Score: $totalScore <br/>";
		echo "Adjusted Score: $adjustedGrossScore <br/>";

		/*
		 * 2. Calculate differential handicap for each score
		*
		*   The Handicap Differential is computed using the following formula:
		*
		*     Handicap Differential = (Adjusted Gross Score - Course Rating) X 113 ÷ Slope Rating
		*
		*   Round the handicap differential to the nearest tenth
		*/
		$handicapDifferential = round(($adjustedGrossScore - $tee->rating) * 113 / $tee->slope);
		// TODO store the handicap differential with the match date

		/*
		 * 3. Select best, or lowest, handicap differentials
		*
		*   The number of scores that we keep to calculate the handicap depends
		*   on how many differentials are available. Use the following table to
		*   determine how many to keep.
		*
		*   If there are more than 20 handicap differentials available, use the
		*   most recent 20.
		*
		*   Number of Handicap
		*   Differentials Available         Differentials Used
		*   -----------------------         ------------------
		*     5 or 6                          Lowest 1
		*     7 or 8                          Lowest 2
		*     9 or 10                         Lowest 3
		*     11 or 12                        Lowest 4
		*     13 or 14                        Lowest 5
		*     15 or 16                        Lowest 6
		*     17                              Lowest 7
		*     18                              Lowest 8
		*     19                              Lowest 9
		*     20                              Lowest 10
		*/
		// TODO get the number differentials available up to 20
		// TODO based on the number that is returned convert it into the number used
		$numberOfDifferentials = 1;
		$differentials = array();

		/*
		 * 4. Calculate the average of the lowest handicap differentials
		*/
		$averageDifferentials = array_sum($differentials) / $numberOfDifferentials;

		/*
		 * 5. Multiply average of handicap differentials by 0.96
		*
		*   This is also known as calculating the net handicap differential average.
		*   The value used by the USGA is 96%
		*/
		$netDifferential = $averageDifferentials * 0.96;

		/*
		 * 6. Truncate numbers to the right of the tenths
		*/
		$handicap = floor($netDifferential * 10) / 10;

		return $handicap;
	}

	private function getLatestCourseHandicap($playerId, $courseId) {
		$data = DBUtils::escapeData(array($playerId, $courseId));
		$query = vsprintf(self::GET_COURSE_HANDICAP_SQL, $data);
		$result = @mysqli_query($query);
		$courseHandicap = 40.0; // this handicap is the default
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$courseHandicap = $row["course_handicap"];
		} else {
			throw new Exception("DB : " . mysqli_error());
		}
		return $courseHandicap;
	}

}

?>