-- login to mysql
use openup;

-- change path to csv file downloaded from source, make sure separator is the semicolon (';')
LOAD DATA INFILE '/var/www/html/common_names_fungi_20120823.xls' INTO TABLE tbl_source_slovak_bratislava CHARACTER SET 'utf8' COLUMNS TERMINATED BY ';' ENCLOSED BY '"' IGNORE 1 LINES;
LOAD DATA INFILE '/var/www/html/common_names_plants_slovak_20120823.xls' INTO TABLE tbl_source_slovak_bratislava CHARACTER SET 'utf8' COLUMNS TERMINATED BY ';' ENCLOSED BY '"' IGNORE 1 LINES;
