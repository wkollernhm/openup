SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `tbl_common_names_cache`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tbl_common_names_cache` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `language` VARCHAR(15) NULL DEFAULT NULL ,
  `geography` VARCHAR(100) NULL DEFAULT NULL ,
  `period` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `commonName_UNIQUE` (`name` ASC, `language` ASC, `geography` ASC, `period` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tbl_scientific_name_cache`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tbl_scientific_name_cache` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tbl_service`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tbl_service` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `url` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tbl_webservice_cache`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tbl_webservice_cache` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `service_id` INT NOT NULL ,
  `query` VARCHAR(40) NOT NULL COMMENT 'SHA1 hash of query' ,
  `response` TEXT NULL ,
  `timestamp` INT NOT NULL DEFAULT 0 COMMENT 'caching time as unix-timestamp' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_tbl_webservice_cache_tbl_service1_idx` (`service_id` ASC) ,
  INDEX `query_INDEX` (`query` ASC) ,
  INDEX `service_query_INDEX` (`query` ASC, `service_id` ASC) ,
  CONSTRAINT `fk_tbl_webservice_cache_tbl_service1`
    FOREIGN KEY (`service_id` )
    REFERENCES `tbl_service` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `tbl_service`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `tbl_service` (`id`, `url`) VALUES (1, 'http://webservice.catalogueoflife.org/webservice?response=full&format=php&name=');
INSERT INTO `tbl_service` (`id`, `url`) VALUES (2, 'http://131.130.131.9/taxamatch/jsonRPC/json_rpc_taxamatchMdld.php');
INSERT INTO `tbl_service` (`id`, `url`) VALUES (3, 'http://www.eu-nomen.eu/portal/soap.php?wsdl=1');
INSERT INTO `tbl_service` (`id`, `url`) VALUES (4, 'http://webtjenester.artsdatabanken.no/Artsnavnebase.asmx?WSDL');
INSERT INTO `tbl_service` (`id`, `url`) VALUES (5, 'http://wboe.oeaw.ac.at/api/taxonid/');
INSERT INTO `tbl_service` (`id`, `url`) VALUES (6, 'http://ws.luomus.fi/triplestore/search?predicate=dwc:scientificName&object=');

COMMIT;
