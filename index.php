<?php
/**
 * Common Names Service
 */
require( "inc/variables.php" );
require( "inc/jsonRPCClient.php" );
require( "inc/utility.php" );

/**
 * Open connection to database
 */
// Jacq database
$dbh = null;
try {
    $dbh = new PDO("mysql:dbname=" . $_CONFIG['DATABASE']['JACQ']['name'] . ";host=" . $_CONFIG['DATABASE']['JACQ']['host'], $_CONFIG['DATABASE']['JACQ']['user'], $_CONFIG['DATABASE']['JACQ']['pass']);
}
catch(PDOException $e) {
    echo $e->getMessage();
    
    die( "JACQ Database not available!" );
}

// Cache database
$dbh_cache = null;
try {
    $dbh_cache = new PDO("mysql:dbname=" . $_CONFIG['DATABASE']['CACHE']['name'] . ";host=" . $_CONFIG['DATABASE']['CACHE']['host'], $_CONFIG['DATABASE']['CACHE']['user'], $_CONFIG['DATABASE']['CACHE']['pass']);
}
catch(PDOException $e) {
    echo $e->getMessage();
    
    die( "CACHE Database not available!" );
}

/**
 * Returns common names for a given scientific name
 * @global PDO $dbh Database connection
 * @param int $taxonID TaxonID
 * @param array $result Taxon information
 * @param array $results Results list (to merge new results into)
 * @return array 
 */
function get_common_names($taxonID,$result,$results) {
    global $dbh;

    $sql = "
            SELECT tnc.`common_name`, tnl.`iso639-6`, tngc.`name` AS `geo_name`, tnp.`period`
            FROM `tbl_name_commons` AS tnc
            LEFT JOIN `tbl_name_applies_to` tnat ON tnc.`common_id` = tnat.`name_id`
            LEFT JOIN `tbl_name_taxa` AS tnt ON tnat.`entity_id` = tnt.`taxon_id`
            LEFT JOIN `tbl_name_languages` AS tnl ON tnat.`language_id` = tnl.`language_id`
            LEFT JOIN `tbl_geonames_cache` AS tngc ON tnat.`geonameId` = tngc.`geonameId`
            LEFT JOIN `tbl_name_periods` AS tnp ON tnat.`period_id` = tnp.`period_id`
            WHERE
            tnt.`taxonID` = '$taxonID'
        ";

    foreach ($dbh->query($sql) as $row) {
        $results[] = array(
            "id" => $taxonID,
            "name" => $row['common_name'],
            "type" => "/name/common",
            "score" => $result['ratio'] * 100,
            "match" => ($result['ratio'] >= 1.0) ? true : false,
            "language" => $row['iso639-6'],
            "geography" => $row['geo_name'],
            "period" => $row['period'],
            "reference" => "jacq",
            "taxon" => $result['taxon'],
            "taxon_id" => $taxonID,
        );
    }
    
    return $results;
}

function get_results( $query ) {
    global $_CONFIG, $dbh_cache;
    $results = array();
    
    try {
        /**
        * Create RPC client for scientific name lookup
        */
        $service = new jsonRPCClient( $_CONFIG['WEBSERVICE']['JACQ'] );

        // Get matches for our scientific name
        $response = $service->getMatchesService('vienna',$query['query'],array('showSyn'=>false,'NearMatch'=>false));
    
        $searchresult = $response["result"][0]["searchresult"];

        // Get common names for each matched scientific name
        foreach( $searchresult as $result ) {
            $results = get_common_names($result['ID'], $result, $results);

            if( isset($result['species']) && is_array($result['species']) ) {
                foreach($result['species'] as $entry) {
                    $results = get_common_names($entry['taxonID'], $entry, $results);
                }
            }
        }
    }
    catch( Exception $e ) {
        echo $e->getMessage();
    }

    try {
        // Create a cached soap client
        $pesiSoapClient = new CachedSoapClient( $_CONFIG['WEBSERVICE']['PESI'] );
        $pesiSoapClient->setCaching( $_CONFIG['DATABASE']['CACHE']['name'], $_CONFIG['DATABASE']['CACHE']['host'], $_CONFIG['DATABASE']['CACHE']['user'], $_CONFIG['DATABASE']['CACHE']['pass'], "pesi_cache" );
        
        // Fetch records matching our query
        $records = $pesiSoapClient->getPESIRecords( $query['query'], false );
        
        // Check all records and analyze the data
        foreach( $records as $record ) {
            $guid = $record->GUID;
            
            $vernaculars = $pesiSoapClient->getPESIVernacularsByGUID( $guid );
            
            foreach( $vernaculars as $vernacular ) {
                if( !isset( $vernacular->vernacular ) ) continue;
                
                $results[] = array(
                    "id" => $guid,
                    "name" => $vernacular->vernacular,
                    "type" => "/name/common",
                    "score" => 100,
                    "match" => true,
                    "language" => $vernacular->language_code,
                    "reference" => "pesi",
                    "taxon" => $record->scientificname,
                    "taxon_id" => $guid,
                );
            }
        }
    }
    catch( Exception $e ) {
        echo $e->getMessage();
    }

    return $results;
}

$result = array();

// Check for metadata output
if( !isset($_REQUEST['query']) && !isset($_REQUEST['queries']) ) {
    $result = array(
        "name" => "OpenUp! Common Names Service",
        "identifierSpace" => "http://open-up.eu/identifier/",
        "schemaSpace" => "http://open-up.eu"
    );
}
else {
    if( isset($_REQUEST['query']) ) {
        $query = json_decode($_REQUEST['query'], true);

        $result = get_results($query);
    }
    else {
        $queries = json_decode($_REQUEST['queries'], true);
        
        foreach( $queries as $qname => $query ) {
            $result[$qname] = get_results($query);
        }
    }
}

// Create JSON output (but replace escaped characters from json_encode)
$json = preg_replace_callback('/\\\u(\w\w\w\w)/', "utf8_correct_callback", json_encode($result));

header( 'Content-Type: application/json; charset=utf-8' );

// Check if we have to provide a callback
if( isset($_REQUEST['callback']) ) {
    echo $_REQUEST['callback'] . "( ";
    echo $json;
    echo " )";
}
else {
    echo $json;
}
