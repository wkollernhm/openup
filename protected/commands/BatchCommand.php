<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BatchCommand extends CConsoleCommand {

    /**
     * Command line compare tool for batch processing a list of scientific names
     * @param String $scientificNamesFile Path to file containing the scientific names (CSV Format, One name per Line)
     * @param String $outputFile Path to output file for processing results (CSV Format, one ScientificName / Common Name per Line)
     */
    public function actionCompare($scientificNamesFile, $outputFile) {
        if (!file_exists($scientificNamesFile)) {
            throw new Exception("Can't find file for scientific names '" . $scientificNamesFile . "'");
        }

        // read content of scientific names file
        $scientificNamesFileLines = file($scientificNamesFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // iterate over each line in the file and handle it as scientific name
        foreach ($scientificNamesFileLines as $scientificName) {
            $results = SourceComponent::querySources($scientificName);

            // iterate over results and write them to the file
            foreach ($results as $result) {
                // clean references response
                unset($result['reference']);
                $references = $result['references'];
                unset($result['references']);
                
                // convert type response to single string entry
                $result['type'] = $result['type'][0];
                
                // put the results & references into the output line
                file_put_contents($outputFile, join(';', $result), FILE_APPEND);
                file_put_contents($outputFile, ";" . join(';', $references) . "\r\n", FILE_APPEND);
            }
        }
    }

}
