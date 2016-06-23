
CREATE TABLE IF NOT EXISTS `nevents_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `receipt_number` varchar(255) NOT NULL,
  `transaction_number` varchar(255) NOT NULL,
  `event_id` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
ALTER TABLE `nevents_orders` ADD `tickets_number` INT NOT NULL DEFAULT '1';

INSERT INTO `contents` (`id`, `title`, `body`, `map_iframe`, `address`, `phone`, `mail`, `facebook_link`, `linkedin_link`, `working_hours`, `inner_title`) VALUES
(2, 'Terms and Conditions', '<p>\r\n  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '', '', '', '', '', '', '', '');
