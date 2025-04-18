<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$menu = require __DIR__ . '/menu.php';

$paramsLocal = __DIR__ . '/params-local.php';
if (file_exists($paramsLocal)) {
    $params = require $paramsLocal;
}

$config = [
    'id' => 'basic',
    'language' => 'ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layout' => 'mainDesign',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ZBlS6EcGB7klfB_4ESz8RUM-hfQEUsyF',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
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

        // Маршрутизатор
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // то как в url       =>   какой контроллер и экшен стартанет по этому url
                //'cat/view/<id:\d+>' => 'cat/view',
                // \d+  - это регулярное выражение (число)
                '/cat/create-cats/<count:\d+>' => '/cat/create-cats',
                '/super-rom' => '/user/index',
                //'my-api-cat/get-by-name/<name:[^/]+>' => 'my-api-cat/get-by-name',
                'my-api-cat/v1/delete/<id:\d+>' => 'my-api-cat/delete',
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api-cat'],
            ],
        ],

    ],
    'params' => array_merge($params, $menu),
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
