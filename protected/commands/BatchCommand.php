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
    protected static $OUTPUT_FORMAT_CSV = 'csv';
    protected static $OUTPUT_FORMAT_EDMSKOS = 'edmSkos';

    /**
     * Command line compare tool for batch processing a list of scientific names
     * @param String $scientificNamesFile Path to file containing the scientific names (CSV Format, One name per Line)
     * @param String $outputFile Path to output file for processing results (CSV Format, one ScientificName / Common Name per Line)
     * @param String $outputFormat specify the output format, either 'csv' for a single csv export or 'edmSkos' for OpenUp specific EDM/SKOS output. In this case the outputFile parameter is not a single file but a directory
     * @param Boolean $bOnlyMatches [Optional] Return only 100% matches
     */
    public function actionCompare($scientificNamesFile, $outputFile,
            $outputFormat = 'csv', $bOnlyMatches = false) {
        if (!file_exists($scientificNamesFile)) {
            throw new Exception("Can't find file for scientific names '" . $scientificNamesFile . "'");
        }

        // do some extra checks if we have a CSV output
        if ($outputFormat == BatchCommand::$OUTPUT_FORMAT_CSV) {
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
        } else if ($outputFormat == BatchCommand::$OUTPUT_FORMAT_EDMSKOS) {
            // make sure we have a clean output directory
            $outputFile = rtrim($outputFile, '/') . '/';
        }

        // open scientific names file
        $snHandle = fopen($scientificNamesFile, "r");
        if ($snHandle) {
            // iterate over each line in the file and handle it as scientific name
            while (($scientificName = fgets($snHandle)) !== false) {
                $scientificName = trim($scientificName);
                if (empty($scientificName) || $scientificName == '.') {
                    echo "Skipping entry\n";
                    
                    continue;
                }
                
                echo "Handling entry '$scientificName'\n";

                // query sources for scientific name
                $results = SourceComponent::querySources($scientificName);

                // check for output format, either CSV
                if ($outputFormat == BatchCommand::$OUTPUT_FORMAT_CSV) {
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
                // or EDM-SKOS
                else if ($outputFormat == BatchCommand::$OUTPUT_FORMAT_EDMSKOS) {
                    // get view for response rendering
                    $path = Yii::getPathOfAlias('application.views.commonNames.edmSkos') . '/response.php';

                    // render the results and return them
                    $edmSkosResponse = $this->renderFile(
                            $path, array(
                        'entries' => $results,
                        'baseUrl' => Yii::app()->params['cliEdmSkosBaseUrl']
                            ), true);

                    // create file name based on scientific name
                    $scientificNameFileName = $outputFile . preg_replace('/[^a-zA-Z0-9\']/', '_', $scientificName) . ".xml";

                    // now put them into a file named after the scientific name
                    file_put_contents($scientificNameFileName, $edmSkosResponse);
                }
            }
        }
    }

}
