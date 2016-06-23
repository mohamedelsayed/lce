
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