<?php
namespace ProductSearchFramework\ResponseFactory;

use ProductSearchFramework\Json\JsonParser;

class JsonResponseFactory implements ResponseFactory
{
    /**
     * @var JsonParser
     */
    private $jsonParser;

    public function __construct(JsonParser $jsonParser)
    {
        $this->jsonParser = $jsonParser;
    }

    public function createResponse($data)
    {
        return $this->jsonParser->encode($data);
    }

}
