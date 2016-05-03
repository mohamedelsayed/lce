ALTER TABLE `members` CHANGE `block_notification` `block_posts_notification` TINYINT( 1 ) NOT NULL DEFAULT '0';
ALTER TABLE `members` ADD `block_comments_notification` BOOLEAN NOT NULL DEFAULT '0';
ALTER TABLE `members` ADD `block_announcements_notification` BOOLEAN NOT NULL DEFAULT '0',
ADD `block_events_notification` BOOLEAN NOT NULL DEFAULT '0';

CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `body` longtext,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `weight` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
ALTER TABLE `events`
  DROP `meta_keywords`,
  DROP `meta_description`,
  DROP `date_from`,
  DROP `date_to`,
  DROP `header`,
  DROP `body`,
  DROP `venue`,
  DROP `attendees`;
ALTER TABLE `events` ADD `date` DATE NOT NULL AFTER `title` ,
ADD `timing` TIME NOT NULL AFTER `date` ,
ADD `location` VARCHAR( 255 ) NULL AFTER `timing` ,
ADD `agenda` LONGTEXT NULL AFTER `location` ,
ADD `member_id` INT NOT NULL DEFAULT '0' AFTER `agenda` ;

CREATE TABLE IF NOT EXISTS `agreements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `item_type` int(11) NOT NULL DEFAULT '0',
  `member_id` int(11) NOT NULL DEFAULT '0',
  `agree_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `blocked_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `blocked_member_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `attend_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL DEFAULT '0',
  `member_id` int(11) NOT NULL DEFAULT '0',
  `attend_flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


