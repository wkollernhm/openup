# use openup database
use openup;

# change path to file accordingly
LOAD DATA INFILE '/srv/www/htdocs/Programming/Azerb.HERBARIUMDatabase_names.csv' INTO TABLE tbl_source_azerbaijan CHARACTER SET 'utf8' COLUMNS TERMINATED BY '|' ENCLOSED BY '"' IGNORE 1 LINES;
