-- MySQL Script generated by MySQL Workbench
-- Thu Sep  3 08:35:05 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema chat_app
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `chat_app` ;

-- -----------------------------------------------------
-- Schema chat_app
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `chat_app` DEFAULT CHARACTER SET utf8mb4 ;
USE `chat_app` ;

-- -----------------------------------------------------
-- Table `chat_app`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chat_app`.`users` ;

CREATE TABLE IF NOT EXISTS `chat_app`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `login_id` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chat_app`.`messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chat_app`.`messages` ;

CREATE TABLE IF NOT EXISTS `chat_app`.`messages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `body_message` LONGTEXT NOT NULL,
  `date` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `user`
    FOREIGN KEY (`id`)
    REFERENCES `chat_app`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
