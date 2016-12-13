<?php
namespace spec\ProductSearchFramework\RequestRecorder;

use PhpSpec\ObjectBehavior;
use ProductSearch\RequestRecorder\ProductRequestRecorder;
use ProductSearch\RequestRecorder\ProductRequestRecorderRepository;
use ProductSearchFramework\RequestRecorder\JsonProductRequestParser;
use Prophecy\Argument;

/**
 * @mixin \ProductSearchFramework\RequestRecorder\JsonProductRequestRecorder
 */
class JsonProductRequestRecorderSpec extends ObjectBehavior
{
    public function let(
        ProductRequestRecorderRepository $productRequestRecorderRepository,
        JsonProductRequestParser $jsonProductRequestParser
    ) {
        $this->beConstructedWith($productRequestRecorderRepository, $jsonProductRequestParser);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(\ProductSearchFramework\RequestRecorder\JsonProductRequestRecorder::class);
    }

    public function it_should_implement_product_request_recorder()
    {
        $this->shouldHaveType(ProductRequestRecorder::class);
    }

    public function it_records_record_on_empty_data(
        ProductRequestRecorderRepository $productRequestRecorderRepository,
        JsonProductRequestParser $jsonProductRequestParser
    ) {
        $resource = '{json:[]}';
        $records = [];
        $id = 42;

        $productRequestRecorderRepository->read()->willReturn($resource);
        $jsonProductRequestParser->decode($resource)->willReturn($records);
        $jsonProductRequestParser->encode([42 => 1])->willReturn($resource);
        $productRequestRecorderRepository->write($resource)->shouldBeCalled();

        $this->record($id);
    }

    public function it_records_record_on_product_already_saved_in_data(
        ProductRequestRecorderRepository $productRequestRecorderRepository,
        JsonProductRequestParser $jsonProductRequestParser
    ) {
        $id = 42;
        $resource = '{json:[]}';
        $records = [42 => 6];

        $productRequestRecorderRepository->read()->willReturn($resource);
        $jsonProductRequestParser->decode($resource)->willReturn($records);
        $jsonProductRequestParser->encode([42 => 7])->willReturn($resource);
        $productRequestRecorderRepository->write($resource)->shouldBeCalled();

        $this->record($id);
    }
}
