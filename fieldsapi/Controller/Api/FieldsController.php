<?php
class FieldsController extends BaseController
{
    /**
     * "/fields/get" Endpoint - Get fields list by course id
     */
    protected $responseData;

    public function getAction()
    {
        if (strtoupper($this->requestMethod) == 'GET') {
            try {
                $fieldsModel = new FieldsModel();

                $courseID = 0;
                if (isset($this->params['id']) && $this->params['id']) {
                    $courseID = $this->params['id'];
                }
 
                $response = $fieldsModel->getFields($courseID);
                $this->responseData = json_encode($response);
            } catch (Error $e) {
                $this->strErrorDesc = $e->getMessage();
                $this->strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $this->strErrorDesc = 'Method not supported';
            $this->strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        $this->validateOutput();
    }
}