<?php
namespace ProductSearchFramework\ResponseFactory;

interface ResponseFactory
{
    /**
     * @param mixed $data
     * @return string
     */
    public function createResponse($data);
}
