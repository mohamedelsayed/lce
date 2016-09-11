ALTER TABLE `settings` ADD `number_of_instalments` INT NOT NULL DEFAULT '1',
ADD `value_for_each_installment` INT NOT NULL DEFAULT '1';
ALTER TABLE `nevents_orders` ADD `installment_flag` INT NOT NULL DEFAULT '0';