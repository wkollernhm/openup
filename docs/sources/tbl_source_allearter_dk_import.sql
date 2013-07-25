-- login to mysql
use openup;

-- change path to csv file downloaded from source, make sure separator is the pipe ('|')
LOAD DATA INFILE '/var/www/html/Dansek_arter_2012-08-09_komplett.csv' INTO TABLE tbl_source_allearter_dk CHARACTER SET 'utf8' COLUMNS TERMINATED BY '|' ENCLOSED BY '"' IGNORE 1 LINES;
