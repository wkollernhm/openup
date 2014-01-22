-- use openup database
use openup;

-- change path to file accordingly, make sure to use correct CSV export settings - every sheet in a separate file!
LOAD DATA INFILE '/data/Nazvy_semifin_BEZO1.csv' INTO TABLE `tbl_source_czech_jiri_bezo1` CHARACTER SET 'utf8' COLUMNS TERMINATED BY '|' ENCLOSED BY '"' IGNORE 1 LINES;
LOAD DATA INFILE '/data/Nazvy_semifin_Roztoci.csv' INTO TABLE `tbl_source_czech_jiri_roztoci` CHARACTER SET 'utf8' COLUMNS TERMINATED BY '|' ENCLOSED BY '"' IGNORE 1 LINES;
LOAD DATA INFILE '/data/Nazvy_semifin_Vacnatci.csv' INTO TABLE `tbl_source_czech_jiri_vacnatci` CHARACTER SET 'utf8' COLUMNS TERMINATED BY '|' ENCLOSED BY '"' IGNORE 1 LINES;
