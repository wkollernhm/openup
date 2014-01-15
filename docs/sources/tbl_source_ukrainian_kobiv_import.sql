-- use openup database
use openup;

-- change path to file accordingly, make sure to use correct CSV export settings
LOAD DATA INFILE '/data/UKRNAR_1_PART.csv' INTO TABLE tbl_source_ukrainian_kobiv CHARACTER SET 'utf8' COLUMNS TERMINATED BY '|' ENCLOSED BY '"' IGNORE 1 LINES;
