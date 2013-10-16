-- login to mysql
use openup;

-- change path to csv file downloaded from source, make sure separator is the pipe ('|')
-- export both sheets in the source excel as separate csv files
LOAD DATA INFILE '/data/vernaculars_20111214_plants.csv' INTO TABLE tbl_source_newZealand_landcare CHARACTER SET 'utf8' COLUMNS TERMINATED BY '|' ENCLOSED BY '"' IGNORE 1 LINES;
LOAD DATA INFILE '/data/vernaculars_20111214_fungi.csv' INTO TABLE tbl_source_newZealand_landcare CHARACTER SET 'utf8' COLUMNS TERMINATED BY '|' ENCLOSED BY '"' IGNORE 0 LINES;
