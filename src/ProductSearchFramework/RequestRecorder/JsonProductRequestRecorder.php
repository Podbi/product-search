<?php
namespace ProductSearchFramework\RequestRecorder;

use ProductSearch\RequestRecorder\ProductRequestRecorder;
use ProductSearch\RequestRecorder\ProductRequestRecorderRepository;
use ProductSearchFramework\Json\JsonParser;

class JsonProductRequestRecorder implements ProductRequestRecorder
{
    /**
     * @var ProductRequestRecorderRepository
     */
    private $productRequestRecorderRepository;

    /**
     * @var JsonParser
     */
    private $jsonParser;

    public function __construct(
        ProductRequestRecorderRepository $productRequestRecorderRepository,
        JsonParser $jsonParser
    ) {
        $this->productRequestRecorderRepository = $productRequestRecorderRepository;
        $this->jsonParser = $jsonParser;
    }

    public function record($id)
    {
        $records = $this->jsonParser->decode($this->productRequestRecorderRepository->read());

        if (!isset($records[$id])) {
            $records[$id] = 0;
        }

        ++$records[$id];

        $this->productRequestRecorderRepository->write($this->jsonParser->encode($records));
    }

}
