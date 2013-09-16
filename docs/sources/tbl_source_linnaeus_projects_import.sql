use openup;

-- import names from export file, tab separated and encoded in iso-8859-15
LOAD DATA INFILE '/data/common_names_from_Linnaeus_projects_2013.08.22.txt' INTO TABLE tbl_source_linnaeus_projects CHARACTER SET 'latin2' COLUMNS TERMINATED BY '\t' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n' IGNORE 0 LINES;
