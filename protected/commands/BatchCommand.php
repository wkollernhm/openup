<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BatchCommand extends CConsoleCommand {

    /**
     * @var array Output order of fields 
     */
    protected static $FIELD_ORDER = array(
        "taxon",
        "name",
        "language",
        "geography",
        "period",
        "references"
    );
    protected static $FIELD_DELIMITER = ";";

    /**
     * Command line compare tool for batch processing a list of scientific names
     * @param String $scientificNamesFile Path to file containing the scientific names (CSV Format, One name per Line)
     * @param String $outputFile Path to output file for processing results (CSV Format, one ScientificName / Common Name per Line)
     * @param Boolean $bOnlyMatches [Optional] Return only 100% matches
     */
    public function actionCompare($scientificNamesFile, $outputFile, $bOnlyMatches = false) {
        if (!file_exists($scientificNamesFile)) {
            throw new Exception("Can't find file for scientific names '" . $scientificNamesFile . "'");
        }

        // check if output file is writeable
        if (!is_writable($outputFile)) {
            throw new Exception("Can't write to output file for common names '" . $outputFile . "'");
        }

        // remove output file if is exists
        if (file_exists($outputFile)) {
            unlink($outputFile);
        }

        // write headers to output file
        file_put_contents($outputFile, join(BatchCommand::$FIELD_DELIMITER, BatchCommand::$FIELD_ORDER) . "\n");

        // read content of scientific names file
        $scientificNamesFileLines = file($scientificNamesFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);


        // iterate over each line in the file and handle it as scientific name
        foreach ($scientificNamesFileLines as $scientificName) {
            $results = SourceComponent::querySources($scientificName);

            // iterate over results and write them to the file
            foreach ($results as $result) {
                // check if we only have to include full matches
                if ($bOnlyMatches && !$result['match']) {
                    continue;
                }

                $fields = array();

                // iterate over configured fields and add them to the output list
                foreach (BatchCommand::$FIELD_ORDER as $FIELD) {
                    // check if field is set, if not add an empty one
                    if (!isset($result[$FIELD])) {
                        $fields[] = "";
                        continue;
                    }

                    // check if content is an array again, if yes join it as well
                    $content = $result[$FIELD];
                    if (is_array($content)) {
                        $content = join(BatchCommand::$FIELD_DELIMITER, $content);
                    }

                    $fields[] = $content;
                }

                // put the results & references into the output line
                file_put_contents($outputFile, join(BatchCommand::$FIELD_DELIMITER, $fields) . "\n", FILE_APPEND);
            }
        }
    }

}
