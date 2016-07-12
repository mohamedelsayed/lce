ALTER TABLE `settings` ADD `hide_geography` BOOLEAN NOT NULL DEFAULT '0',
ADD `coaches_email` VARCHAR( 255 ) NULL ;
ALTER TABLE `settings` ADD `payment_email` TEXT NOT NULL;
ALTER TABLE `settings` CHANGE `coaches_email` `coaches_email` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
