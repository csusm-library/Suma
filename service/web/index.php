<?php

<<<<<<< HEAD
=======
// Config
require_once "lib/spyc/Spyc.php";

// Check that config exists
if (!is_readable('config/config.yaml'))
{
   header("HTTP/1.1 500 Internal Server Error");
    echo "<h1>500 Internal Server Error</h1>";
    echo "<p><strong>service/web/config/config.yaml</strong> does not exist or is not readable.</p>";
    die;
}

// Read config file
$config = Spyc::YAMLLoad('config/config.yaml');

// Path Configuration
$SUMA_SERVER_PATH = $config['SUMA_SERVER_PATH'];
$SUMA_CONTROLLER_PATH = $config['SUMA_CONTROLLER_PATH'];
$SUMA_BASE_URL = $config['SUMA_BASE_URL'];

// Debug Mode Setup
if ($config['SUMA_DEBUG'] == true)
{
    $SUMA_ERROR_REPORTING  = E_ERROR | E_WARNING | E_PARSE | E_NOTICE;
    $SUMA_DISPLAY_ERRORS   = 'on';
    $SUMA_THROW_EXCEPTIONS =  true;
}
else
{
    $SUMA_ERROR_REPORTING  = 0;
    $SUMA_DISPLAY_ERRORS   = 'off';
    $SUMA_THROW_EXCEPTIONS =  false;
}

>>>>>>> d4131c56cfba78e3b0877836030991fbb6c01e1c
// Error Reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 'on');

// Set paths
ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . '/usr/share/php');
ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . '/var/www/apps/suma/service');

// Zend Framework CLass Loader
require_once "Zend/Loader.php";

require_once "config/Globals.php";

Zend_Loader::loadClass('Zend_Controller_Front');

// Get front controller instance
// Configure for Zone
$front = Zend_Controller_Front::getInstance();
<<<<<<< HEAD
$front->setControllerDirectory('/var/www/apps/suma/service/controllers')
      ->setBaseUrl('/sumaserver') // set the base url
      ->throwExceptions(true);
=======
$front->setControllerDirectory($SUMA_CONTROLLER_PATH)
      ->setBaseUrl($SUMA_BASE_URL);

Zend_Registry::set('sumaDisplayExceptions', $SUMA_THROW_EXCEPTIONS);
>>>>>>> d4131c56cfba78e3b0877836030991fbb6c01e1c

// Go
$front->dispatch();
