<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language'=>'zh-EN',
    'components' => [
        'i18n' => [
            'translations' => [
                'cn' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '/messages',
                    'fileMap' => [
                        'cn' => 'common.php',
                    ],
                ],
                'en' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '/messages',
                    'fileMap' => [
                        'en' => 'common.php',
                    ],
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix'=>'.html',
            'rules' => [
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => [
                        //如何设置本地jquery文件路径
                    ]
                ],
            ],
        ],
    ],
    'modules' => [              // 模块配置
        'calendar' => [
            'class' => 'backend\modules\calendar\CalendarModule',
        ],
        'user' => [
            'class' =>'backend\modules\user\UserModule',
        ],
    ],
    'params' => $params,
];
