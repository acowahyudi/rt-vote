-- MySQL Workbench Synchronization
-- Generated: 2021-08-06 14:07
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Britech

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `rt-vote`.`kandidat` 
DROP FOREIGN KEY `fk_kandidat_users1`;

ALTER TABLE `rt-vote`.`hasil_voting` 
DROP FOREIGN KEY `fk_hasil_voting_kandidat1`,
DROP FOREIGN KEY `fk_hasil_voting_users1`;

ALTER TABLE `rt-vote`.`users` 
DROP FOREIGN KEY `fk_users_roles1`;

ALTER TABLE `rt-vote`.`migrations` 
COLLATE = utf8mb4_unicode_ci , ROW_FORMAT = DEFAULT ,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`);

ALTER TABLE `rt-vote`.`password_resets` 
COLLATE = utf8mb4_unicode_ci , ROW_FORMAT = DEFAULT ,
DROP INDEX `password_resets_email_index` ,
ADD INDEX `password_resets_email_index` (`email` ASC);

ALTER TABLE `rt-vote`.`kandidat` 
ROW_FORMAT = DEFAULT ,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`),
DROP INDEX `fk_kandidat_users1_idx` ,
ADD INDEX `fk_kandidat_users1_idx` (`users_id` ASC);

ALTER TABLE `rt-vote`.`periode` 
ROW_FORMAT = DEFAULT ,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`),
DROP INDEX `fk_periode_rukun_tetangga1_idx` ,
ADD INDEX `fk_periode_rukun_tetangga1_idx` (`rukun_tetangga_id` ASC);

ALTER TABLE `rt-vote`.`failed_jobs` 
COLLATE = utf8mb4_unicode_ci , ROW_FORMAT = DEFAULT ,
CHANGE COLUMN `failed_at` `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`),
DROP INDEX `failed_jobs_uuid_unique` ,
ADD UNIQUE INDEX `failed_jobs_uuid_unique` (`uuid` ASC);

ALTER TABLE `rt-vote`.`hasil_voting` 
ROW_FORMAT = DEFAULT ,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`),
DROP INDEX `fk_hasil_voting_periode1_idx` ,
ADD INDEX `fk_hasil_voting_periode1_idx` (`periode_id` ASC),
DROP INDEX `fk_hasil_voting_kandidat1_idx` ,
ADD INDEX `fk_hasil_voting_kandidat1_idx` (`kandidat_id` ASC),
DROP INDEX `fk_hasil_voting_users1_idx` ,
ADD INDEX `fk_hasil_voting_users1_idx` (`users_id` ASC);

ALTER TABLE `rt-vote`.`users` 
COLLATE = utf8mb4_unicode_ci , ROW_FORMAT = DEFAULT ,
CHANGE COLUMN `rukun_tetangga_id` `rukun_tetangga_id` INT(11) NOT NULL ,
CHANGE COLUMN `roles_id` `roles_id` INT(11) NOT NULL ,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`),
DROP INDEX `fk_users_rukun_tetangga1_idx` ,
ADD INDEX `fk_users_rukun_tetangga1_idx` (`rukun_tetangga_id` ASC),
ADD INDEX `fk_users_roles1_idx` (`roles_id` ASC),
DROP INDEX `fk_users_roles1_idx` ;

ALTER TABLE `rt-vote`.`rukun_tetangga` 
ROW_FORMAT = DEFAULT ,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`),
DROP INDEX `fk_data_rt_kelurahan1_idx` ,
ADD INDEX `fk_data_rt_kelurahan1_idx` (`kelurahan_id` ASC);

ALTER TABLE `rt-vote`.`kelurahan` 
ROW_FORMAT = DEFAULT ,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`);

ALTER TABLE `rt-vote`.`roles` 
ROW_FORMAT = DEFAULT ,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`);

ALTER TABLE `rt-vote`.`kegiatan_rt` 
ROW_FORMAT = DEFAULT ,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`),
ADD INDEX `fk_kegiatan_rt_rukun_tetangga1_idx` (`rukun_tetangga_id` ASC),
DROP INDEX `fk_kegiatan_rt_rukun_tetangga1_idx` ;

ALTER TABLE `rt-vote`.`kandidat` 
ADD CONSTRAINT `fk_kandidat_users1`
  FOREIGN KEY (`users_id`)
  REFERENCES `rt-vote`.`users` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `rt-vote`.`hasil_voting` 
DROP FOREIGN KEY `fk_hasil_voting_periode1`;

ALTER TABLE `rt-vote`.`hasil_voting` ADD CONSTRAINT `fk_hasil_voting_periode1`
  FOREIGN KEY (`periode_id`)
  REFERENCES `rt-vote`.`periode` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_hasil_voting_kandidat1`
  FOREIGN KEY (`kandidat_id`)
  REFERENCES `rt-vote`.`kandidat` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_hasil_voting_users1`
  FOREIGN KEY (`users_id`)
  REFERENCES `rt-vote`.`users` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `rt-vote`.`users` 
DROP FOREIGN KEY `fk_users_rukun_tetangga1`;

ALTER TABLE `rt-vote`.`users` ADD CONSTRAINT `fk_users_rukun_tetangga1`
  FOREIGN KEY (`rukun_tetangga_id`)
  REFERENCES `rt-vote`.`rukun_tetangga` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_users_roles1`
  FOREIGN KEY (`roles_id`)
  REFERENCES `rt-vote`.`roles` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
