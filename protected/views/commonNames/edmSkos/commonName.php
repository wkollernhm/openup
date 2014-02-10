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
?>
  <skos:Concept rdf:about="<?php echo xml_encode(Yii::app()->getRequest()->getBaseUrl(true) . '/' . $model_commonName->id); ?>">
      <skos:prefLabel><?php echo xml_encode($model_commonName->name); ?></skos:prefLabel>
      <skos:note>common name</skos:note>
      <?php
      // check for language information
      if( !empty($model_commonName->language) ) {
      ?>
      <skos:note>Language: <?php echo $model_commonName->language; ?></skos:note>
      <?php
      }
      
      // check for geography information
      if( !empty($model_commonName->geography) ) {
      ?>
      <skos:note>Geography: <?php echo xml_encode($model_commonName->geography); ?></skos:note>
      <?php
      }
      
      // check for period information
      if( !empty($model_commonName->period) ) {
      ?>
      <skos:note>Period: <?php echo xml_encode($model_commonName->period); ?></skos:note>
      <?php
      }
      ?>
  </skos:Concept>
</rdf:RDF>