TRUNCATE categories;
TRUNCATE posts;
ALTER TABLE `attachments` ADD `post_id` INT NOT NULL DEFAULT '0';
