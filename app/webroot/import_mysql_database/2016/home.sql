ALTER TABLE `slideshows` ADD `forum_flag` INT NOT NULL DEFAULT '0';
ALTER TABLE `contents` ADD `image` VARCHAR( 255 ) NULL ,
ADD `forum_flag` INT NOT NULL DEFAULT '0';
ALTER TABLE `contents` DROP `image`;
INSERT INTO `contents` (`id`, `title`, `body`, `map_iframe`, `address`, `phone`, `mail`, `facebook_link`, `linkedin_link`, `working_hours`, `inner_title`, `forum_flag`) VALUES
(3, 'Welcome note', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4, 'Happening now', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
ALTER TABLE `libraries` ADD `type3` INT NOT NULL DEFAULT '0';
ALTER TABLE `gals` ADD `library_id` INT NOT NULL DEFAULT '0';
ALTER TABLE `posts` ADD `type` INT NOT NULL DEFAULT '0';
