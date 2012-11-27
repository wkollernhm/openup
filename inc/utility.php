<?php
require( "CachedSoapClient.php" );

/**
 * Small helper function for converting ugly escaped utf-8 characters to their real utf-8 characters
 * (since json_encode forces the escaping, which however is not necessary)
 * @param array $matches Matches from preg_replace_callback
 * @return string String containing the actual utf-8 characters 
 */
function utf8_correct_callback($matches) {
    return html_entity_decode('&#'.hexdec($matches[1]).';', ENT_NOQUOTES, 'UTF-8');
}

