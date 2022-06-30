<?php
class FieldsController extends BaseController
{
    /**
     * "/fields/get" Endpoint - Get fields list by course id
     */
    public function getAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
 
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $fieldsModel = new FieldsModel();

                $courseID = 0;
                if (isset($arrQueryStringParams['id']) && $arrQueryStringParams['id']) {
                    $courseID = $arrQueryStringParams['id'];
                }
 
                $arrFields = $fieldsModel->getFields($courseID);
                $responseData = json_encode($arrFields);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}