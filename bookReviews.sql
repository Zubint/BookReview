-- MySQL Script generated by MySQL Workbench
-- Sat Apr 23 16:49:30 2016
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema bookreviews
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bookreviews
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bookreviews` DEFAULT CHARACTER SET utf8 ;
USE `bookreviews` ;

-- -----------------------------------------------------
-- Table `bookreviews`.`authors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookreviews`.`authors` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bookreviews`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookreviews`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `alias` VARCHAR(255) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `pwd` VARCHAR(255) NULL DEFAULT NULL,
  `salt` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bookreviews`.`books`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookreviews`.`books` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `author_id` INT(11) NOT NULL,
  `title` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_books_users_idx` (`user_id` ASC),
  INDEX `fk_books_authors1_idx` (`author_id` ASC),
  CONSTRAINT `fk_books_authors1`
    FOREIGN KEY (`author_id`)
    REFERENCES `bookreviews`.`authors` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_books_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `bookreviews`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 18
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bookreviews`.`reviews`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookreviews`.`reviews` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `book_id` INT(11) NOT NULL,
  `rating` INT(11) NULL DEFAULT NULL,
  `review` TEXT NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_reviews_users1_idx` (`user_id` ASC),
  INDEX `fk_reviews_books2_idx` (`book_id` ASC),
  CONSTRAINT `fk_reviews_books2`
    FOREIGN KEY (`book_id`)
    REFERENCES `bookreviews`.`books` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reviews_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `bookreviews`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 41
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
