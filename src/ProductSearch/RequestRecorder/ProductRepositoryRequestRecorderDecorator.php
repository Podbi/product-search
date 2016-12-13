<?php
namespace ProductSearch\RequestRecorder;

use ProductSearch\Repository\ProductRepository;

class ProductRepositoryRequestRecorderDecorator implements ProductRepository
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var ProductRequestRecorder
     */
    private $productRequestRecorder;

    public function __construct(ProductRepository $productRepository, ProductRequestRecorder $productRequestRecorder)
    {
        $this->productRepository = $productRepository;
        $this->productRequestRecorder = $productRequestRecorder;
    }

    public function find($id)
    {
        $product = $this->productRepository->find($id);
        $this->productRequestRecorder->record($id);

        return $product;
    }
}
