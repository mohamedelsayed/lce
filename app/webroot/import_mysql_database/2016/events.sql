ALTER TABLE `events` CHANGE `agenda` `brief` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;
ALTER TABLE `events` CHANGE `date` `start_date` DATE NOT NULL;
ALTER TABLE `events` ADD `duration` INT NOT NULL DEFAULT '1';
ALTER TABLE `events` CHANGE `timing` `time_from` TIME NOT NULL;
ALTER TABLE `events` ADD `time_to` TIME NOT NULL;
ALTER TABLE `events` ADD `ticket_price` INT NOT NULL DEFAULT '0',
ADD `weight` INT NOT NULL DEFAULT '0';
ALTER TABLE `events` ADD `image` VARCHAR( 255 ) NULL;
ALTER TABLE `events` ADD `instructors_id` INT NOT NULL DEFAULT '0',
ADD `type` INT NOT NULL DEFAULT '0';
ALTER TABLE `instructors` ADD `forum_flag` INT NOT NULL DEFAULT '0';
CREATE TABLE IF NOT EXISTS `events_instructors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL DEFAULT '0',
  `instructor_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
ALTER TABLE `events` ADD `agenda_word_file` LONGTEXT NULL ,
ADD `minutes_of_meeting_file` LONGTEXT NULL ,
ADD `p_and_l_sheet` LONGTEXT NULL;
ALTER TABLE `events` CHANGE `start_date` `from_date` DATE NOT NULL;
ALTER TABLE `events` ADD `to_date` DATE NOT NULL AFTER `from_date` ;

