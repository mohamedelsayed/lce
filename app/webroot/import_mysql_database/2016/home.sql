ALTER TABLE `slideshows` ADD `forum_flag` INT NOT NULL DEFAULT '0';
ALTER TABLE `contents` ADD `image` VARCHAR( 255 ) NULL ,
ADD `forum_flag` INT NOT NULL DEFAULT '0';
ALTER TABLE `contents` DROP `image`;
INSERT INTO `lce`.`contents` (
`id` ,
`title` ,
`body` ,
`map_iframe` ,
`address` ,
`phone` ,
`mail` ,
`facebook_link` ,
`linkedin_link` ,
`working_hours` ,
`inner_title` ,
`forum_flag`
)
VALUES (
NULL , 'Welcome', '', NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , '0'
);