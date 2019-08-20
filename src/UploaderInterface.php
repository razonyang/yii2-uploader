<?php
namespace RazonYang\Yii2\Uploader;

interface UploaderInterface
{
    /**
     * Returns the url of the resource.
     *
     * @param string $path
     *
     * @return string
     */
    public function getUrl(string $path): string;

    /**
     * Returns the path from the url.
     *
     * @param string $url
     *
     * @return string
     */
    public function getPath(string $url): string;

    /**
     * Saves content.
     *
     * @param string $path
     * @param string $content
     * @param bool   $overwrite whether overwrite if exists.
     *
     * @return string $url the url of resource.
     *
     * @throws \Throwable
     */
    public function save(string $path, string $content, bool $overwrite = false): string;

    /**
     * Saves stream.
     *
     * @param string   $path
     * @param resource $stream
     * @param bool     $overwrite whether overwrite if exists.
     *
     * @return string $url the url of resource.
     *
     * @throws \Throwable
     */
    public function saveStream(string $path, $stream, bool $overwrite = false): string;

    /**
     * Saves file.
     *
     * @param string $path
     * @param string $filename
     * @param bool   $overwrite whether overwrite if exists.
     *
     * @return string $url the url of resource.
     *
     * @throws \Throwable
     */
    public function saveFile(string $path, string $filename, bool $overwrite = false): string;
}
