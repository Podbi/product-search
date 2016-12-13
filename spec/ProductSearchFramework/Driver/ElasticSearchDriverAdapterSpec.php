<?php
namespace spec\ProductSearchFramework\Driver;

use PhpSpec\ObjectBehavior;
use ProductSearch\Driver\DriverAdapter;
use Prophecy\Argument;

/**
 * @mixin \ProductSearchFramework\Driver\ElasticSearchDriverAdapter
 */
class ElasticSearchDriverAdapterSpec extends ObjectBehavior
{
    public function let(\IElasticSearchDriver $elasticSearchDriver)
    {
        $this->beConstructedWith($elasticSearchDriver);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(\ProductSearchFramework\Driver\ElasticSearchDriverAdapter::class);
    }

    public function it_should_implement_driver_adapter()
    {
        $this->shouldHaveType(DriverAdapter::class);
    }

    public function it_should_call_internal_drive_find_method(\IElasticSearchDriver $elasticSearchDriver)
    {
        $id = 4;
        $product = ['id' => 4];

        $elasticSearchDriver->findById($id)->willReturn($product);

        $this->findProduct($id)->shouldReturn($product);
    }
}
