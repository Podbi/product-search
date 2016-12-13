<?php
namespace ProductSearchFramework\Cache;

use Cache\Adapter\Common\CacheItem;
use Psr\Cache\CacheItemInterface;

class FilesystemProductCacheItemTransformer implements ProductCacheItemTransformer
{
    public function transform(string $id, $product) : CacheItemInterface
    {
        return new CacheItem($id, true, $product);
    }

    public function reverseTransform(CacheItemInterface $cacheItem)
    {
        return $cacheItem->get();
    }
}
