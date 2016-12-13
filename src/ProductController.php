<?php
use \ProductSearch\Repository\ProductRepository;
use \ProductSearchFramework\ResponseFactory\ResponseFactory;

class ProductController
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    public function __construct(ProductRepository $productRepository, ResponseFactory $responseFactory)
    {
        $this->productRepository = $productRepository;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @param string $id
     * @return string
     */
    public function detail($id)
    {
        $product = $this->productRepository->find($id);

        return $this->responseFactory->createResponse($product);
    }
}
