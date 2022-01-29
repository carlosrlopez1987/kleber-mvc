<?php
namespace core;


class Request
{
    
    
    
    protected $_request = array();
    
    public function __construct()
    {
        $this->_request[ 'method' ]      = $_SERVER[ 'REQUEST_METHOD' ];
        $this->_request[ 'host' ]        = $_SERVER[ 'HTTP_HOST' ];
        $this->_request[ 'server_name' ] = $_SERVER[ 'SERVER_NAME' ];
        $this->_request[ 'server_addr' ] = $_SERVER[ 'SERVER_ADDR' ];
        $this->_request[ 'port' ]        = $_SERVER[ 'SERVER_PORT' ];
        $this->_request[ 'remote_addr' ] = $_SERVER[ 'REMOTE_ADDR' ];
        $this->_request[ 'scheme' ]      = $_SERVER[ 'REQUEST_SCHEME' ];
        $this->_request[ 'url' ]         = $_SERVER[ 'REQUEST_URI' ];
        $this->_request[ 'action' ]      = '';
        $this->_request[ 'params' ]      = array();
        
        $this->parse_params();
        
    }
    
    public function params()
    {
        return $this->_request['params'];
    }
    public function page()
    {
        return $this->_request[ 'url' ];
    }
    public function method()
    {
        return $this->_request[ 'method' ];
    }
    public function scheme()
    {
        return $this->_request[ 'scheme' ];
    }
    
    private function parse_params()
    {
        $url = ltrim( $this->_request[ 'url' ], '/' );
        
        if ( $url != '' )
        {
            $url_exploded= explode( '/', $url );
            
            $this->_request[ 'url' ]    = $url_exploded[ 0 ];
            $this->_request[ 'action' ] = $url_exploded[ 1 ];
            
            unset( $url_exploded[ 0 ] );
            unset( $url_exploded[ 1 ] );
            
            $url_ = $url_exploded;
            
            if ( count( $url_ ) > 0 )
            {
                foreach( $url_ as $value )
                {
                    array_push( $this->_request[ 'params' ], $value );
                }
            }
            
        }
        else
        {
            $this->_request[ 'url' ] = array( 'default' => 'index' );
        }
        
    }
    
    
}

