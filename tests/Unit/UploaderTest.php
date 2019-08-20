<?php
namespace RazonYang\Yii2\Setting\Tests\Unit;

use Codeception\Test\Unit;
use RazonYang\Yii2\Uploader\Uploader;

class UploaderTest extends Unit
{
    private $host = 'http://localhost/';

    private function createUploader(): Uploader
    {
        return new Uploader([
            'host' => $this->host,
        ]);
    }

    /**
     * @dataProvider dataProviderHost
     */
    public function testHost(string $host, string $expected): void
    {
        $uploader = $this->createUploader();
        $uploader->setHost($host);
        $this->assertSame($expected, $uploader->getHost());
    }

    public function dataProviderHost(): array
    {
        return [
            ['http://localhost', 'http://localhost/'],
            ['http://localhost/', 'http://localhost/'],
        ];
    }

    /**
     * @dataProvider dataProviderPath
     */
    public function testGetUrl(string $path, string $url): void
    {
        $uploader = $this->createUploader();
        $this->assertSame($url, $uploader->getUrl($path));
    }

    public function dataProviderPath(): array
    {
        return [
            ['foo.jpg', $this->host . 'foo.jpg'],
            ['bar.mp4', $this->host . 'bar.mp4'],
        ];
    }

    /**
     * @dataProvider dataProviderUrl
     */
    public function testGetPath(string $url, string $path): void
    {
        $uploader = $this->createUploader();
        $this->assertSame($path, $uploader->getPath($url));
    }

    public function dataProviderUrl(): array
    {
        return [
            [$this->host . 'foo.jpg', 'foo.jpg'],
            [$this->host . 'bar.mp4','bar.mp4'],
        ];
    }

    // TODO
    public function testSave(): void
    {
    }

    // TODO
    public function testSaveStream(): void
    {
    }

    // TODO
    public function testSaveFile(): void
    {
    }
}
