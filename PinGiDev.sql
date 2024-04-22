SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema PinGiDev
-- -----------------------------------------------------

CREATE SCHEMA IF NOT EXISTS `PinGiDev` DEFAULT CHARACTER SET utf8 ;
USE `PinGiDev` ;

-- -----------------------------------------------------
-- Table `PinGiDev`.`rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PinGiDev`.`rol` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PinGiDev`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PinGiDev`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(45) NOT NULL,
  `pass` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `id_rol` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_rol_idx` (`id_rol` ASC),
  CONSTRAINT `fk_users_rol`
    FOREIGN KEY (`id_rol`)
    REFERENCES `PinGiDev`.`rol` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PinGiDev`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PinGiDev`.`product` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `route` VARCHAR(45) NOT NULL,
  `price` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PinGiDev`.`favorites`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PinGiDev`.`favorites` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_user` INT NOT NULL,
  `id_product` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_has_products_products1_idx` (`id_product` ASC),
  INDEX `fk_users_has_products_users1_idx` (`id_user` ASC),
  CONSTRAINT `fk_users_has_products_users1`
    FOREIGN KEY (`id_user`)
    REFERENCES `PinGiDev`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_products_products1`
    FOREIGN KEY (`id_product`)
    REFERENCES `PinGiDev`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PinGiDev`.`purchase`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PinGiDev`.`purchase` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_product` INT NOT NULL,
  `id_user` INT NOT NULL,
  INDEX `fk_products_has_users_users1_idx` (`id_user` ASC),
  INDEX `fk_products_has_users_products1_idx` (`id_product` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_products_has_users_products1`
    FOREIGN KEY (`id_product`)
    REFERENCES `PinGiDev`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_has_users_users1`
    FOREIGN KEY (`id_user`)
    REFERENCES `PinGiDev`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PinGiDev`.`customProduct`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PinGiDev`.`customProduct` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `description` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PinGiDev`.`customProductOrder`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PinGiDev`.`customProductOrder` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_user` INT NOT NULL,
  `id_custom_product` INT NOT NULL,
  INDEX `fk_users_has_customProduct_customProduct1_idx` (`id_custom_product` ASC),
  INDEX `fk_users_has_customProduct_users1_idx` (`id_user` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_users_has_customProduct_users1`
    FOREIGN KEY (`id_user`)
    REFERENCES `PinGiDev`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_customProduct_customProduct1`
    FOREIGN KEY (`id_custom_product`)
    REFERENCES `PinGiDev`.`customProduct` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO rol (name) values ("admin");
INSERT INTO rol (name) values ("user");