<?php

require __DIR__ . "/inc/bootstrap.php";
require PROJECT_ROOT_PATH . "/Controller/Api/FieldsController.php";

$objFeedController = new FieldsController();
$uri = $objFeedController->getUriSegments();

if ((isset($uri[3]) && $uri[3] != 'fields') || !isset($uri[4])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}
 
$strMethodName = $uri[4] . 'Action';
$objFeedController->{$strMethodName}();