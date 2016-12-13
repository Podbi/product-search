<?php
namespace spec\ProductSearch\Repository;

use PhpSpec\ObjectBehavior;
use ProductSearch\Driver\DriverAdapter;
use ProductSearch\Repository\ProductRepository;
use Prophecy\Argument;

/**
 * @mixin \ProductSearch\Repository\DriverProductRepository
 */
class DriverProductRepositorySpec extends ObjectBehavior
{
    public function let(DriverAdapter $driverAdapter)
    {
        $this->beConstructedWith($driverAdapter);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(\ProductSearch\Repository\DriverProductRepository::class);
    }

    public function it_should_implement_product_repository()
    {
        $this->shouldHaveType(ProductRepository::class);
    }

    public function it_should_return_product_based_on_product_id(DriverAdapter $driverAdapter)
    {
        $id = 42;
        $product = ['id' => $id];
        $driverAdapter->findProduct($id)->willReturn($product);

        $this->find($id)->shouldReturn($product);
    }
}
