<?php
namespace spec\ProductSearch\Repository;

use PhpSpec\ObjectBehavior;
use ProductSearch\Cache\ProductCache;
use ProductSearch\Repository\ProductRepository;
use Prophecy\Argument;

/**
 * @mixin \ProductSearch\Repository\CachedProductRepository
 */
class CachedProductRepositorySpec extends ObjectBehavior
{
    public function let(ProductCache $productCache, ProductRepository $productRepository)
    {
        $this->beConstructedWith($productCache, $productRepository);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(\ProductSearch\Repository\CachedProductRepository::class);
    }

    public function it_should_implement_product_repository()
    {
        $this->shouldHaveType(ProductRepository::class);
    }

    public function it_should_get_product_from_cache_when_product_is_in_cache(
        ProductCache $productCache,
        ProductRepository $productRepository
    ) {
        $id = '42';
        $product = ['id' => $id];

        $productCache->hasProduct($id)->willReturn(true);
        $productCache->loadProduct($id)->willReturn($product);
        $productRepository->find($id)->shouldNotBeCalled();
        $productCache->saveProduct($id, $product)->shouldNotBeCalled();

        $this->find($id)->shouldReturn($product);
    }

    public function it_should_get_product_from_repository_and_save_it_to_cache_when_product_is_not_in_cache(
        ProductCache $productCache,
        ProductRepository $productRepository
    ) {
        $id = '42';
        $product = ['id' => $id];

        $productCache->hasProduct($id)->willReturn(false);
        $productCache->loadProduct($id)->shouldNotBeCalled();
        $productRepository->find($id)->willReturn($product);
        $productCache->saveProduct($id, $product)->shouldBeCalled();

        $this->find($id)->shouldReturn($product);
    }
}
