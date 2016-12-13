<?php
namespace ProductSearchFramework\Cache;

use Cache\Adapter\Common\AbstractCachePool;
use ProductSearch\Cache\ProductCache;

class FilesystemProductCache implements ProductCache
{
    /**
     * @var AbstractCachePool
     */
    private $cachePool;

    /**
     * @var ProductCacheItemTransformer
     */
    private $productCacheItemTransformer;

    public function __construct(
        AbstractCachePool $cachePool,
        ProductCacheItemTransformer $productCacheItemTransformer
    ) {
        $this->cachePool = $cachePool;
        $this->productCacheItemTransformer = $productCacheItemTransformer;
    }

    public function hasProduct(string $id): bool
    {
        return $this->cachePool->hasItem($id);
    }

    public function loadProduct(string $id)
    {
        return $this->productCacheItemTransformer->reverseTransform($this->cachePool->getItem($id));
    }

    public function saveProduct(string $id, $product)
    {
        $this->cachePool->save($this->productCacheItemTransformer->transform($id, $product));
    }
}
