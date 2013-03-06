ALTER TABLE `handicap_history` ADD `handicap_method` VARCHAR( 20 ) NOT NULL DEFAULT 'STRAIGHT';
ALTER TABLE `handicap_history` ADD `course_handicap` DOUBLE NOT NULL DEFAULT '40.0' AFTER `handicap`;
ALTER TABLE `handicap_history` ADD `course` INT NULL AFTER `course_handicap`;
update handicap_history set course = 1;
ALTER TABLE `seasons` ADD `team_structure` VARCHAR( 30 ) NOT NULL DEFAULT 'TWO_PERSON',
ADD `score_style` VARCHAR( 30 ) NOT NULL DEFAULT 'STRAIGHT';
INSERT INTO `courses` (`id`, `name`) VALUES (NULL, 'Wildewood');