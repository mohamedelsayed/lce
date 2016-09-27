TRUNCATE categories;
TRUNCATE posts;
ALTER TABLE `attachments` ADD `post_id` INT NOT NULL DEFAULT '0';
ALTER TABLE `attachments` CHANGE `title` `title` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;
