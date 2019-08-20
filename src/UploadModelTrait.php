<?php
namespace RazonYang\Yii2\Uploader;

use yii\di\Instance;
use yii\web\UploadedFile;
use Yii;

/**
 * UploadModelTrait defines an universal upload logic.
 */
trait UploadModelTrait
{
    /**
     * @var UploadedFile
     */
    public $file;

    /**
     * @var UploaderInterface
     */
    public $uploader = 'uploader';

    /**
     * @var string
     */
    public $tooBig;

    /**
     * @var string
     */
    public $tooSmall;

    public function init()
    {
        parent::init();

        if ($this->tooBig === null) {
            $this->tooBig = Yii::t('yii', 'The file "{file}" is too big. Its size cannot exceed {formattedLimit}.');
        }
        if ($this->tooSmall === null) {
            $this->tooSmall = Yii::t('yii', 'The file "{file}" is too small. Its size cannot be smaller than {formattedLimit}.');
        }

        $this->uploader = Instance::ensure($this->uploader, UploaderInterface::class);
    }

    /**
     * @var array a list of file name extensions that are allowed to be uploaded.
     */
    private $extensions = [];

    /**
     * Returns allowed extensions.
     *
     * @return array
     */
    public function getExtensions(): array
    {
        return $this->extensions;
    }

    /**
     * Sets allowed extensions.
     *
     * @param string|array $extensions
     */
    public function setExtensions($extensions)
    {
        $this->extensions = is_array($extensions) ? $extensions : explode(',', $extensions);
    }

    /**
     * @var int the minimum number of bytes required for the uploaded file.
     */
    public $minSize;

    /**
     * @var int the maximum number of bytes required for the uploaded file.
     */
    public $maxSize;

    /**
     * @var array|string a list of file MIME types that are allowed to be uploaded.
     */
    public $mimeTypes;

    /**
     * @var bool whether to check file type (extension) with mime-type. If extension produced by
     * file mime-type check differs from uploaded file extension, the file will be considered as invalid.
     */
    public $checkExtensionByMimeType = true;

    public function rules()
    {
        return [
            [['file'], 'required'],
            [
                'file',
                'file',
                'extensions' => $this->extensions,
                'mimeTypes' => $this->mimeTypes,
                'checkExtensionByMimeType' => $this->checkExtensionByMimeType,
                'minSize' => $this->minSize,
                'maxSize' => $this->maxSize,
                'tooBig' => $this->tooBig,
                'tooSmall' => $this->tooSmall,
            ],
        ];
    }

    /**
     * Returns the filename.
     *
     * @return string
     */
    protected function getFilename(): string
    {
        $filename = md5(uniqid('', true));
        $extension = $this->file->getExtension();
        if ($extension) {
            $filename .= '.' . $extension;
        }

        $paths = [
            date('Ymd'),
            $filename
        ];
        
        return implode('/', array_filter($paths));
    }

    /**
     * Uploads file and returns the URL, it is your responsibility to validate before uploading.
     *
     * @return string
     */
    protected function upload(): string
    {
        $filename = $this->getFilename();
        return $this->uploader->saveFile($filename, $this->file->tempName);
    }
}
