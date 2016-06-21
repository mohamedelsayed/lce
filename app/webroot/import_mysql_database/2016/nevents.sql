
CREATE TABLE IF NOT EXISTS `nevents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `location` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `duration` int(11) NOT NULL DEFAULT '1',
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `ticket_price` int(11) NOT NULL DEFAULT '0',
  `instructor_id` int(11) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `weight` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `nevents` ADD `image` VARCHAR( 255 ) NULL;
ALTER TABLE `nevents` ADD `number_of_participants` INT NOT NULL DEFAULT '0';