<?php
namespace RazonYang\Yii2\Uploader;

use creocoder\flysystem\Filesystem;
use creocoder\flysystem\LocalFilesystem;
use yii\base\Component;
use yii\di\Instance;

/**
 * Uploader
 *
 * @property string $host
 */
class Uploader extends Component implements UploaderInterface
{
    /**
     * @var Filesystem $filesystem
     */
    public $filesystem = [
        'class' => LocalFilesystem::class,
        'path' => '@webroot/resources',
    ];

    /**
     * @var string $host hostname
     */
    private $host = 'http://localhost/';

    /**
     * Returns hostname.
     *
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * Sets hostname
     *
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = rtrim($host, '/') . '/';
    }

    public function init()
    {
        parent::init();

        $this->filesystem = Instance::ensure($this->filesystem, FileSystem::class);
    }

    public function getUrl(string $path): string
    {
        return $this->host . ltrim($path, '/');
    }

    public function getPath(string $url): string
    {
        return str_replace($this->host, '', $url);
    }

    public function save(string $path, string $content, bool $overwrite = false): string
    {
        if ($overwrite) {
            $saved = $this->filesystem->put($path, $content);
        } else {
            $saved = $this->filesystem->write($path, $content);
        }
        if (!$saved) {
            throw \RuntimeException('Unable to save stream as ' . $path);
        }
        return $this->getUrl($path);
    }

    public function saveStream(string $path, $resource, bool $overwrite = false): string
    {
        if ($overwrite) {
            $saved = $this->filesystem->putStream($path, $resource);
        } else {
            $saved = $this->filesystem->writeStream($path, $resource);
        }
        if (!$saved) {
            throw \RuntimeException('Unable to save stream as ' . $path);
        }
        return $this->getUrl($path);
    }

    public function saveFile(string $path, string $filename, bool $overwrite = false): string
    {
        $stream = fopen($filename, 'r');
        if ($stream === false) {
            throw new \RuntimeException('Unable to read stream of ' . $filename);
        }
        $url = $this->saveStream($path, $stream, $overwrite);
        fclose($stream);
        return $url;
    }
}
