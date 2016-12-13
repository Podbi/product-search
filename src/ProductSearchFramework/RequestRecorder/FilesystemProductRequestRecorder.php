<?php

class FilesystemProductRequestRecorder implements \ProductSearch\RequestRecorder\ProductRequestRecorder
{
    /**
     * @var string
     */
    private $fileName;

    public function record($id)
    {
        $rows = file($this->fileName);
    }


}
