<?php
namespace ProductSearch\Repository;

use ProductSearch\Cache\ProductCache;

class CachedProductRepository implements ProductRepository
{
    /**
     * @var ProductCache
     */
    private $productCache;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductCache $productCache, ProductRepository $productRepository)
    {
        $this->productCache = $productCache;
        $this->productRepository = $productRepository;
    }

    public function find($id)
    {
        if ($this->productCache->hasProduct($id)) {
            return $this->productCache->loadProduct($id);
        }

        $product = $this->productRepository->find($id);
        $this->productCache->saveProduct($id, $product);

        return $product;
    }
}
