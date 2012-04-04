<?php

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'testing'));

$application = require_once '../scripts/bootstrap.php';
$application->bootstrap('autoloader');

require_once 'ModelTestCase.php';