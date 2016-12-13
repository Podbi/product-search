<?php
namespace ProductSearch\RequestRecorder;

interface ProductRequestRecorderRepository
{
    /**
     * @return mixed
     */
    public function read();

    /**
     * @param mixed $content
     */
    public function write($content);
}
