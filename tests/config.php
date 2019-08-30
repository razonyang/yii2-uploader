<?php

return [
    'id' => 'test',
    'basePath' => __DIR__,
    'components' => [
        'filesystem' => [
            'class' => \creocoder\flysystem\LocalFilesystem::class,
            'path' => __DIR__ . '/_output',
        ],
        'uploader' => [
            'class' => \RazonYang\Yii2\Uploader\Uploader::class,
        ],
    ],
];
