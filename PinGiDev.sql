-- MySQL Script generado por MySQL Workbench
-- Mon Apr 22 16:25:14 2024
-- Modelo: Nuevo Modelo    Versión: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Esquema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Esquema pingidev
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Esquema pingidev
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pingidev` DEFAULT CHARACTER SET utf8mb4 ;
USE `pingidev` ;

-- -----------------------------------------------------
-- Tabla `pingidev`.`Product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pingidev`.`Product` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `route` VARCHAR(45) NOT NULL,
  `price` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Tabla `pingidev`.`Rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pingidev`.`Rol` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Tabla `pingidev`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pingidev`.`User` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(45) NOT NULL,
  `pass` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `id_rol` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_rol_idx` (`id_rol` ASC),
  CONSTRAINT `fk_users_rol`
    FOREIGN KEY (`id_rol`)
    REFERENCES `pingidev`.`Rol` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Tabla `pingidev`.`Favorites`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pingidev`.`Favorites` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_user` INT(11) NOT NULL,
  `id_product` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_has_products_products1_idx` (`id_product` ASC),
  INDEX `fk_users_has_products_users1_idx` (`id_user` ASC),
  CONSTRAINT `fk_users_has_products_products1`
    FOREIGN KEY (`id_product`)
    REFERENCES `pingidev`.`Product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_products_users1`
    FOREIGN KEY (`id_user`)
    REFERENCES `pingidev`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Tabla `pingidev`.`Purchase`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pingidev`.`Purchase` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_product` INT(11) NOT NULL,
  `id_user` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_products_has_users_users1_idx` (`id_user` ASC),
  INDEX `fk_products_has_users_products1_idx` (`id_product` ASC),
  CONSTRAINT `fk_products_has_users_products1`
    FOREIGN KEY (`id_product`)
    REFERENCES `pingidev`.`Product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_has_users_users1`
    FOREIGN KEY (`id_user`)
    REFERENCES `pingidev`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Tabla `pingidev`.`Custom_Product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pingidev`.`Custom_Product` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `product_id` INT(11) NOT NULL,
  `description` VARCHAR(200) NOT NULL,
  INDEX `fk_user_has_product_product1_idx` (`product_id` ASC),
  INDEX `fk_user_has_product_user1_idx` (`user_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_user_has_product_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `pingidev`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_product_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `pingidev`.`Product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO rol (id, name) values (0, "admin");
INSERT INTO rol (id, name) values (1, "defaultUser");