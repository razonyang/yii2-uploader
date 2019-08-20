Yii2 Uploader
=============

[![Build Status](https://travis-ci.org/razonyang/yii2-uploader.svg?branch=master)](https://travis-ci.org/razonyang/yii2-uploader)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/razonyang/yii2-uploader/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/razonyang/yii2-uploader/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/razonyang/yii2-uploader/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/razonyang/yii2-uploader/?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/razonyang/yii2-uploader.svg)](https://packagist.org/packages/razonyang/yii2-uploader)
[![Total Downloads](https://img.shields.io/packagist/dt/razonyang/yii2-uploader.svg)](https://packagist.org/packages/razonyang/yii2-uploader)
[![LICENSE](https://img.shields.io/github/license/razonyang/yii2-uploader)](LICENSE)


Installation
------------

```
composer require razonyang/yii2-uploader
```

Usage
-----

Configuration:

```php
return [
    'components' => [
        'uploader' => [
            'class' => \RazonYang\Yii2\Uploader\Uploader::class,
            'host' => 'http://localhost/resources', // the hostname relative to your uploaded files
            'filesystem' => [
                // filesystem 
                'class' => \creocoder\flysystem\LocalFilesystem::class,
                'path' => '@webroot/resources',
            ],
        ],
    ],
];
```

And then defines a form, `UploadForm`

```php
class UploadForm extends \yii\base\Model
{
    use \RazonYang\Yii2\Uploader\UploadModelTrait;

    public function handle()
    {
        if (!$this->validate()) {
            // handles error
            throw new \Exception('invalid file');
        }

        $url = $this->upload();
        return [
            'url' => $url,
            // ... other information
        ];
    }
}

class UploadController extends \yii\web\Controller
{
    public function actionUpload()
    {
        $form = new UploadForm([
            'file' => \yii\web\UploadedFile::getInstanceByName('file')
        ]);
        return $form->handle();
    }
}
```