CREATE TABLE IF NOT EXISTS `values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `body` text,
  `image` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `values`
--

INSERT INTO `values` (`id`, `title`, `body`, `image`, `created`, `updated`, `weight`, `approved`) VALUES
(1, 'ِAuthenticity', '<p>\r\n	<span style="font-size:18px;">We believe that true pride comes with being vulnerable, imperfect and real. &nbsp;We would rather work on ourselves than claim perfection.</span></p>\r\n', 'icon_about_values_authenticity_ce71f.png', '2016-06-11 21:06:58', '2016-06-11 21:06:58', 1, 1),
(2, 'Passion', '<p>\r\n	<span style="font-size:18px;">We do what we do for something more than the cash. We believe that passion is an excellent shortcut to dedication </span></p>\r\n', 'icon2_about_values_passion_5293a.png', '2016-06-11 21:07:32', '2016-06-11 21:07:32', 2, 1),
(3, 'Quality', '<p>\r\n	<span style="font-size:18px;">We do things well not to look good, but for the sake of who we want to become in the process of improvement.</span></p>\r\n', 'icon3_about_values_guality_6c9cc.png', '2016-06-11 21:08:10', '2016-06-11 21:08:10', 3, 1),
(4, 'Responsibility', '<p>\r\n	<span style="font-size:18px;">We believe that we always have a choice and take responsibility for the things we have done and have not done</span></p>\r\n', 'icon4_about_values_responsibility_4f2bd.png', '2016-06-11 21:08:37', '2016-06-11 21:08:37', 4, 1),
(5, 'Knowledge', '<p>\r\n	<span style="font-size:18px;">We believe in a deeper sense of knowledge than just information. We learn to become wiser</span></p>\r\n', 'icon5_about_values_knowledge_59de5.png', '2016-06-11 21:08:59', '2016-06-11 21:08:59', 5, 1);
