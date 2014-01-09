# use openup database
use openup;

# change path to file accordingly, make sure to use correct CSV export settings
LOAD DATA INFILE '/data/Russianplantnames.csv' INTO TABLE tbl_source_russian_plantarium CHARACTER SET 'utf8' COLUMNS TERMINATED BY '|' ENCLOSED BY '"' IGNORE 0 LINES;
