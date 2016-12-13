<?php
namespace ProductSearchFramework\RequestRecorder;

use ProductSearch\RequestRecorder\ProductRequestRecorder;
use ProductSearch\RequestRecorder\ProductRequestRecorderRepository;

class JsonProductRequestRecorder implements ProductRequestRecorder
{
    /**
     * @var ProductRequestRecorderRepository
     */
    private $productRequestRecorderRepository;

    /**
     * @var JsonProductRequestParser
     */
    private $jsonProductRequestParser;

    public function __construct(
        ProductRequestRecorderRepository $productRequestRecorderRepository,
        JsonProductRequestParser $jsonProductRequestParser
    ) {
        $this->productRequestRecorderRepository = $productRequestRecorderRepository;
        $this->jsonProductRequestParser = $jsonProductRequestParser;
    }

    public function record($id)
    {
        $records = $this->jsonProductRequestParser->decode($this->productRequestRecorderRepository->read());

        if (!isset($records[$id])) {
            $records[$id] = 0;
        }

        ++$records[$id];

        $this->productRequestRecorderRepository->write($this->jsonProductRequestParser->encode($records));
    }

}
