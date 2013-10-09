<?php
/**
 * Wrapper controller for the GBIF name parser
 * See https://github.com/GlobalNamesArchitecture/biodiversity or
 * https://rubygems.org/gems/biodiversity19 for details
 *
 * @author wkoller
 */
class NameParser extends CComponent {
    /**
     * @var resource 
     */
    private $m_socket = NULL;
    
    private $m_connected = false;
    
    /**
     * initialize the NameParser component
     */
    public function init() {
        try {
            // check for sockets support
            if( !extension_loaded('sockets') ) {
                throw new Exception('Sockets extension required!');
            }
        
            // create a socket for communication with the nameParser service
            $this->m_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            // create a short timeout to not block the service
            socket_set_option($this->m_socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => Yii::app()->params['nameParser']['timeout'], 'usec' => 0)); 
            socket_set_option($this->m_socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => Yii::app()->params['nameParser']['timeout'], 'usec' => 0)); 
            // connect to the service
            $this->m_connected = socket_connect($this->m_socket, Yii::app()->params['nameParser']['address'], Yii::app()->params['nameParser']['port']);
        }
        catch(Exception $e) {
            error_log('[NameParser] ' . $e->getMessage());
            
            $this->m_socket = NULL;
            $this->m_connected = false;
        }
    }
    
    /**
     * Clean (remove authors or other components) a given name by using the nameParser service
     * @param string $name
     * @return string
     */
    public function clean($name) {
        // try to parse the name
        $response = $this->parse($name);
        
        // return canonical form if available
        if( $response != NULL ) return $response['canonical'];
        
        // by default return the input name
        return $name;
    }

    /**
     * Send a name to the nameParser service and parse the result
     * @param string $name Name string to parse
     * @return array|null Parsed information or NULL if error/not available
     */
    public function parse($name) {
        // only ask service if connected
        if( $this->m_connected ) {
            // prepare query for service
            $query = trim($name) . "\n";

            // Send the query to the nameParser service
            socket_write($this->m_socket, $query);
            $response = socket_read($this->m_socket, 4096, PHP_NORMAL_READ);
            $response = json_decode($response, true);

            // check for valid response
            if( is_array($response) &&
                isset($response['scientificName']) &&
                is_array($response['scientificName'])
            ) {
                // check if name was successfully parsed
                if( $response['scientificName']['parsed'] == true ) {
                    return $response['scientificName'];
                }
            }
        }
        
        // return NULL if parsing is not possible
        return NULL;
    }
}
