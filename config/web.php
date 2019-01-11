<?php

//$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$params = require __DIR__ . '/params.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'params' => $params,
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '4dw5Aev1ctGLgcjsVgL7r4zFOO2IZSTW',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser']
        ],
        'response' => [
            'formatters' => [
                \yii\web\Response::FORMAT_JSON => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                    // ...
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            //Coockie based login (Remember me)
            'enableAutoLogin' => false,
            //THIS WILL DISABLE WEB_AUTHENTIFICATION
            'enableSession' => false,
            'loginUrl' => null
        ],
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'viewPath' => '@app/mail',
            'transport' => [
                'class' => Swift_SmtpTransport::class,
                'host' => $params['host'],
                'username' => $params['username'],
                'password' => $params['password'],
                'port' => $params['port'],
                'encryption' => $params['encryption']
            ],
            'useFileTransport' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'assetManager' => [
            'bundles' => [
                'app\assets\CustomAsset' => [],
                'app\assets\BootBoxAsset' => [],
                'app\assets\UserAsset' => [],
                'app\assets\MailTemplateNewYearAsset' => []
            ],
            'linkAssets' => true,
            'appendTimestamp' => true
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'class' => 'yii\rest\UrlRule', 'controller' => 'user-api'
            ]
        ],
        'authManager' => [
            'class' => \yii\rbac\PhpManager::class
        ],
        'formatter' => [
            'locale' => 'ka-GE'
        ]
    ],
    //'catchAll' => ['site/under-construction'],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
