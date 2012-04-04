<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    ||
    define('APPLICATION_ENV',
    (get_cfg_var('APPLICATION_ENV') ? get_cfg_var('APPLICATION_ENV') :
        (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') :
            'production'
        )
    )
    );

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

$config = APPLICATION_PATH . '/configs/application.ini';
if (APPLICATION_ENV !== 'production' && file_exists(APPLICATION_PATH . '/configs/user.ini')) {
    /** Zend_Config_Ini */
    require_once 'Zend/Config/Ini.php';

    $config = new Zend_Config_Ini($config, APPLICATION_ENV, array('allowModifications' => true));
    $config->merge(new Zend_Config_Ini(APPLICATION_PATH . '/configs/user.ini', APPLICATION_ENV));
}

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    $config
);

return $application;