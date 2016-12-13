<?php
namespace ProductSearchFramework\RequestRecorder;

use League\Flysystem\FilesystemInterface;
use ProductSearch\RequestRecorder\ProductRequestRecorderRepository;

class FileProductRequestRecorderRepository implements ProductRequestRecorderRepository
{
    /**
     * @var FilesystemInterface
     */
    private $filesystem;

    /**
     * @var string
     */
    private $fileName;

    public function __construct(FilesystemInterface $filesystem, string $fileName)
    {
        $this->filesystem = $filesystem;
        $this->fileName = $fileName;
    }

    /**
     * @return false|string
     */
    public function read()
    {
        if ($this->isFileNotCreated()) {
            $this->createFile();
        }

        return $this->getFileContent();
    }

    /**
     * @param string $content
     */
    public function write($content)
    {
        $this->putFileContent($content);
    }

    private function isFileNotCreated() : bool
    {
        return !$this->filesystem->has($this->fileName);
    }

    private function createFile()
    {
        $this->filesystem->write($this->fileName, '');
    }

    private function getFileContent()
    {
        return $this->filesystem->read($this->fileName);
    }

    private function putFileContent(string $content)
    {
        $this->filesystem->write($this->fileName, $content);
    }

}
