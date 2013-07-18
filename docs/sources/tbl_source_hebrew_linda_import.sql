# use openup database
use openup;

# change path to file accordingly, make sure to use correct CSV export settings
LOAD DATA INFILE '/srv/www/htdocs/Programming/NewPlantlistwithaliens.csv' INTO TABLE tbl_source_hebrew_linda CHARACTER SET 'utf8' COLUMNS TERMINATED BY '|' ENCLOSED BY '"' IGNORE 1 LINES;
