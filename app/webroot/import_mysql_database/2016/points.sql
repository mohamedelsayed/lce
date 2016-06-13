
CREATE TABLE IF NOT EXISTS `points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `body` text,
  `image` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`id`, `title`, `body`, `image`, `created`, `updated`, `weight`, `approved`) VALUES
(1, 'Vision', '<p>\r\n	<span style="font-size:18px;">&quot;Empowering People through self-knowledge to become the best versions of themselves as individuals and communities.&quot;</span></p>\r\n', 'img_ahout_vision_c22cb.png', '2016-06-13 20:09:10', '2016-06-13 20:09:10', 1, 1),
(2, 'Mission', '<p>\r\n	<span style="font-size:18px;">&quot;LCE was created to provide a safe environment for our clients where they can gain awareness about themselves and develop. We are keen to develop strong relationships with our clients, giving them undivided focus and offering interactive workshops that stimulate reflection. We also aim to engage in research in the fields of coaching and psychology to continuously develop new tools to help our clients.&quot; </span></p>\r\n', 'img_ahout_mission_0daa8.png', '2016-06-13 20:09:46', '2016-06-13 20:09:46', 2, 1);
