<?php
namespace RazonYang\Yii2\Uploader\Tests;

use RazonYang\Yii2\Uploader\UploadModelTrait;
use yii\base\Model;
use yii\web\ForbiddenHttpException;

class TestModel extends Model
{
    use UploadModelTrait;

    public function upload()
    {
        if (!$this->validate()) {
            throw new ForbiddenHttpException('invalid file');
        }
        
        $url = UploadModelTrait::upload();
        return [
            'filename' => basename($url),
            'url' => $url,
        ];
    }
}
