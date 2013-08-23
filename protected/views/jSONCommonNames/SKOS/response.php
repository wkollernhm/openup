<?xml version="1.0" encoding="UTF-8"?>
<rdf:RDF xmlns="http://www.w3.org/1999/xhtml" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:skos="http://www.w3.org/2004/02/skos/core#">
<?php
/**
 * Small helper function for encoding all strings for use in XML
 * @param string $string String to encode
 */
function xml_encode($string) {
    return htmlspecialchars($string, ENT_XML1 | ENT_COMPAT, 'UTF-8');
}

// cycle through all entries and output them as Europeana SKOS
foreach( $entries as $entry ) {
    // only display 100% matches for Europeana
    if( $entry['score'] < 100 ) continue;
?>
  <skos:Concept rdf:about="http://openup.nhm-wien.ac.at/commonNames/<?php echo $entry['id']; ?>">
      <skos:prefLabel xml:lang="<?php echo $entry['language']; ?>"><?php echo xml_encode($entry['name']); ?></skos:prefLabel>
      <skos:note>
          common name
          <br /><?php echo xml_encode(join(';', $entry['references'])); ?>
          <br /><?php echo xml_encode($entry['geography']); ?>
          <br /><?php echo xml_encode($entry['period']); ?>
      </skos:note>
  </skos:Concept>
<?php
}
?>
</rdf:RDF>
