<?php
namespace spec\ProductSearchFramework\Cache;

use PhpSpec\ObjectBehavior;
use ProductSearchFramework\Cache\ProductCacheItemTransformer;
use Prophecy\Argument;
use Psr\Cache\CacheItemInterface;

/**
 * @mixin \ProductSearchFramework\Cache\FilesystemProductCacheItemTransformer
 */
class FilesystemProductCacheItemTransformerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(\ProductSearchFramework\Cache\FilesystemProductCacheItemTransformer::class);
    }

    public function it_should_implement_product_cache_item_transformer()
    {
        $this->shouldHaveType(ProductCacheItemTransformer::class);
    }

    public function it_should_transform_product_to_cache_item()
    {
        $id = 42;
        $product = ['id' => $id];

        $this->transform($id, $product)->shouldReturnAnInstanceOf(CacheItemInterface::class);
    }

    public function it_should_reverse_transform_cache_item_to_product(CacheItemInterface $cacheItem)
    {
        $product = ['id' => 42];
        $cacheItem->get()->willReturn($product);

        $this->reverseTransform($cacheItem)->shouldReturn($product);
    }
}
