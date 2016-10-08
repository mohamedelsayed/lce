
CREATE TABLE IF NOT EXISTS `libraries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `google_drive_url` text,
  `youtube_url` text,
  `module` int(11) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
ALTER TABLE `libraries` ADD `type1` INT NOT NULL DEFAULT '0' AFTER `title`;
ALTER TABLE `libraries` CHANGE `type` `type2` INT( 11 ) NOT NULL DEFAULT '0';
ALTER TABLE `libraries` ADD `file` VARCHAR( 255 ) NULL AFTER `type2`;
