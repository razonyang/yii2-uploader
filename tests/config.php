<?php

return [
    'id' => 'test',
    'basePath' => __DIR__,
    'components' => [
        'uploader' => [
            'class' => \RazonYang\Yii2\Uploader\Uploader::class,
            'filesystem' => [
                'class' => \creocoder\flysystem\LocalFilesystem::class,
                'path' => __DIR__ . '/_output',
            ],
        ],
    ],
];
