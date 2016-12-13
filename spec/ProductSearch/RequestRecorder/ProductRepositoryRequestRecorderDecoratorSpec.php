<?php
namespace spec\ProductSearch\RequestRecorder;

use PhpSpec\ObjectBehavior;
use ProductSearch\Repository\ProductRepository;
use ProductSearch\RequestRecorder\ProductRequestRecorder;
use Prophecy\Argument;

/**
 * @mixin \ProductSearch\RequestRecorder\ProductRepositoryRequestRecorderDecorator
 */
class ProductRepositoryRequestRecorderDecoratorSpec extends ObjectBehavior
{
    public function let(ProductRepository $productRepository, ProductRequestRecorder $productRequestRecorder)
    {
        $this->beConstructedWith($productRepository, $productRequestRecorder);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(\ProductSearch\RequestRecorder\ProductRepositoryRequestRecorderDecorator::class);
    }

    public function it_should_implement_product_repository()
    {
        $this->shouldHaveType(ProductRepository::class);
    }

    public function it_finds_product_via_product_repository_and_records_product_request_via_recorder(
        ProductRepository $productRepository,
        ProductRequestRecorder $productRequestRecorder
    )
    {
        $id = 42;
        $product = ['id' => 42];
        $productRepository->find($id)->willReturn($product);
        $productRequestRecorder->record($id)->shouldBeCalled();

        $this->find($id)->shouldReturn($product);
    }
}
