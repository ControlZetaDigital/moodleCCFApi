<?php

class BaseController
{
    protected $strErrorDesc;
    protected $strErrorHeader;
    protected $requestMethod;
    protected $params;

    public function __construct()
    {
        $this->strErrorDesc = false;
        $this->strErrorHeader = false;
        $this->requestMethod = $_SERVER["REQUEST_METHOD"];
        $this->params = $this->getQueryStringParams();
    }
    /**
     * __call magic method.
     */
    public function __call($name, $arguments)
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }
 
    /**
     * Get URI elements.
     * 
     * @return array
     */
    public function getUriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
 
        return $uri;
    }
 
    /**
     * Get querystring params.
     * 
     * @return array
     */
    protected function getQueryStringParams()
    {
        $query = [];
        parse_str($_SERVER['QUERY_STRING'], $query);
        return $query;
    }

    protected function validateOutput()
    {
        // send output
        if (!$this->strErrorDesc) {
            $this->sendOutput(
                $this->responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $this->strErrorDesc)), 
                array('Content-Type: application/json', $this->strErrorHeader)
            );
        }
    }
 
    /**
     * Send API output.
     *
     * @param mixed  $data
     * @param string $httpHeader
     */
    protected function sendOutput($data, $httpHeaders=array())
    {
        header_remove('Set-Cookie');
 
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
 
        echo $data;
        exit;
    }
}