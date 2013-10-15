use openup;

-- Export names sheet and literature sheet from excel file to separate CSV files using '|' as separator

-- First import the literature entries
LOAD DATA INFILE '/home/wkoller/Desktop/hungarian_literature.csv' INTO TABLE tbl_source_hungarian_peregovits_literature CHARACTER SET 'utf8' COLUMNS TERMINATED BY '|' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\n' IGNORE 1 LINES;

-- Now import the plant names
LOAD DATA INFILE '/home/wkoller/Desktop/hungarian_names.csv' INTO TABLE tbl_source_hungarian_peregovits CHARACTER SET 'utf8' COLUMNS TERMINATED BY '|' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\n' IGNORE 1 LINES;
