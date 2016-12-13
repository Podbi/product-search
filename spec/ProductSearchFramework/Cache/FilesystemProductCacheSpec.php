<?php
namespace spec\ProductSearchFramework\Cache;

use Cache\Adapter\Common\AbstractCachePool;
use PhpSpec\ObjectBehavior;
use ProductSearchFramework\Cache\ProductCacheItemTransformer;
use Prophecy\Argument;
use Psr\Cache\CacheItemInterface;

/**
 * @mixin \ProductSearchFramework\Cache\FilesystemProductCache
 */
class FilesystemProductCacheSpec extends ObjectBehavior
{
    public function let(AbstractCachePool $cachePool, ProductCacheItemTransformer $productCacheItemTransformer)
    {
        $this->beConstructedWith($cachePool, $productCacheItemTransformer);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(\ProductSearchFramework\Cache\FilesystemProductCache::class);
    }

    public function it_should_return_that_cache_has_item_on_product_id(AbstractCachePool $cachePool)
    {
        $id = 42;
        $cachePool->hasItem($id)->willReturn(true);

        $this->hasProduct($id)->shouldReturn(true);
    }

    public function it_should_return_product_form_cache_when_cache_has_product(
        AbstractCachePool $cachePool,
        ProductCacheItemTransformer $productCacheItemTransformer,
        CacheItemInterface $cacheItem
    )
    {
        $id = 42;
        $product = ['id' => $id];

        $cachePool->getItem($id)->willReturn($cacheItem);
        $productCacheItemTransformer->reverseTransform($cacheItem)->willReturn($product);

        $this->loadProduct($id)->shouldReturn($product);
    }

    public function it_should_save_product_to_cache(
        AbstractCachePool $cachePool,
        ProductCacheItemTransformer $productCacheItemTransformer,
        CacheItemInterface $cacheItem
    ) {
        $id = 42;
        $product = ['id' => $id];

        $productCacheItemTransformer->transform($id, $product)->willReturn($cacheItem);
        $cachePool->save($cacheItem)->shouldBeCalled();

        $this->saveProduct($id, $product);
    }
}
