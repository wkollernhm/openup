 use openup;
 
 -- import the export-file from eti database
 LOAD DATA INFILE '/data/nsr_names_export_2013.07.10.csv' INTO TABLE tbl_source_eti_databases CHARACTER SET 'utf8' COLUMNS TERMINATED BY ';' ENCLOSED BY '"' LINES TERMINATED BY '\r\n' IGNORE 1 LINES;
 