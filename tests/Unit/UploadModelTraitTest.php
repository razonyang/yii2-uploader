<?php
namespace RazonYang\Yii2\Setting\Tests\Unit;

use Codeception\Test\Unit;
use RazonYang\Yii2\Uploader\Tests\TestModel;
use yii\web\UploadedFile;

class UploadModelTraitTest extends Unit
{
    private function createModel(): TestModel
    {
        return new TestModel();
    }

    /**
     * @dataProvider dataProviderExtensions
     */
    public function testExtensions($extensions, array $expected): void
    {
        $model = $this->createModel();
        $model->setExtensions($extensions);
        $this->assertEquals($expected, $model->getExtensions());
    }

    public function dataProviderExtensions(): array
    {
        return [
            ['jpg', ['jpg']],
            ['jpg,gif', ['jpg','gif']],
            [['jpg'], ['jpg']],
            [['jpg', 'gif'], ['jpg','gif']],
        ];
    }

    public function testRules(): void
    {
        $this->assertIsArray($this->createModel()->rules());
    }

    // TODO
    public function testUpload(): void
    {
    }
}
