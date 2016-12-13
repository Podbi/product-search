<?php
namespace ProductSearchFramework\Cache;

use Psr\Cache\CacheItemInterface;

interface ProductCacheItemTransformer
{
    /**
     * @param string $id
     * @param mixed $product
     * @return CacheItemInterface
     */
    public function transform(string $id, $product) : CacheItemInterface;

    /**
     * @param CacheItemInterface $cacheItem
     * @return mixed
     */
    public function reverseTransform(CacheItemInterface $cacheItem);
}
