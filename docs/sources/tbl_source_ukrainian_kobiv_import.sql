-- use openup database
use openup;

-- change path to file accordingly, make sure to use correct CSV export settings
LOAD DATA INFILE '/data/UKRNAR_1_PART.csv' INTO TABLE `tbl_source_ukrainian_kobiv` CHARACTER SET 'utf8' COLUMNS TERMINATED BY '|' ENCLOSED BY '"' ESCAPED BY '^' IGNORE 1 LINES;

-- update printout names to remove control characters
UPDATE `tbl_source_ukrainian_kobiv` SET `UTYPESET` = REPLACE(`UTYPESET`, '\\', '');

-- remove hashtag from literature
UPDATE `tbl_source_ukrainian_kobiv` SET `LIT` = REPLACE(`LIT`, '#', '');

-- update latin names (LNOM first, then LSECOND)
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\\'{A}', 'Á');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\\'{a}', 'á');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\\'{e}', 'é');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\\'{i}', 'í');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\\'{o}', 'ó');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\"{o}', 'ö');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\"{e}', 'ë');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\"{u}', 'ü');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\v{C}', 'Č');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\v{c}', 'č');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\v{S}', 'Š');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\v{c}', 'č');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\\'{c}', 'ć');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\v{e}', 'ĕ');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\l', 'ł');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\aa', 'å');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\AA', 'Å');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\v{r}', 'ř');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\v{z}', 'ž');
UPDATE `tbl_source_ukrainian_kobiv` SET `LNOM` = REPLACE(`LNOM`, '\\={a}', 'ā');

UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\\'{A}', 'Á');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\\'{a}', 'á');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\\'{e}', 'é');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\\'{i}', 'í');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\\'{o}', 'ó');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\"{o}', 'ö');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\"{e}', 'ë');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\"{u}', 'ü');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\v{C}', 'Č');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\v{c}', 'č');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\v{S}', 'Š');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\v{c}', 'č');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\\'{c}', 'ć');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\v{e}', 'ĕ');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\l', 'ł');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\aa', 'å');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\AA', 'Å');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\v{r}', 'ř');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\v{z}', 'ž');
UPDATE `tbl_source_ukrainian_kobiv` SET `LSECOND` = REPLACE(`LSECOND`, '\\={a}', 'ā');
