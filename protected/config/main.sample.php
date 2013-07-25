<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'OpenUp! Common Names Webservice',
    // preloading 'log' component
    'preload' => array('log', 'PESI', 'NHMW', 'COL', 'CzechPrague', 'AllearterDk', 'ArtsdatabankenNo', 'NewZealandLandcare', 'wboeOeaw', 'SlovakBratislava', 'LuomusFi', 'HebrewLinda', 'RussianPlantarium', 'NameParser', 'NHMWService'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.models.sources.*',
        'application.components.*',
        'application.components.Sources.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'gii',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('192.168.56.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        /*
          'urlManager'=>array(
          'urlFormat'=>'path',
          'rules'=>array(
          '<controller:\w+>/<id:\d+>'=>'<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
          '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
          ),
          ),
         */
        /* 'db'=>array(
          'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
          ), */
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=openup',
            'emulatePrepare' => true,
            'username' => 'openup',
            'password' => 'openup',
            'charset' => 'utf8',
        ),
        /* 'errorHandler'=>array(
          // use 'site/error' action to display errors
          'errorAction'=>'site/error',
          ), */
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
        /*
         * Webservice components for use with the common names service
         * NOTE: Do not forget to add to preload option
         */
        'PESI' => array(
            'class' => 'PESI'
        ),
        'NHMW' => array(
            'class' => 'NHMW'
        ),
        'COL' => array(
            'class' => 'COL'
        ),
        'CzechPrague' => array(
            'class' => 'CzechPrague'
        ),
        'AllearterDk' => array(
            'class' => 'AllearterDk'
        ),
        'ArtsdatabankenNo' => array(
            'class' => 'ArtsdatabankenNo'
        ),
        'NewZealandLandcare' => array(
            'class' => 'NewZealandLandcare'
        ),
        'wboeOeaw' => array(
            'class' => 'wboeOeaw'
        ),
        'SlovakBratislava' => array(
            'class' => 'SlovakBratislava'
        ),
        'LuomusFi' => array(
            'class' => 'LuomusFi'
        ),
        'HebrewLinda' => array(
            'class' => 'HebrewLinda'
        ),
        'RussianPlantarium' => array(
            'class' => 'RussianPlantarium'
        ),

        'NameParser' => array(
            'class' => 'NameParser'
        ),
        'NHMWService' => array(
            'class' => 'NHMWService'
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        'adminEmail' => 'wolfgang.koller@nhm-wien.ac.at',
        'nameParser' => array(
            'address' => '127.0.0.1',   // IP-address of nameParser service
            'port' => 4334,             // port of nameParser service
            'timeout' => 1,             // timeout in seconds
        ),
    ),
);
