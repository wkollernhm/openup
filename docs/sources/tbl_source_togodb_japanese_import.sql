 use openup;
 
 -- import the export-file from togodb
 LOAD DATA INFILE '/data/species_names_latin_vs_japanese.csv' INTO TABLE tbl_source_togodb_japanese CHARACTER SET 'utf8' COLUMNS TERMINATED BY ';' ENCLOSED BY '' LINES TERMINATED BY '\n' IGNORE 2 LINES;
 