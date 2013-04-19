<?php

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
$front->setControllerDirectory('/var/www/apps/suma/service/controllers')
      ->setBaseUrl('/sumaserver') // set the base url
      ->throwExceptions(true);

// Go
$front->dispatch();
