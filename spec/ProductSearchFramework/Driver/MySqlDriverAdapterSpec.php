<?php
namespace spec\ProductSearchFramework\Driver;

use PhpSpec\ObjectBehavior;
use ProductSearch\Driver\DriverAdapter;
use Prophecy\Argument;

/**
 * @mixin \ProductSearchFramework\Driver\MySqlDriverAdapter
 */
class MySqlDriverAdapterSpec extends ObjectBehavior
{
    public function let(\IMySQLDriver $mySqlDriver)
    {
        $this->beConstructedWith($mySqlDriver);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(\ProductSearchFramework\Driver\MySqlDriverAdapter::class);
    }

    public function it_should_implement_driver_adapter()
    {
        $this->shouldHaveType(DriverAdapter::class);
    }

    public function it_should_call_internal_drive_find_method(\IMySQLDriver $mySqlDriver)
    {
        $id = 4;
        $product = ['id' => 4];

        $mySqlDriver->findProduct($id)->willReturn($product);

        $this->findProduct($id)->shouldReturn($product);
    }
}
