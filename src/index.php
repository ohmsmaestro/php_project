// index.php (Front Controller)
<?php
// Get the request URI
//require 'vendor/autoload.php';
//$app = new \Slim\App();
$requestUri = $_SERVER['REQUEST_URI'];

// Route based on the request URI
switch ($requestUri) {
    case '/webhook1':
        require 'webhook1.php';
        break;
    case '/webhook2':
        require 'webhook2.php';
        break;
    case '/webhook3':
        require 'webhook3.php';
        break;
    case '/initiatepayfast':
        require 'initiatepayfast.php';
        break;
    default:
        require 'getrequest.php';
        break;
}
?>