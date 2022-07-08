<?php
class AuthController extends BaseController
{
    public function authToken()
    {
        if (strtoupper($this->requestMethod) == 'GET') {
            try {
                if (isset($this->params['token']) && $this->params['token']) {                    
                    $api = new webservice();
                    $api->authenticate_user($this->params['token']);
                } else {
                    $this->strErrorDesc = 'No auth token found';
                    $this->strErrorHeader = 'HTTP/1.1 401 Unauthorized';                    
                }
            } catch (moodle_exception $e) {
                $this->strErrorDesc = $e->getMessage();
                $this->strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            } catch (webservice_access_exception $e) {
                $this->strErrorDesc = $e->getMessage();
                $this->strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            } catch (Error $e) {
                $this->strErrorDesc = $e->getMessage();
                $this->strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $this->strErrorDesc = 'Method not supported';
            $this->strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }        

        if ($this->strErrorDesc && $this->strErrorHeader) 
        {
            $this->validateOutput();
        }
    }
}